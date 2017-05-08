## Laravel Skeleton Project

Base inicial para desenvolvimento de aplicações usando Laravel Framework.

![estrutura-diretorios-laravel-skeleton](https://cloud.githubusercontent.com/assets/4051452/25787014/e91b0868-3373-11e7-94c8-3ada0ff6e9f2.png)

##Características

Usa conceito de domínios e aplicações.

Por padrão já existe uma aplicação chamada **panel** estruturada com módulos básicos essenciais e alguns módulos básicos, como banners, páginas e contato.

Esta aplicação **panel** já tem uma interface visual [AdminLTE](https://almsaeedstudio.com/themes/AdminLTE/index2.html) definida. Com todas as tarefas as tarefas pré-definidas.

Tarefas elixir do Laravel foram reestruturadas para melhorar o desenvolvimento.

Tarefas específicas do painel estão no diretório /gulp-panel, dando assim liberdade para que o desenvolvedor front-end possa criar suas próprias tarefas independentes do Elixir.

##Instalação
Após clonar o projeto, você pode rodar as tarefas da interface visual.
```php
npm install

bower install

gulp panel-libs
gulp panel-styles
gulp panel-scripts

```
A tarefa `panel-libs`, `panel-styles` e `panel-scripts`, vão processar e gerar os assets usados no painel.

Essas tarefas podem ser configuradas no arquivo [gulp-panel/config/gulpconfig_panel.json](./gulp-panel/config/gulpconfig_panel.json)

Depois é só rodar o composer e instalar o Laravel e as dependências PHP
```php
composer install

```

