#!/bin/bash

echo "initializing subscriber"
cd subscriber
echo "install dependencies"
sudo composer install
sudo composer dump-autoload

echo "creating new .env form .env.example."
cp .env.example .env

echo "subscriber Application Key Set"
sudo php artisan key:generate

echo "subscriber Migration Started"
sudo php artisan migrate
echo "subscriber migration Finished Successfuly"

echo "subscriber server set"

cd -

echo "initializing publisher"
cd publisher
echo "install dependencies"
sudo composer install
sudo composer dump-autoload

echo "creating new .env form .env.example."
cp .env.example .env

echo "publisher Application Key Set"
sudo php artisan key:generate

echo "publisher Migration Started"
sudo php artisan migrate
echo "publisher migration Finished Successfuly"

echo "publisher server set"
