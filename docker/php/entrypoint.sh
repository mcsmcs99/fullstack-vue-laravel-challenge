#!/bin/sh
set -e

if [ ! -d "vendor" ]; then
    composer install
fi

exec php artisan serve --host=0.0.0.0 --port=8000
