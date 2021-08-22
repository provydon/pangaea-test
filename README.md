<p align="center"><img src="https://mms.businesswire.com/media/20210721005060/en/892542/5/Pangaea_Logo_v2-03.jpg" height="100"></p>
# Pangaea Take Home Test

## Inital Build Setup
### Before you run the app, make sure the following are installed on your machine
#### PHP 7.3 and above
#### composer
#### mysql
#### 

```bash
# install dependencies
$ composer install

# autoload dependencies
$ composer dump-autoload

# create a .env file in the root of the project, and copy and paste the contents of .env.example into it and save it.

# Set Your Keys and APi Keys in the .env file.

# migrate and seed
$ php artisan migrate --seed

# install passport for api
$ php artisan passport:install


# start server
$ php artisan serve

# And you're good to go!
```

## After Build Setup (Incase of Database Refresh)

```bash
# After you've started the server sometime later in the future during development, if u wish to refresh the database, run
$ php artisan migrate:refresh --seed

# Then reset access token for the api
$ php artisan passport:client --personal

# And you're good to go!
```

For detailed explanation on how things work, check out [Laravel docs](https://laravel.com).
