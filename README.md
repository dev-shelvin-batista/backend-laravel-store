# Project details
This project functions as a backend project developed in Laravel with a PostgreSQL database to generate REST API services that are used by a project developed in Angular. [Frontend](https://github.com/dev-shelvin-batista/frontend-angular-store)

| |Version |
|----------------|-------------------------------|
|Laravel |`8.83.27` |
|PHP |`7.4.33`|
|PostgreSQL |`12`|

## Important note
- The postman_collections file has been added with all the developed REST APIs.

## Instructions
To start this project on a local server, follow the instructions below.

- Clone the project, either with the command git clone `https://github.com/dev-shelvin-batista/backend-laravel-store.git` or using a GitHub graphical tool.
- After cloning the repository, access the downloaded folder with the cd command in the terminal, i.e., `cd backend-laravel-store`, as several commands will be executed there.
- Run the `composer update` command inside the project folder to install the dependencies.
- Change the database connection in Postgresql in the project's .env file. In this file, modify the variables DB_HOST, DB_PORT, DB_DATABASE (`db_laravel_store` was the name assigned in the project), DB_USERNAME, and DB_PASSWORD. For the technical test, the **pgAdmin** tool was used, and the database was managed with the **DBeaver** tool.
- Generate the database structure using Laravel migrations by running the command `php artisan migrate`.
- After generating the database structure, you must complete the initial data by running the command `php artisan db:seed`.
- At this point, the project is ready to be tested. Run it with the command: `php artisan serve`. By default, the URL `http://127.0.0.1:8000` is used to run the REST services.