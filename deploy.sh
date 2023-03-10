#!/bin/bash

# check if running with sudo
if [ "$EUID" -ne 0 ]; then
    echo "This script requires root privileges. Please run with 'sudo'."
    exit 1
fi

# get input for environment variables
echo "Enter the name of the website:"
read APP_NAME

echo "Enter APP_URL (With port!):"
read APP_URL

echo "Enter the database name:"
read DB_DATABASE

# check if db passwords match and assign them to a variable
while true; do
    echo "Enter the database password:"
    read -s DB_PASSWORD
    echo ""
    echo "Confirm password:"
    read -s DB_PASSWORD_CONFIRM
    echo ""
    if [ "$DB_PASSWORD" = "$DB_PASSWORD_CONFIRM" ]; then
        break
    else
        echo "Passwords do not match. Exiting script."
        exit 1
    fi
done

# change directory to /var/www/html/
cd /var/www/html/

# check if BHut directory exists
if [ -d "BHut" ]; then
    # move BHut directory to BHut.bck
    mv BHut BHut.bck
fi

# clone repository
git clone -b main https://github.com/emilijus-sileikis/BHut

# change directory to BHut
cd BHut/

# install npm packages
npm install

# update composer dependencies
composer update

# copy .env.example to .env
cp .env.example .env

# change .env settings
sed -i "s/APP_NAME=Laravel/APP_NAME=\"$APP_NAME\"/g" .env
sed -i "s/APP_URL=http:\/\/localhost/APP_URL=\"$APP_URL\"/g" .env
sed -i "s/DB_DATABASE=laravel/DB_DATABASE=$DB_DATABASE/g" .env
sed -i "s/DB_PASSWORD=/DB_PASSWORD=$DB_PASSWORD/g" .env

# set directory permissions
chmod -R 777 /var/www/html/BHut/

# generate application key
php artisan key:generate

# run database migrations
php artisan migrate

# refresh database
php artisan migrate:refresh

# seed database
php artisan db:seed

# restart apache2 service
service apache2 restart

echo "Done. You can now refresh your browser!"
