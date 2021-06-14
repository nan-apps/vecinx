#!/bin/sh
# activate maintenance mode
php7.4 artisan down
# update source code
git pull
# update PHP dependencies
php7.4 /usr/local/bin/composer install --no-interaction --no-dev --prefer-dist
# --no-interaction Do not ask any interactive question
# --no-dev  Disables installation of require-dev packages.
# --prefer-dist  Forces installation from package dist even for dev versions.
# update database
php7.4 artisan migrate --force
# --force  Required to run when in production.

#clear cache
php7.4 artisan route:cache
php7.4 artisan config:cache
php7.4 artisan view:cache

# stop maintenance mode
php7.4 artisan up
