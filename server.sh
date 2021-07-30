#!/bin/bash
#start redis server on docker
sudo docker-compose -f docker-compose.yml up -d
#run laravel app
cd publisher
composer install
php artisan key:gen
php artisan serve & cd subscriber1
yarn install
yarn start