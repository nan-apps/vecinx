#!/bin/sh
# activate maintenance mode
php artisan down
# update source code
git pull
# update PHP dependencies
composer install --no-interaction --no-dev --prefer-dist
# --no-interaction Do not ask any interactive question
# --no-dev  Disables installation of require-dev packages.
# --prefer-dist  Forces installation from package dist even for dev versions.
# update database
php artisan migrate --force
# --force  Required to run when in production.

#clear cache
php artisan route:cache
php artisan config:cache
php artisan view:cache

# stop maintenance mode
php artisan up
