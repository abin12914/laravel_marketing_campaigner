## About Laravel Marketing Campaigner

Bulk contact importing and email campaigning app built with Laravel

## Features

User can import contacts from Excel file
Duplicate records won't be saved
Can send personalized emails
Can integrate other notifiation channels like sms very easily(Not integrated now)
History of notification
contact CRUD operations

## Points To Note

This project uses Laravel Sail(A light-weight command-line interface for interacting with Laravel's default Docker development environment).

Bundled Docker Apps : Laravel, mysql, redis, meilisearch, mailpit, and selenium 

# How to run?
 
    1. Copy .env.example to .env
    2. Modify your .env file with the required environment variables in order to connect to the Docker services:
    3. Run the command php artisan sail:install
    4. Run the command ./vendor/bin/sail up (For sail documentation visit : https://laravel.com/docs/11.x/sail)
    5. Run the command ./vendor/bin/sail artisan migrate on new terminal
    6. Run the command ./vendor/bin/sail artisan db:seed
    7. Keep the command npm run dev running
    8. Run the command ./vendor/bin/sail artisan queue:work on another terminal

    As per provided .env.example configuration Laravel application will be available at http://localhost:3001/
    mailpit will be available at http://localhost:8025/

# To-do

Write tests
