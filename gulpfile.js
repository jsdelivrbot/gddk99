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

    // *********************** 手机端 ******************

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

    // *********************** 后端端 ******************

    //拷贝妹子CSS
    mix.copy('resources/assets/adminamazeui/css', 'public/build/admin/css');
    //拷贝妹子js
    mix.copy('resources/assets/adminamazeui/js', 'public/build/admin/js');
    //拷贝妹子字体
    mix.copy('resources/assets/adminamazeui/fonts', 'public/build/admin/fonts');
    //拷贝妹子图片
    mix.copy('resources/assets/adminamazeui/i', 'public/build/admin/i');
    mix.copy('resources/assets/adminamazeui/img', 'public/build/admin/img');

    //拷贝弹层样式
    mix.copy('resources/assets/layer', 'public/build/layer');

});
