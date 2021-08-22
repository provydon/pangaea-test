#!/bin/bash

echo "starting subscriber" 
cd subscriber
echo "install dependencies" 
sudo composer install &
sudo composer dump-autoload &
# check for .env
FILE=.env
if [ -f "$FILE" ]; then
    echo "subscriber $FILE exists."
else 
    echo "subscriber $FILE does not exist, creating new .env form .env.example."
    cp .env.example .env
fi


echo "subscriber Application Key Set"
sudo php artisan key:generate &
echo "subscriber Server Ready"
sudo php artisan serve --port=7000 &
echo "subscriber Migration Started" 
sudo php artisan migrate &
echo "subscriber migration Finished Successfuly" 
echo "subscriber server is running on port 7000" 

cd -

echo "starting publisher" 
cd publisher
echo "install dependencies" 
sudo composer install &
sudo composer dump-autoload &
# check for .env
FILE=.env
if [ -f "$FILE" ]; then
    echo "publisher $FILE exists."
else 
    echo "publisher $FILE does not exist, creating new .env form .env.example."
    cp .env.example .env
fi


echo "publisher Application Key Set"
sudo php artisan key:generate &
echo "publisher Server Ready"
sudo php artisan serve --port=8000 &
echo "publisher Migration Started" 
sudo php artisan migrate &
echo "publisher migration Finished Successfuly" 
echo "publisher Queue Started"
sudo php artisan queue:work --daemon --timeout=3000 &
echo "publisher server is running on port 8000" 
