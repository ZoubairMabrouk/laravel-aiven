const mix = require('laravel-mix');

mix.js('resources/js/app.jsx', 'public/js')
   .react() // Add this line if you are using React
   .sass('resources/sass/app.scss', 'public/css'); // If you have Sass files

// Versioning (cache-busting) files for production
if (mix.inProduction()) {
    mix.version();
}
