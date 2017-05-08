const Elixir = require('laravel-elixir');
const argv = require('yargs').argv;
const shell = require('gulp-shell');

//Lodash
const _ = require('lodash');
const merge = require('lodash.merge');
const mergeWith = require('lodash.mergewith');

/****** CONFIGURAÇÃO DAS TASKS ********/
//Arquivos de configuração
const commonConfig = require('./config/gulpconfig.json'); //Configurações dos assets do Site
const panelConfig = require('./config/gulpconfig_panel.json'); //Configurações dos assets do Painel Administrativo

//Merge dos arquivos de configuração conforme opções passadas no console
function customizer(objValue, srcValue) {
    if (_.isArray(objValue)) {
        return objValue.concat(srcValue);
    }
}

//Configurações
var config = _.mergeWith(commonConfig, panelConfig, customizer);

/****** CONFIGURAÇÕES ELIXIR ********/
//Arquivo de configuração
Elixir.config.css.sass.folder = config.elixir.css.sass.folder;
Elixir.config.css.folder = config.elixir.css.folder;
Elixir.config.sourcemaps = config.elixir.sourcemaps;
process.env.DISABLE_NOTIFIER = config.elixir.disable_elixir_notifier;
Elixir.config.css.autoprefix.enabled = false;
Elixir.config.muted = true;
Elixir.config.watch.interval = 100;

/*********** TASKS *************/
gulp.task('panel-libs', function()  {
    console.log('Processando: scripts, styles e copy (Use --nocopy para desativar copia)');

    Elixir(function (mix) {
        var processedFiles = [];

        //Scripts
        for (var group in config.libs.scripts) {
            mix.scripts(config.libs.scripts[group], group, './');
            processedFiles.push(group);
        }

        //Styles
        for (var group in config.libs.styles) {
            mix.styles(config.libs.styles[group], group, './');
            processedFiles.push(group);
        }

        //Copy
        if (!argv.nocopy) {
            for (var task in config.libs.copy) {
                for (var x in config.libs.copy[task]) {
                    mix.copy(config.libs.copy[task][x], task);
                }
            }
        }

        //Versionamento
        if (config.elixir.versioning) {
            mix.version(processedFiles);
        }

        //Executa as tasks gulp
        return Elixir.tasks.forEach(function (task) {
            if (task.name === 'scripts' || task.name === 'styles' || task.name === 'copy') {
                task.run();
            }
        });
    });
});

gulp.task('panel-images', function()  {
    console.log('Processando: Copiando imagens');

    Elixir(function (mix) {
        for (var task in config.images) {
            for (var x in config.images[task]) {
                mix.copy(config.images[task][x], task);
            }
        }

        //Executa as tasks gulp
        return Elixir.tasks.forEach(function (task) {
            if (task.name === 'copy') {
                task.run();
            }
        });
    });
});

gulp.task('panel-scripts', function()  {
    console.log('Processando: scripts');

    Elixir(function (mix) {
        var processedFiles = [];

        //Scripts
        for (var group in config.scripts) {
            mix.scripts(config.scripts[group], group, './');
            processedFiles.push(group);
        }

        //Versionamento
        if (config.elixir.versioning) {
            mix.version(processedFiles);
        }

        //Executa as tasks gulp
        return Elixir.tasks.byName('scripts').forEach(function (task) {
            task.run();
        });
    });
});

gulp.task('panel-styles', function()  {
    console.log('Processando: styles');

    Elixir(function (mix) {
        var processedFiles = [];

        //Styles
        for (var group in config.styles) {
            mix.styles(config.styles[group], group, './');
            processedFiles.push(group);
        }

        //Versionamento
        if (config.elixir.versioning) {
            mix.version(processedFiles);
        }

        //Executa as tasks gulp
        return Elixir.tasks.byName('styles').forEach(function (task) {
            task.run();
        });
    });
});

gulp.task('panel-sass', function()  {
    console.log('Processando: sass');

    Elixir(function (mix) {
        //Sass
        var sassGroups = config.sass;
        for (var group in sassGroups) {
            mix.sass(sassGroups[group], group);
        }

        //Executa as tasks gulp
        return Elixir.tasks.byName('sass').forEach(function (task) {
            task.run();
        });
    });
});

/*********** WATCH *************/
Elixir(function (mix) {
    mix.browserSync({
        proxy: 'http://lpf.app',
        //logLevel: "debug|info|silent",
        logFileChanges: false,
        reloadOnRestart: true
    });
});

gulp.task('panel-watch', shell.task([
    'gulp panel-default watch'
]));

gulp.task('panel-default', ['panel-sass', 'panel-styles', 'panel-scripts']);

if (argv.help) {
    console.log('/************** TASKS DISPONÍVEIS **************/');
    console.log('panel-libs: Processa libs do painel');
    console.log('panel-scripts: Processa scripts do painel');
    console.log('panel-styles: Processa styles do painel');
    console.log('panel-sass: Processa sass do painel');
    console.log('panel-watch: Watch do painel');
    console.log('/***********************************************/');
}