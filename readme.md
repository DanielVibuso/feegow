# EmployeeVax

This small project works such as an vacination booklet where an admin can insert their employees that had been vacinated

The project technologies:
Infractructure: 
Docker and docker-compose (you will need these brothers if you wanna run this project fine)

Backend, an API with:
PHP 8.2
Laravel 10
MySql 8.0
PHPUnit
Swagger

Frontend: 
A simple SPA project builded under VueJs2 with some libs like vue router and axios.

To run this project just open your terminal on this root folder and:
1 - docker-compose build
2 - docker-compose up -d
3 - docker-compose exec app_feegow composer install
4 - docker-compose exec app_feegow artisan migrate

The api will be running on: http://localhost:80 
The frontend will be running on: http://localhost:8080/

Go to the folders "backend" or "frontend" to see more details about each project.

