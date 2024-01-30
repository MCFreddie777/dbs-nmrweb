const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

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
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('tailwind.config.js')],
    })
    .browserSync(
        {
            host: '0.0.0.0',
            port: 3000,
            ui: false,
            open: false,
            proxy: 'http://localhost:8080/', // Proxy to webpack dev server
        },
        {
            // prevent BrowserSync from reloading the page
            // and let Webpack Dev Server take care of this
            reload: false
        }
    )
    .webpackConfig({
        devServer: {
            port: 8080,
            host: '0.0.0.0', // to accept connections from outside container
            disableHostCheck: true,

            watchOptions: {
                poll: 1000
            },
            writeToDisk: true,

            proxy: {
                "**": {
                    target: "http://nginx:80", // Proxy to backend
                    secure: false,
                },
            }
        }
    });
