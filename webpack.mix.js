const cssImport = require('postcss-import')
const cssNesting = require('postcss-nesting')
const mix = require('laravel-mix')
const path = require('path')
const purgecss = require('@fullhuman/postcss-purgecss')
const tailwindcss = require('tailwindcss')


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
mix.css('resources/css/app.css', 'public/css/1.css')

mix.js('resources/js/app.js', 'public/js')
mix.js('resources/js/app_front.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css/app.css')
    .options({
        postCss: [
            cssImport(),
            cssNesting(),
            tailwindcss('tailwind.config.js'),
            ...mix.inProduction() ? [
                purgecss({
                    content: ['./resources/views/**/*.blade.php', './resources/js/**/*.vue'],
                    defaultExtractor: content => content.match(/[\w-/:.]+(?<!:)/g) || [],
                    whitelistPatternsChildren: [/nprogress/],
                }),
            ] : [],
        ],
    })
    .webpackConfig({
        output: { chunkFilename: 'js/[name].js?id=[chunkhash]' },
        resolve: {
            alias: {
                vue$: 'vue/dist/vue.js',
                '@': path.resolve('resources/js'),
            },
        },
        /*         module: {
                    rules: [{
                        test: /\.js$/,
                        exclude: /node_modules/,
                        loader: "babel-loader"
                    }]
                } */
    })
    .version()
    .sourceMaps()

// MediaManager
/* mix.sass('resources/assets/vendor/MediaManager/sass/manager.scss', 'public/assets/vendor/MediaManager/style.css')
    .copyDirectory('resources/assets/vendor/MediaManager/dist', 'public/assets/vendor/MediaManager') */