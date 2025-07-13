# Descrição

   > ### 1.1 que é o sistema?
    É um sistema API RESTFUL para um desafio proposto pela upd8
    

   > ### 1.2 Quais tecnologias foram utilizadas na construção da API?
   - `Framework`: Laravel V. 12.0
   - `Langague`: PHP V. 8.3
   - `Database`: MySQL V. 5.7
   - `Docker`: Image php:2.0
    

# Primeiro passo antes da instalação:

> Configure o MySQL a partir do link:
*[Link](https://github.com/raimoreirarodrigues/mysql)

# Segundo passo antes da instalação

> Crie um banco de dados com o seguinte nome:

     desafio

# Instalação

>    Etapa 01 - Clone repositório e entre no diretório do projeto
    
     cd desafio-back
    
>    Etapa 02 - Rode o comando abaixo para criar uma imagem p/o container:
    
     sudo docker-compose build --no-cache
    
>    Etapa 03 - Rode o comando abaixo para instalar as dependências do projeto:
    
     sudo docker-compose run desafio php -d memory_limit=-1 /usr/local/bin/composer install

>    Etapa 04 - Rode o comando abaixo para subir o container criado:

     sudo docker-compose up -d

>    Etapa 05 - Rode o comando abaixo para criar o .env. Após isso, edite o .env as configurações de acesso ao  banco de dados conforme seu ambiente:

     cp .env.example .env
    
>    Etapa 06 - Rode o comando abaixo para entrar no container criado:
    
     sudo docker exec -it desafio bash

>    Etapa 07 - Rode o comando abaixo para gerar uma key 
    
     php artisan key:generate

>    Etapa 08 - Rode o comando abaixo para criar as tabelas do banco de dados 
    
     php artisan migrate

>    Etapa 09 - Rode o comando abaixo para adicionar informações no banco de dados 
    
     php artisan db:seed

     NOTA: o seeder pode demorar alguns segundos por conta da importação de todas as cidades brasileiras