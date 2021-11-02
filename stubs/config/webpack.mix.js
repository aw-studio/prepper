const mix = require('laravel-mix');
const path = require('path');

mix.ts('resources/js/app.ts', 'public/js').vue();

// In order to make the alias working correctly in VSCode, make shure to add
// the following lines to your settings.json:
//
// "path-intellisense.mappings": {
//     "/": "${workspaceFolder}",
//     "@": "${workspaceRoot}/resources/js"
// },
mix.alias({
    '@': path.join(__dirname, 'resources/js'),
});

mix.postCss('resources/css/app.css', 'public/css', [require('tailwindcss')]);
