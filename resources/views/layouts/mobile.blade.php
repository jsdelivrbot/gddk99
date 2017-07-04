<!doctype html>
<html class="no-js fixed-layout">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <title>@yield('title', trans('welcome.mobile'))</title>
    <link rel="stylesheet" href="{{ elixir('css/all.css') }}"/>
    <style rel="stylesheet">
        .am-gotop-fixed {
            bottom: 0px;
            z-index: 1010;
            opacity: 0;
            width: 100%;
            min-height: 0;
            overflow: hidden;
            border-radius: 0;
        }
        .am-gotop-fixed, .am-gotop-one {
            text-align: center;
            right: 0px;
            position: fixed;
        }
        .pet_head_block {
            background: #0ba4ea;
            max-width: 640px;
            margin: 0 auto;
            line-height: 53px;
        }
        .pet_news_list_tag_name {
            display: block;
            width: 100%;
            text-align: center;
            line-height: 49px;
            color: #fff;
        }
        .am-modal {
            width: auto;
            position: fixed;
            display: none;
            z-index: 1110;
            left: 60%;
            margin-left: -135px;
            margin-top: 0;
            top: 30%;
            text-align: center;
            border-radius: 0;
            opacity: 0;
            -webkit-transform: translate3d(0,0,0) scale(1.185);
            transform: translate3d(0,0,0) scale(1.185);
            -webkit-transition-property: -webkit-transform,opacity;
            transition-property: transform,opacity;
        }
        .pet_content_article {
            padding: 0px 8px 0;
        }
    </style>
    @yield('style')
</head>
<body style="background:#ececec">
<div class="pet_mian">
    @yield('content')
</div>
</body>
<script src="{{ elixir('js/jquery.js') }}"></script>
<script src="{{ elixir('js/all.js') }}"></script>
<script src="{{ asset('build/layer/layer.js') }}"></script>
    @yield('script')
</html>