const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.copyDirectory('resources/css', 'public/custom-css');
mix.copy('node_modules/corejs-typeahead/dist/typeahead.bundle.min.js', 'public/typeahead');
mix.copyDirectory('resources/img', 'public/img');

