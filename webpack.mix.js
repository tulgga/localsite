let mix = require('laravel-mix');

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


mix.setPublicPath('public_html/');

mix.js('resources/assets/js/app.js', 'admin/js')
	.sass('resources/assets/sass/app.scss', 'admin/css');

mix.js('resources/main/js/app.js', 'main/js')
    .sass('resources/main/sass/app.scss', 'main/css');
