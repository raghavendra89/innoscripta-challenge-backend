# Use the official PHP image as the base image
FROM php:8.2-apache as final

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy composer files and install dependencies
COPY ./composer.json ./composer.lock ./

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the application files
COPY . ./

RUN composer install --no-dev

# Generate the autoload files
RUN composer dump-autoload --no-scripts --no-dev --optimize

# Set the appropriate file permissions
RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

COPY .env.example .env

WORKDIR /var/www/html/public

# Expose port 8000
EXPOSE 8000

# Start Apache
CMD ["apache2-foreground"]

COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
# ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]