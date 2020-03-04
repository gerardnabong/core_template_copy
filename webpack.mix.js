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

mix.scripts(["resources/assets/js/jquery.min.js"], "public/js/scripts.js");

mix.js("resources/js/app.js", "public/js").sass(
    "resources/sass/app.scss",
    "public/css"
);

mix.styles(
    [
        "node_modules/bootstrap/dist/css/bootstrap.css",
        "node_modules/@fortawesome/font-awesome-free/css/font-awesome.css"
    ],
    "public/css/shared.css"
);

mix.copy("resources/assets/images/", "public/images/");
mix.copy("node_modules/@fortawesome/font-awesome-free/scss", "public/scss");

mix.scripts(
    [
        "node_modules/jquery/dist/jquery.min.js",
        "node_modules/bootstrap/dist/js/bootstrap.min.js"
    ],
    "public/js/shared.js"
);

mix.version();
