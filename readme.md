## Laravel Skeleton Project

Base inicial para desenvolvimento de aplicações usando Laravel Framework.

## Características

Usa conceito de domínios e aplicações, através de uma [estruturação de diretórios diferente](#structure) do Laravel.

Por padrão já existe uma aplicação chamada **panel** estruturada com módulos básicos essenciais e alguns módulos básicos, como páginas, banners e contato.

Esta aplicação **panel** já tem uma interface visual [AdminLTE](https://almsaeedstudio.com/themes/AdminLTE/index2.html) definida. Com todas as tarefas as tarefas pré-definidas.

Tarefas elixir do Laravel foram reestruturadas para melhorar o desenvolvimento.

Tarefas específicas do painel estão no diretório /gulp-panel, dando assim liberdade para que o desenvolvedor front-end possa criar suas próprias tarefas independentes do Elixir.

## Instalação
Para usar, basta fazer o clone deste projeto.
### Front-end
Instalando as depedências:
```php
npm install

bower install
```
As tarefas `panel-libs`, `panel-styles` e `panel-scripts`, vão processar e gerar os assets usados no painel.
```
gulp panel-libs
gulp panel-styles
gulp panel-scripts

```
Essas tarefas podem ser configuradas no arquivo [gulp-panel/config/gulpconfig_panel.json](./gulp-panel/config/gulpconfig_panel.json)

### Back-end
Rode o composer para instalar as dependências PHP do projeto
```php
composer install
```
Para o projeto funcionar, será necessário somente configurar as configurações do banco de dados no arquivo .env do Laravel.
Este projeto usa o pacote [artesaos/migrator](https://github.com/artesaos/migrator) para gerenciamento das migrations, logo use o comando abaixo para fazer a primeira migração.
```php
php artisan migrator --seed
```
## Utilização
Como você já deve ter percebido o foco deste skeleton é criar uma base de painel administrativo.

Seu primeiro acesso ao painel administrativo (raizdasuaaplicacao/admin) pode ser feito com o usuário **teste@teste.com.br** e com a senha **123456**

Explore ;)
## Estrutura de diretórios<a name="structure"></a>
Este projeto Laravel não utiliza a estrutura de diretórios padrão do Laravel. A estrutura usada neste projeto, é baseada
na estrutura difundida pelo [Codecasts]([https://codecasts.com.br).

Você pode saber mais detalhes a respeito desta estruturação nos links abaixo:
https://codecasts.com.br/series/modularizacao-com-laravel, https://codecasts.com.br/series/laravel-hardcore

Estrutura de diretórios:

![estrutura-diretorios-laravel-skeleton](https://cloud.githubusercontent.com/assets/4051452/25787014/e91b0868-3373-11e7-94c8-3ada0ff6e9f2.png)

