# Backend EmployeeVax

This project is an API builded under Laravel 10.<br>
If you did the first read-me step-by-step to run, it is already working on your machine.<br>

Thinking about cover the most common day scenarios of development I decided keep it simple using repository-service pattern and do use the power of the framework about design patterns such as FormRequests and Resources instead of DTO's, 
Migrations to create and seed to create the main user.<br>

Technologies: <br>
PHP 8.2 <br>
Laravel 10 <br>
MySql 8.0 <br>
PHPUnit <br>
CI with git workflows <br>
Auth with Sanctum, by using tokens JWT <br>
Scramble to create and easily update the endpoints documentation.<br>

All the business rules are implemented on the services, the more cool things on EmployeeLotServices.<br>

About the database modeling, even that you can see all the decisions about this on the migrations, I am puting here a draw that drived me before start coding. You can find that inside "public/feew.png"

<img src="/public/feew.png" alt="Database draw">

