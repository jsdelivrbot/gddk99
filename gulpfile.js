const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

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

elixir(mix => {

    //拷贝妹子CSS
    mix.styles([
        'resources/assets/amazeui/css/amazeui.min.css',
        'resources/assets/amazeui/css/animate.min.css',
        'resources/assets/amazeui/css/wap.css',
    ], 'public/css/all.css', './');

    //拷贝妹子JS
    mix.scripts([
        'resources/assets/amazeui/js/amazeui.lazyload.min.js',
        'resources/assets/amazeui/js/amazeui.min.js',
    ], 'public/js/all.js', './');

    mix.scripts([
        'resources/assets/amazeui/js/jquery.min.js'
    ], 'public/js/jquery.js', './');

    //拷贝妹子样式版本
    mix.version(['css/all.css', 'js/all.js','js/jquery.js'], 'public/build');
    //拷贝妹子字体
    mix.copy('resources/assets/amazeui/fonts', 'public/build/fonts');
    //拷贝妹子图片
    mix.copy('resources/assets/amazeui/img', 'public/build/img');

});
