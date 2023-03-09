#!/bin/bash

# change directory to /var/www/html/
cd /var/www/html/

# move BHut directory to BHut.bck
mv BHut BHut.bck

# clone repository
sudo git clone https://github.com/emilijus-sileikis/BHut.git

# change directory to BHut
cd BHut/

# install npm packages
sudo npm install

# update composer dependencies
composer update

# copy .env.example to .env
sudo cp .env.example .env

# change .env settings
sudo sed -i 's/APP_NAME=Laravel/APP_NAME="BHut"/g' .env
sudo sed -i 's/APP_URL=http:\/\/localhost/APP_URL="http:\/\/193.219.91.103:80"/g' .env
sudo sed -i 's/DB_DATABASE=laravel/DB_DATABASE=bhut/g' .env
sudo sed -i 's/DB_PASSWORD=/DB_PASSWORD=strongpass123/g' .env

# set directory permissions
sudo chmod -R 777 /var/www/html/BHut/

# generate application key
sudo php artisan key:generate

# run database migrations
sudo php artisan migrate

# refresh database
sudo php artisan migrate:refresh

# seed database
sudo php artisan db:seed

# restart apache2 service
sudo service apache2 restart

echo "Done."