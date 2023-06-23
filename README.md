<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel 10 API Crud

Features (API) include:

- Laravel passport package
- Authentication using passport
- Logout to remove old tokens
- Access Control with ACL
- Create users.
- List users.
- Update users.
- Delete users

## Install

Install commands:
``` 
- git clone https://github.com/lukebarbosa/api_laravel_passport_acl.git
- composer update
- configure .env
- php artisan migrate
- php artisan db:seed --class=UserSeeder
- php artisan serve

```

Use Postman to test the API.

## Note

- Register as ADMIN:
    - URL: http://localhost:8000/api/admin/register
    - Method: POST
    - Body => x-www-form-urlencode:
    - Insert email and password
    - Then access: http://localhost:8000/api/admin/login
    - Insert email and password
    - Press Enter to get Bearer token
    - Add the token: Authorization tab => Select: Bearer Token => Insert token.
    - Access to CRUD users: http://localhost:8000/api/admin/users
  

- Register as MODERATOR:
    - URL: http://localhost:8000/api/moderator/register
    - Method: POST
    - Body => x-www-form-urlencode:
    - Insert email and password
    - Then access: http://localhost:8000/api/moderator/login
    - Insert email and password
    - Press Enter to get Bearer token
    - Add the token: Authorization tab => Select: Bearer Token => Insert token.
    - Access to READ users: http://localhost:8000/api/moderator/users
  

- Login as FINANCIAL LEVEL 1 or LEVEL 2:
    - URL: http://localhost:8000/api/financial/register
    - Method: POST
    - Body => x-www-form-urlencode:
    - Insert email and password
    - Then access: http://localhost:8000/api/financial/login
    - Insert email and password
    - Press Enter to get Bearer token
    - Add the token: Authorization tab => Select: Bearer Token => Insert token.
    - Access to UPDATE or DELETE users: http://localhost:8000/api/financial/users
        
    
- Insert:
    - Use Body tab =>x-www-form-urlencode: Add name, email, and password.
- Update:
  - Use Body tab => x-www-form-urlencode: Add name and email.

## License

The Laravel 10 API Crud is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
