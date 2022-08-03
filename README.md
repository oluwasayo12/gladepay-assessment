## GladePay Assessment

Application developed based on requirements. API documentation hosted on postman(https://documenter.getpostman.com/view/2791876/UzkXyEcp)

## App currently Deployed on Heroku

Quick note: Heroku does not support storing uploads on the local filesystem. However, if testig on local, run "php artisan storage:link" to make logos publicly available.

## Running application on local system

Follow the following steps;

 - Clone repository
 - cd ito the cloned repository and run "composer install" to install dependencies
 - rename .env.example to .env
 - modify the database and mail credentials
 - run "php artisan key:generate"
 - run "php artisan migrate" to create application db tables
 - run "php artisan db:seed --class=RolesAndPermissionsSeeder"
 - run "php artisan db:seed --class=SuperAdminSeeder"
 - run "php artisan serve" to serve app locally
