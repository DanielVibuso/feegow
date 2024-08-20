# Backend EmployeeVax

This project is an API builded under Laravel 10.<br>
If you did the first read-me step-by-step to run, it is already working on your machine.<br>

Thinking about cover the most common day scenarios of development I decided keep it simple using repository-service pattern and do use the power of the framework about design patterns such as FormRequests and Resources instead of DTO's, 
Migrations to create the database and seeder to create the admin user.<br>

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

You can see all documentation about the endpoints on localhost/api


************************************************************************************


Este projeto é uma API construída com Laravel 10.
Se você seguiu os passos do README principal para configurar, ela já está funcionando na sua máquina.

Pensando em cobrir os cenários mais comuns de desenvolvimento, decidi mantê-lo simples usando o padrão de repositório-serviço e aproveitar o poder do framework em relação a padrões de design, como FormRequests e Resources em vez de DTOs, Migrations para o banco de dados e seeder para criar o usuário admin.

Tecnologias:

PHP 8.2
Laravel 10
MySQL 8.0
PHPUnit
CI com fluxos de trabalho Git
Autenticação com Sanctum, utilizando tokens JWT
Scramble para criar e atualizar facilmente a documentação dos endpoints
Todas as regras de negócio estão implementadas nos serviços, com as funcionalidades mais interessantes no EmployeeLotServices.

Sobre o modelamento do banco de dados, mesmo que você possa ver todas as decisões sobre isso nas migrations, estou incluindo aqui um diagrama que me orientou antes de começar a codificar. Você pode encontrá-lo dentro de "public/feew.png".

<img src="/public/feew.png" alt="Diagrama do Banco de Dados">

Você pode ver toda a documentação sobre os endpoints em localhost/api

