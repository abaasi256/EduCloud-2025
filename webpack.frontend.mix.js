let mix = require('laravel-mix');

mix.js('resources/assets/frontend/js/libs.js', 'public/frontend/js')
   .sass('resources/assets/frontend/sass/libs.scss', 'public/frontend/css')
   .copyDirectory('resources/assets/frontend/img', 'public/frontend/img')
   .copyDirectory('resources/assets/frontend/fonts', 'public/frontend/fonts')
   .copyDirectory('resources/assets/frontend/flags', 'public/frontend/flags')
   .version();