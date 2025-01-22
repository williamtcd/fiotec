## FIOTEC

git clone

- cd fiotec
- cd vue/fiotec-front
- -> yarn install

- cd ../.. (voltar para pasta raiz fiotec)
- -> docker-compose up -d


Acessar o bando de dados no navegador
- http://localhost:8181/adminer.php
- server: db
- username: root
- password : root
  
criar banco chamado **fiotec** (utf8 unicode)


Pasta application/fiotec (pasta do projeto php/laravel)
- renomear .env.example para .env


# terminal do php 
- -> composer install
- -> php artisan migrate
- -> php artisan db:seed --class= CreateUser
