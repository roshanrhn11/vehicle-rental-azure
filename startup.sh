#!/bin/bash

cd /home/site/wwwroot

composer install --no-dev --optimize-autoloader

php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

php artisan storage:link || true

cp /home/site/wwwroot/default.conf /etc/nginx/sites-available/default

service nginx reload