<p align="center"><img src="https://mms.businesswire.com/media/20210721005060/en/892542/5/Pangaea_Logo_v2-03.jpg" height="100"></p>
# Pangaea Take Home Test

## Inital Build Setup

```bash

# Do the following for both subscriber & publisher folders
# create a database.
# Update the database credentials in .env.example file and save it.
# Set Your Keys and APi Keys in the .env.example files and save it.

# run the following commands in the root of the project to give your device root user access to run commands
$ chmod +x ./start-server.sh 
$ chmod +x ./stop-server.sh 

# start server
$ sudo ./start-server.sh 

# And you're good to go!
# publisher is now running on port 8000
# subscriber is now running on port 7000
```

## After Build Setup (Incase you want to stop server)

```bash
# stop server
$ sudo ./stop-server.sh 
```

For detailed explanation on how things work, check out [Laravel docs](https://laravel.com).
