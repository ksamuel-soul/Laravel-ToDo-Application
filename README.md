<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Creating the Project...
In Command Promt 

    composer create-project laravel/laravel <App_Name>
OR

    laravel new <App_Name>
    
For API File installing 

    php artisan install:api

For making API Models

    php artisan make:model <Model_Name> -a --api

After making the changes inside the database->migrations 

    php artisan migrate

For making Authentication Controllers 

    php artisan make:controller AuthController

To start the serve

    php artisan serve

For establishing CORS(Cross Origin Resource Sharing)...

    php artisan config:publish cors

Inside config->cors->at Line 18 do the following changes...

    'paths' => ['api/*', 'sanctum/csrf-cookie', '*'],

To get all the routes 

    php artisan route:list

    
