## Installation Steps:
- Clone the project.

- Go to project path.

- Run: **`docker-compose up --build -d`**.

- RUN: **`docker-compose exec apache composer install`**

- After finishing go to: **http://localhost:8000/public/**  
to check the application.     

## Tests:
- Go to the project path.
- Run :**`docker-compose exec apache php artisan test`**
