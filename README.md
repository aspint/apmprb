<p align="center"> 
<h1>Associação de Pequenos e Médios<br>
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

3. Copie, ou configure, o arquivo .env com dados da aplicação

<i> Obs.: Caso rode a aplicação em sub-dominio pode ser preciso criar um arquivo .htaccess apontando para public do projeto, ou recebera um forbiden.
Caso tenha recebido o forbiden copie e cole o modelo de .htaccess no final da pagina.</i>

## FAQ
### Forbiden

<p>Verifique se o servidor possui um .htaccess em sua raiz, caso contrário crie o seguinte codigo abaixo.</P>
<pre>
<IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteCond %{REQUEST_URI} !^public
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
</pre>
