#!/bin/bash

cd /var/www/html/BHut/

php artisan migrate:refresh

php artisan db:seed
