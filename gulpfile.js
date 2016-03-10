var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.config.sourcemaps = false;


elixir(function(mix) {
    mix.sass('app.scss', 'resources/assets/css')
	    .styles([
	         'app.css',
             'font-awesome.css',
	         'lightslider.css',
	         'lity.css',
	         'photoswipe.css',
	         'default-skin/default-skin.css'
	    ])
        .scripts([
            'jquery-2.2.1.min.js',
            'bootstrap.min.js',
            'lightslider.js',
            'lity.js',
            'photoswipe.js',
            'photoswipe-ui-default.js'
        ]);
        // .version(["css/all.css", "js/all.js"]);
});
