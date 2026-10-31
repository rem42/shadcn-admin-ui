#!/bin/sh
set -e

# Dependencies (first install: the project is mounted as a volume, so vendor/ comes from the host)
if [ ! -f vendor/autoload.php ]; then
    composer install --no-interaction --prefer-dist
fi

# Database of the demo (SQLite) and its data
php tests/Application/bin/console doctrine:schema:update --force --no-interaction
php tests/Application/bin/console app:load-books --if-empty --no-interaction

# Assets of the demo: importmap packages and Tailwind CSS build
php tests/Application/bin/console importmap:install
php tests/Application/bin/console tailwind:build

# Start PHP-FPM in background
php-fpm -D

# Start Nginx in foreground
nginx -g "daemon off;"
