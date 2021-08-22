#!/bin/bash

echo "starting subscriber" 
cd subscriber
echo "install dependencies" 
sudo composer update &
sudo composer dump-autoload &

# check for .env
FILE=.env
if [ -f "$FILE" ]; then
    echo "subscriber $FILE exists."
else 
    echo "subscriber $FILE does not exist, creating new .env form .env.example."
    cp .env.example .env
    echo "subscriber Application Key Set"
    sudo php artisan key:generate &
fi

echo "subscriber Migration Started" 
sudo php artisan migrate &
echo "subscriber migration Finished Successfuly" 

echo "start server"
if lsof -Pi :7080 -sTCP:LISTEN -t >/dev/null ; then
    kill $(sudo lsof -t -i:7000)
    sudo php artisan serve --port=7000 &
else
    sudo php artisan serve --port=7000 &
fi
echo "subscriber Server Ready"
echo "subscriber server is running on port 7000" 

cd -

echo "starting publisher" 
cd publisher
echo "install dependencies" 
sudo composer update &
sudo composer dump-autoload &

# check for .env
FILE=.env
if [ -f "$FILE" ]; then
    echo "publisher $FILE exists."
else 
    echo "publisher $FILE does not exist, creating new .env form .env.example."
    cp .env.example .env
    echo "publisher Application Key Set"
    sudo php artisan key:generate &
fi

echo "publisher Migration Started" 
sudo php artisan migrate &
echo "publisher migration Finished Successfuly" 

echo "publisher Server Ready"
if lsof -Pi :8080 -sTCP:LISTEN -t >/dev/null ; then
    kill $(sudo lsof -t -i:7000)
    sudo php artisan serve --port=8000 &
else
    sudo php artisan serve --port=8000 &
fi

echo "publisher Queue Started"
sudo php artisan queue:work --daemon --timeout=3000 &
echo "publisher server is running on port 8000" 
