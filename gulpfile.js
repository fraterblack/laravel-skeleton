// Tasks RequireJs
var gulp = require('gulp'),
    requireDir = require('require-dir');

//Tasks do Site
//requireDir('./gulp', { recurse: true });

//Tasks do Painel
requireDir('./gulp-panel', { recurse: true });