## Requirement
Laravel 10.x requires a minimum PHP version of 8.1.

## How to install

- Clone repository `git@github.com:imyuvii/task-management.git`
- Go to the directory `cd task-management`
- Run `composer install`
- Copy `.env.example` to `.env`
- Configure your database connection
- Run migration `php artisan migrate`
- Run database seeder `php artisan db:seed`
- Run the server `php artisan serve`

## How to use application
- Import postman collection & environment attached in `postman` directory under the root of the project
- Login via postman or via Curl 
-   "email": "john@example.com",
    "password": "JohnDoe123"
