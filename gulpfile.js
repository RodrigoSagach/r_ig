var elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('user.scss')
    	.styles([
        	'./bower_components/bootstrap/dist/css/bootstrap.css',
    	], 'public/css/vendor-user.css')
        .scripts([
            './bower_components/jquery/dist/jquery.min.js',
            './bower_components/jquery-ui/jquery-ui.min.js',
            './bower_components/bootstrap/dist/js/bootstrap.js',
            './bower_components/enquire/dist/enquire.js',
            './bower_components/velocity/velocity.js',
            './bower_components/velocity/velocity.ui.js',
            './resources/assets/js/plugins/wijets/wijets.js',
            './bower_components/nanoscroller/bin/javascripts/jquery.nanoscroller.js',
            './bower_components/bootstrap-material-design/dist/js/material.js',
            './bower_components/bootstrap-material-design/dist/js/ripples.js',
            './node_modules/Flot/jquery.flot.js',
            './node_modules/Flot/jquery.flot.resize.js'
        ], 'public/js/vendor-user.js');
});
