const { EnvironmentPlugin, ProvidePlugin } = require("webpack");
const mix = require("laravel-mix");
const path = require("path");

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
mix.webpackConfig({
    plugins: [
        new EnvironmentPlugin({
            BASE_URL: "/"
        }),

        new ProvidePlugin({
            $: "jquery",
            "window.jQuery": "jquery",
            jquery: "jquery",
            jQuery: "jquery"
        })
    ],

    module: {
        rules: [
            {
                test: /node_modules(?:\/|\\).+\.js$/,
                loader: "babel-loader",
                include: [path.join(__dirname, "node_modules/bootstrap-vue")]
            }
        ]
    },

    resolve: {
        alias: {
            "~": path.join(__dirname, "resources/js"),
            node_modules: path.join(__dirname, "resources/js")
        }
    }
});

// TODO Temporary file for generating SCSS to CSS file
// mix.sass("resources/sass/app.scss", "public/css/app.css");

mix.js("resources/js/app.js", "public/js");
mix.copy("resources/assets/", "public/");
mix.copy(
    "node_modules/@fortawesome/fontawesome-free/webfonts",
    "public/webfonts"
);
mix.scripts(
    [
        "node_modules/jquery/dist/jquery.min.js",
        "node_modules/bootstrap/dist/js/bootstrap.min.js"
    ],
    "public/js/shared.js"
);
mix.styles(
    [
        "node_modules/bootstrap/dist/css/bootstrap.css",
        "node_modules/@fortawesome/font-awesome-free/css/font-awesome.css"
    ],
    "public/css/shared.css"
);
mix.styles("resources/assets/css/app.css", "public/css/app.css");

mix.version();
