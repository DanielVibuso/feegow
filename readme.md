# EmployeeVax

This small project works such as an vacination booklet where an admin can insert their employees that had been vacinated

Following the provided instructions, I implemented some rules that can be easily deduced after modeling the database and studying the use cases:

1 - Vaccines are registered in the system with a name and an interval in days for their booster shot. However, for a vaccine to be "applicable," it must have at least one "lot" registered. If the interval is recorded as 0 (ZERO), we assume it is a single-shot vaccine, as was the case with the Janssen single-shot vaccine when it was launched.
2 - lots have an expiration date. A vaccine can have multiple lots, but a lot can only belong to one vaccine.
3 - The lot linked to the employee carries the name of the related vaccine.
4 - At the time of registration, the next shot is calculated based on the application date + interval (in days, registered together the vaccine name).
5 - Vaccines cannot be administered before the recommended booster date.
6 - It is not allowed to administer more than one shot to someone who received a single-shot vaccine (0 days of booster interval).
7 - A vaccination record cannot be linked if the lot’s expiration date is before the vaccination date. Note: The registration is not based on the current day, so retroactive entries are allowed.
Example: Informing the system that the employee was vaccinated in 2022 with a vaccine lot that expires in 2023 is OK.
Informing the system that the employee was vaccinated in 2023 with a lot that expired in 2022 is NOT OK and will not be accepted.

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
Swagger Documentation: http://localhost:80/api<br>
The frontend will be running on: http://localhost:8080/ <br>

Go to the folders "backend" or "frontend" to see more details about each project. <br>
********************************************************************************
Este pequeno projeto funciona como uma caderneta de vacinas onde um administrador pode inserir os funcionários que foram vacinados.<br>

Seguindo as instruções disponibilizadas implementei algumas regras que podem ser facilmente deduzidas após a modelagem do banco e estudo dos casos de uso:
1 - As vacinas são cadastradas no sistema com nome e intervalo em dias para o seu reforço mas para que sejam "aplicáveis", deve possuir ao menos 1(um) lote registrado. Caso o intervalo seja registrado como 0(ZERO), deduzimos que é uma vacina de dose única, como era o caso da vacina de dose única da Janssen quando foi lançada.
2 - Os lotes possuem data de validade, uma vacina pode ter vários lotes, porém 1 lote só pode pertencer a uma vacina.
4 - O que é vinculado ao funcionário é o lote, que traz consigo o nome da vacina relacionada.
5 - No ato do registro é calculado com base na data de aplicação + intervalo(em dias, cadastrado junto com o nome da vacina) quando deverá ser a próxima dose.
6 - Não é permitido aplicar vacinas antes da data recomendada para o reforço.
7 - Não é permitido aplicar mais de 1 dose em quem tomou vacina de dose única (0 dias de intervalo para o reforço).
8 - Não é possível vincular um registro de vacinação com data posterior ao da data de expiração do lote que está sendo informado. NOTA: o cadastro não se baseia no dia atual, podendo ser feito alimentação retroativa.
EX: informar ao sistema que o funcionário foi vacinado ano de 2022, com uma vacina de um lote que vencia em 2023. OK!
    informar ao sistema que o funcionário foi vacinado no ano de 2023 com um lote de 2022. NÃO OK, não será aceito.

Bom, desde o surgimento da covid, auge da pandemia, emergencia global e atual cenário muita coisa se criou, adequou,
evoluiu, descobriu-se e mudou-se. Então para que esse sistema ficasse realmente fíel à realidade muitos outros cenários poderiam ser cobertos e isso levaria um bom tempo de estudo de casos de uso. Devido a isso me limitei a essas regras.
Os usuários com comorbidades, optei por marcá-los com vermelho na listagem do frontend, para que fique evidente que merecem maior atenção. 


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
Documentação swagger em: http://localhost:80/api<br>
O frontend estará rodando em: http://localhost:8080/<br>

Vá para as pastas "backend" ou "frontend" para mais detalhes sobre cada projeto.<br>