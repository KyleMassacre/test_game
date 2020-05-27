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

mix.js('resources/themes/Default/js/app.js', 'public/Default/js')
   .sass('resources/themes/Default/sass/app.scss', 'public/Default/css');

// mix.js('resources/themes/Light/js/app.js', 'public/Light/js')
//     .sass('resources/themes/Light/sass/app.scss', 'public/Light/css');


