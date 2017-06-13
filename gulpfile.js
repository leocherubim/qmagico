var elixir = require('laravel-elixir'),
    bowerDir = "vendor/bower_components/";
    assetsDir = "resources/assets/";

elixir(function(mix) {
    mix.copy(bowerDir + 'bootstrap/fonts', 'public/fonts')

    	.copy(bowerDir + 'jquery/dist/jquery.min.js', 'resources/assets/js')
        .copy(bowerDir + 'bootstrap/dist/js/bootstrap.min.js', 'resources/assets/js')
        .copy(bowerDir + 'angular/angular.min.js', 'resources/assets/js')
        .copy(bowerDir + 'angular-resource/angular-resource.min.js', 'resources/assets/js')
        .copy(bowerDir + 'angular-route/angular-route.min.js', 'resources/assets/js')

        .scripts([
            'jquery.min.js',
            'bootstrap.min.js',
            'angular.min.js',
            'angular-resource.min.js',
            'angular-route.min.js',
            'app/main.js',
            'app/controllers/forum-controller.js'

        ], 'public/js/scripts.js')

        .less('app.less');
});
