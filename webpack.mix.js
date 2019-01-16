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

mix
    // disabling auto file (url) copy
    .options({
        processCssUrls: false
    })

    // combining plain style sheets
    .styles([
        'resources/css/font.css',
        'resources/css/materialize.css',
        'resources/css/bs4utility.css',
        'resources/css/style.css'

    ], 'public/css/app.css')

    // compiling ES6 to ES5
    .js('resources/js/app.js', 'public/tmp/a.js')

    // combining plain JS
    .scripts([
        'public/tmp/a.js',
        'resources/js/jquery.js',
        'resources/js/materialize.js',
        'resources/js/script.js'

    ], 'public/js/app.js')

;
