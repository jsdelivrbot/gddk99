<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>广东贷款网后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{ url('build/admin/css/amazeui.min.css') }}" />
    <link rel="stylesheet" href="{{ url('build/admin/css/admin.css') }}" />
    <link rel="stylesheet" href="{{ url('build/admin/css/app.css') }}" />
</head>

<body data-type="login">

<div class="am-g myapp-login">
    <div class="myapp-login-logo-block  tpl-login-max">
        <div class="myapp-login-logo-text">
            <div class="myapp-login-logo-text">
                广东贷款网<span> 后台管理系统</span> <i class="am-icon-skyatlas"></i>
            </div>
        </div>

        <div class="login-font"></div>
        <div class="am-u-sm-10 login-am-center">
            {!! Form::open(['url'=>'admin/login','method'=>'POST','class'=>'am-form','data-am-validator']) !!}
                <fieldset>
                    <div class="am-form-group">
                        <input type="text" class="" id="user_mobile" name="user_mobile" placeholder="输入手机号" required>
                    </div>
                    <div class="am-form-group">
                        <input type="password" class="" id="password" name="password" pattern="^\d{6}$" placeholder="输入密码" required>
                    </div>
                    <p><button type="submit" class="am-btn am-btn-default">登录</button></p>
                </fieldset>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script src="{{ url('build/admin/js/jquery.min.js') }}"></script>
<script src="{{ url('build/admin/js/amazeui.min.js') }}"></script>
<script src="{{ url('build/admin/js/app.js') }}"></script>
<script src="{{ asset('build/layer/layer.js') }}"></script>

@if(Session::has('message'))
    @if(Session::get('message')==1)
        <script>layer.msg('手机号不存在或者无权访问!', {icon: 5}); </script>
    @elseif(Session::get('message')==0)
        <script>layer.msg('密码错误!', {icon: 5}); </script>
    @elseif(Session::get('message')==2)
        <script>layer.msg('您无权访问该资源，请登陆！', {icon: 5}); </script>
    @elseif(Session::get('message')==3)
        <script>layer.msg('退出成功!', {icon: 6}); </script>
    @endif
@elseif(count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script>layer.msg('{{ $error }}', {icon: 5}); </script>
        @endforeach
@endif

</body>
</html>