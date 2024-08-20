# EmployeeVax

This small project works such as an vacination booklet where an admin can insert their employees that had been vacinated

The project technologies:<br>

Infractructure: <br>
Docker and docker-compose (you will need these brothers if you wanna run this project fine)<br>
git-workflows to keep little CI.

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
4 - docker-compose exec app_feegow php artisan migrate<br>
5 - docker-compose exec app_feegow php artisan db:seed<br>
6 - docker-compose exec node npm install<br>

if you want to run the backend tests you can do:<br>

docker-compose exec app_feegow php artisan test <br>

default admin user: <br>

email: admin@employeevax.com.br<br>
password: qwe123<br>


The api will be running on: http://localhost:80  <br>
The frontend will be running on: http://localhost:8080/ <br>

Go to the folders "backend" or "frontend" to see more details about each project. <br>
********************************************************************************
Este pequeno projeto funciona como uma caderneta de vacinas onde um administrador pode inserir os funcionários que foram vacinados.<br>

Tecnologias do projeto:<br>

Infraestrutura:<br>

Docker e docker-compose (você vai precisar desses irmãos se quiser rodar o projeto corretamente)
git-workflows para manter um pequeno CI. <br>
Backend: uma API com:<br>

PHP 8.2<br>
Laravel 10<br>
MySQL 8.0<br>
PHPUnit<br>
Swagger<br>


Frontend:<br>

Um projeto SPA simples construído com Vue.js 2 e algumas bibliotecas como Vue Router e Axios.<br>
Para rodar este projeto, basta abrir seu terminal na pasta raiz e executar:<br>

1 - docker-compose build<br>
2 - docker-compose up -d<br>
3 - docker-compose exec app_feegow composer install<br>
4 - docker-compose exec app_feegow php artisan migrate<br>
5 - docker-compose exec app_feegow php artisan db:seed<br>
6 - docker-compose exec node npm install<br>

você pode rodar os testes que foram incluídos com o comando:<br>

docker-compose exec app_feegow php artisan test <br>
Usuário administrador padrão:<br>

Email: admin@employeevax.com.br<br>
Senha: qwe123<br>
A API estará rodando em: http://localhost:80<br>
O frontend estará rodando em: http://localhost:8080/<br>

Vá para as pastas "backend" ou "frontend" para mais detalhes sobre cada projeto.<br>