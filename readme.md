# EmployeeVax

This small project works such as an vacination booklet where an admin can insert their employees that had been vacinated

The project technologies:<br>
Infractructure: <br>
Docker and docker-compose (you will need these brothers if you wanna run this project fine)<br>

Backend, an API with:<br>
PHP 8.2<br>
Laravel 10<br>
MySql 8.0<br>
PHPUnit<br>
Swagger<br>

Frontend: <br>
A simple SPA project builded under VueJs2 with some libs like vue router and axios.<br>

To run this project just open your terminal on this root folder and:<br>
1 - docker-compose build<br>
2 - docker-compose up -d<br>
3 - docker-compose exec app_feegow composer install<br>
4 - docker-compose exec app_feegow artisan migrate<br>
5 - docker-compose exec app_feegow artisan db:seed<br>

default admin user: <br>

email: admin@employeevax.com.br<br>
password: qwe123<br>


The api will be running on: http://localhost:80  <br>
The frontend will be running on: http://localhost:8080/ <br>

Go to the folders "backend" or "frontend" to see more details about each project. <br>

