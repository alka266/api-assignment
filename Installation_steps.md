# Steps to install and run the application

## Git clone
1. git clone git@github.com:alka266/api-assignment.git
2. cd api-assignment

## Installation steps:

1. Install php and composer
2. Run `composer install`
3. `copy .env.example .env`
4. Set env variables:
    - DB_DATABASE=api_assignment
    - DB_USERNAME=root
    - DB_PASSWORD=""

## Artisan commands:
1. php artisan key:generate
2. php artisan migrate
3. php artisan serve