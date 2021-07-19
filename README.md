<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Technical 
    PHP version: 7.2.5
    Laravel: 7.29
    Mysql - 5.7.34

## Assignment setup steps
	git clone https://github.com/neosoftnikhil/ushortner
    (Create .env or copy .env.example) && add db details
	composer install
	npm install && npm run development
    php artisan migrate --seed
    php artisan serve
    Admin Username: admin@ushortner.com
    Admin pass : admin123


## Project Requirement

    Create a URL shortner module in Laravel (v5-v8)
    Task -
    1. Register, Login and Logout functionality for the user to shortner the
    URL
    2. Create a form to pass url to shorten. Make Ajax request to server for
    shortning the URL. Display shortned URL
    - URL can be duplicated but shortURL should be unique
    - Each user can shorten at most 10 URLs
    3. Create listing page to display all URLs shortened by the user with
    option to
    - Delete the URL (Soft Delete)
    - Edit the URL
    - Deactivate the Short URL
    4. An simple form to upgrade current plan (10 URLs) to 1000 URLs and
    Unlimited. (Just a mockup. upon selection quota will be increased)
    - Design Mysql Schema to implement above workflow
    - Create a technical document for the application/module
    - For UI, developer can user Blade template engine or SPA approach (Use
    Angular as Frontend)
    - User laravel's built in authentication functionality for User regisration
    and authentication
    - Use Eloquent to perform various MySQL queries
    - Session can be stored in File/Database

## About UShortner
    You can register login logout
    after login you can select a plan and can create short urls in shortner module
    Modules:
        Register
            - User can register
        Login
            - User can login and can use Ushortner application
        Logout
            - user can logout from the application
        Upgrade plan
            - User can select and upgrade plan
        Shortner
            - User can short url based on selected plan.
            - Url can be deactivated/activated.
            - Url can be edited/deleted.




