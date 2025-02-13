let mix = require('laravel-mix');

mix.js('resources/assets/backend/js/app.js', 'public/js')
   .sass('resources/assets/backend/sass/app.scss', 'public/css')
   .version();