#!/bin/sh

set -e

echo "In entry point"

php artisan key:generate

php artisan migrate