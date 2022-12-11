<p align="center"> 
<img src="public/assets/images/logos/logo-icon-coop.png" width="40">
<img src="public/assets/images/logos/logo-light-text-apmprbm.png" width="200">
<h1 align="center">Associação de Pequenos e Médios<br>
Produtores Rurais de Bonvinopolis de Minas</h1>
</p>

<p>
Associação de produtores de leite de Bonvinopolis em Minas Gerais.
</p>

## Sobre Aplicação da APMPRBM

<p>Aplicação desenvolvida em PHP 7.4 com Laravel 9, que tem como objetivo o gerenciamento de entrega de leite dos coperados para cooperativa e da cooperativa para os seus clientes.</p>

## Requisito

- PHP 7.4^<br/>
- Laravel 9.x ^<br/>
- MySql

## Passo a passo para construir

1. Faça o clone do projeto
2. Dentro do projeto execute Composer Install 
    - obs.: Em alguns servidores talvez seja preciso rodar php composer.phar

3. Copie, ou configure, o arquivo .env com dados da aplicação e banco de dados

4. Dentro da pasta do projeto rode o comando abaixo para que seja criado as tabelas do sistema.
<pre>
<IfModule mod_rewrite.c>
    php artisan migrate
</IfModule>
</pre>

5. Logo em seguida a criação da tabela rode o comando abaixo para criar os dados base da tabela, como user ADMIN e outros.
<pre>
<IfModule mod_rewrite.c>
    php artisan db:seed
</IfModule>
</pre>

<i> Obs.: Caso rode a aplicação em sub-dominio pode ser preciso criar um arquivo .htaccess apontando para public do projeto, ou recebera um forbiden.
Caso tenha recebido o forbiden copie e cole o modelo de .htaccess no final da pagina.</i>

## FAQ
### Forbiden .htaccess
<p>Avalie se o servidor possui o arquivo .htaccess na raiz onde o projeto se encontra, caso contrário crie um .haccess com o seguinte codigo abaixo:</p>
<pre>
<IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteCond %{REQUEST_URI} !^public
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
</pre>
