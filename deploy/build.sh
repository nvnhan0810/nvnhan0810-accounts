#! /bin/sh

composer install -o --no-dev

php artisan migrate --force

php artisan optimize
