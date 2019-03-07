const ExtractTextPlugin = require( 'extract-text-webpack-plugin' );
const debug = process.env.NODE_ENV !== 'production';
const path = require('path');
const webpack = require('webpack');

// Extract style.css for both editor and frontend styles.
const pluginCSSPlugin = new ExtractTextPlugin( {
	filename: 'styles/main.css',
} );

var plugins = [
    pluginCSSPlugin,
    new webpack.ProvidePlugin({
        $: 'jquery',
        'window.jQuery': 'jquery',
        'window.$': 'jquery',
        jQuery: 'jquery',
        IScroll: 'iscroll',
        AOS: 'aos'
    }),
];

const scssConfig = [
    {
      loader: 'css-loader',
      options: {
        sourceMap: debug
      }
    },
    {
      loader: 'sass-loader',
      options: {
        sourceMap: debug
      }
    }
];

var config = {
    context: __dirname,
    devtool: debug ? 'inline-sourcemap' : false,
    mode: debug ? 'development' : 'production',
    entry: {
        'main': path.resolve(__dirname, 'resources/js/main.js'),
    },
    output: {
        path: __dirname + '/dist/',
        filename: 'scripts/[name].js',
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: [
                    {
                        loader: 'babel-loader'
                    }
                ]
            },
            {
                test: /main\.scss$/,
                exclude: /node_modules/,
                use: pluginCSSPlugin.extract(scssConfig)
            }
        ]
    },
    plugins: plugins,
    resolve: {
        extensions: ['.js', '.css', '.scss'],
        alias: {
            wow: path.join(__dirname, '/node_modules/wowjs/css/libs/animate.css')
        }
    }
};

module.exports = (env, argv) => {
    return config;
};