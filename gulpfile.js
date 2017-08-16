// Tasks RequireJs
var gulp = require('gulp'),
    requireDir = require('require-dir'),
    argv = require('yargs').argv;

/*
* README
* Tasks da interface panel estão contidas no diretório /gulp-panel e desta maneira podem ser isoladas de tasks de outras interfaces
* Por convenção tasks do painel devem ser prefixadas com "panel" para garantir que não aconteça conflitos com tasks de outras interfaces.
* Assim as tasks ficam nomeadas como panel-libs, panel-scripts, panel-styles, panel-sass, panel-watch
*/

//Verifica o prefixo da tarefa para carregar as tasks específicas do panel caso seja o caso
for (var i in argv._) {
    if (argv._[i].match(/^panel-/i)) {
        //Tasks do Painel
        requireDir('./gulp-panel', { recurse: true });

        break;
    }
}

//Tasks do Site
//requireDir('./gulp', { recurse: true });