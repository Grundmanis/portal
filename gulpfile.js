const elixir = require('laravel-elixir');

require('laravel-elixir-livereload');
require('laravel-elixir-vue-2');
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

elixir(function (mix) {
    mix.sass("app.scss");
    mix.webpack('app.js');
    mix.webpack('bootstrap.js');
    mix.webpack('main.js');
    mix.livereload();
});