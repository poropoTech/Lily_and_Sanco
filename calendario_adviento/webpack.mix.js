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

mix.copyDirectory('resources/assets/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/img', 'public/img');
mix.copyDirectory('resources/assets/video', 'public/video');
mix.copyDirectory('resources/js/vendor', 'public/js/vendor');
mix.copyDirectory('resources/sass/backend/tinymce', 'public/css/tinymce');
mix.copyDirectory('node_modules/tinymce/skins', 'public/js/vendor/tinymce/skins');
mix.copyDirectory('node_modules/bootstrap-datepicker/js/locales', 'public/js/vendor/bootstrap-datepicker/js/locales');
mix.setPublicPath('public')
    .setResourceRoot('../') // Turns assets paths in css relative to css file
    .vue()
    .sass('resources/sass/frontend/app.scss', 'css/frontend.css')
    .sass('resources/sass/backend/app.scss', 'css/backend.css')
    .js('resources/js/frontend/app.js', 'js/frontend.js')
    .js('resources/js/backend/app.js', 'js/backend.js')
    .extract([
        'alpinejs',
        'jquery',
        'bootstrap',
        'bootstrap-datepicker',
        'popper.js',
        'axios',
        'sweetalert2',
        'lodash',
        'cropperjs',
        'emojionearea',
        'infinite-scroll',
        'isotope-layout'
    ])
    .sourceMaps();

if (mix.inProduction()) {
    mix.version();
} else {
    // Uses inline source-maps on development
    mix.webpackConfig({
        devtool: 'inline-source-map'
    });
}
