########################################################################
### Composer

FROM composer:lts AS composer

COPY composer.json /app
COPY composer.lock /app

RUN composer install        \
    --ignore-platform-reqs  \
    --no-ansi               \
    --no-autoloader         \
    --no-interaction        \
    --no-scripts

COPY . /app/
RUN composer dump-autoload --optimize --classmap-authoritative

### Composer
########################################################################
### PHP

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

COPY --from=composer /app/vendor                /var/www/html/vendor
COPY . /var/www/html

RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

# COPY --chown=www:www-data . /var/www

WORKDIR /var/www/html

# Expose port 8000
EXPOSE 9000

# Start Apache
# CMD ["apache2-foreground"]

CMD php artisan serve --host=0.0.0.0 --port=9000

COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

### PHP
########################################################################