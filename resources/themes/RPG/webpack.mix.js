const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../../public/RPG').mergeManifest();

mix.webpackConfig(webpack => {
    return {
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                'global.jQuery': 'jquery',
                Popper: ['popper.js', 'default']
            })
        ]
    };
});


mix.js(__dirname + '/assets/js/app.js', 'js/app.js')
    .sass( __dirname + '/assets/sass/app.scss', 'css/app.css')
    .options({
        processCssUrls: false
    });

if (mix.inProduction()) {
    mix.version();
}
