/*
|--------------------------------------------------------------------------
| Elixir Asset Management
|--------------------------------------------------------------------------
*/

var elixir = require('laravel-elixir');

var paths  = {
    'panelCss'        : './public/panelv3/css/module/',
    'panelCssOutput'  : './public/panelv3/css/',
    'panelJs'         : './public/panelv3/js/',
    'publicCss'       : './public/assets/css/',
    'publicCssOutput' : './public/assets/css/',
    'publicJs'        : './public/assets/js/',
}

elixir.config.sourcemaps = false;

elixir(function(mix) {
    mix
        .styles([
            paths.panelCss + 'panel.css',
            paths.panelCss + 'login.css',
        ],  paths.panelCssOutput + 'panel.min.css')

        .styles([
            paths.publicCss + 'bootstrap.min.css',
            paths.publicCss + 'font-awesome.css',
            paths.publicCss + 'default.css',
            paths.publicCss + 'owl.carousel.css',
            paths.publicCss + 'owl.theme.css',
        ],  paths.publicCssOutput + 'default.min.css') 

        .scripts([
            paths.panelJs + 'panel.js',
        ],  paths.panelJs + 'panel.min.js')

        .scripts([
            paths.publicJs + 'jquery.min.js',
            paths.publicJs + 'bootstrap.min.js',
            paths.publicJs + 'common.js',
            paths.publicJs + 'owl.carousel.min.js',
            paths.publicJs + 'mask.js',
        ],  paths.publicJs + 'main.min.js')
});
