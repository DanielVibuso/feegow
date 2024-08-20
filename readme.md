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
Este pequeno projeto funciona como uma caderneta de vacinas onde um administrador pode inserir os funcionários que foram vacinados.

Tecnologias do projeto:

Infraestrutura:

Docker e docker-compose (você vai precisar desses irmãos se quiser rodar o projeto corretamente)
Backend: uma API com:

PHP 8.2
Laravel 10
MySQL 8.0
PHPUnit
Swagger


Frontend:

Um projeto SPA simples construído com Vue.js 2 e algumas bibliotecas como Vue Router e Axios.
Para rodar este projeto, basta abrir seu terminal na pasta raiz e executar:

docker-compose build
docker-compose up -d
docker-compose exec app_feegow composer install
docker-compose exec app_feegow artisan migrate
docker-compose exec app_feegow artisan db:seed
Usuário administrador padrão:

Email: admin@employeevax.com.br
Senha: qwe123
A API estará rodando em: http://localhost:80
O frontend estará rodando em: http://localhost:8080/

Vá para as pastas "backend" ou "frontend" para mais detalhes sobre cada projeto.