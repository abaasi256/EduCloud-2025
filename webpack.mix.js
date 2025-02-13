const mix = require('laravel-mix');
const path = require('path');

mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js')
        }
    }
}).options({
    processCssUrls: false,
    postCss: [require('autoprefixer')]
});

// Only copy existing directories 
mix.copyDirectory('resources/assets/frontend/flags', 'public/frontend/flags')
   .copyDirectory('resources/assets/frontend/fonts', 'public/frontend/fonts')
   .js('resources/assets/backend/js/app.js', 'public/js')
   .js('resources/assets/frontend/js/libs.js', 'public/frontend/js')
   .sass('resources/assets/backend/sass/app.scss', 'public/css')
   .sass('resources/assets/frontend/sass/libs.scss', 'public/frontend/css')
   .version();