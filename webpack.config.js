const path = require('path');

module.exports = {
    devtool: "source-map",
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
    module: {
        rules: [
            {
                test: /\.(postcss)$/,
                use: [
                    'vue-style-loader',
                    { loader: 'css-loader', options: { importLoaders: 1 } },
                    'postcss-loader'
                ]
            }
        ]
    }
};
