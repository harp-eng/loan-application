## Loan Application
loan management system

The project to manage loan related operations like create loan request, approval or rejection  and record installment payments.

task covered in this Project:

 - APIs created to store loan request, get all loan request, particular request information and API to store installment.
 - Authication API provided for example register , login and All the requests are authenticated with Bearer Token Authentication
 - For Admin their is one page where admin can approve or reject loan requests after completing login process.

## Installation Instructions

- Run `composer install`
- Run `npm install`
- Run `npm run dev`
- Run `cp .env.example .env`
- Create database and update .env file with db details
- Run `php artisan migrate`
- Run `php artisan passport:install`
- Run `php artisan db:seed --class=CreateUsersSeeder`
- Run `php artisan serve`

## API Documentation

- [Postman Collection](https://www.postman.com/trakopteam/workspace/loan-application/collection/12769370-ee7f2724-bb3f-4778-b18c-17e5b766c6ec)

## Backend Documentation

-Admin Login Page URL => http://localhost:8000/login
    login details: 
        email: admin@gmail.com
        password: 123456

-Loans Requests Page URL => http://localhost:8000/getLoans


## Third-party Packages Used

- [Laravel Passport](https://laravel.com/docs/passport)
- [Laravel UI](https://larainfo.com/blogs/laravel-8-authentication-with-laravel-ui)
