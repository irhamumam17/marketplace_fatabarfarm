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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/lightbox2/dist/css/lightbox.css','public/css/vendor/lightbox2/css/lightbox.css')
    .copy('node_modules/lightbox2/dist/images/close.png','public/css/vendor/lightbox2/images/close.png')
    .copy('node_modules/lightbox2/dist/images/loading.gif','public/css/vendor/lightbox2/images/loading.gif')
    .copy('node_modules/lightbox2/dist/images/next.png','public/css/vendor/lightbox2/images/next.png')
    .copy('node_modules/lightbox2/dist/images/prev.png','public/css/vendor/lightbox2/images/prev.png')
    .copy('node_modules/filepond/dist/filepond.min.css','public/css/vendor/filepond/filepond.min.css')
    .copy('node_modules/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css','public/css/vendor/filepond-plugin-image-preview/filepond-plugin-image-preview.css');
