<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>广东贷款网</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="http://www.61tk.com/themes/default/css/amazeui.css" />
    <link rel="stylesheet" href="http://www.61tk.com/themes/default/css/style.css" />
    @yield('style')
</head>

<body data-type="index">
    @yield('content')
</body>

<script src="{{ url('build/admin/js/jquery.min.js') }}"></script>
<script src="{{ url('build/admin/js/amazeui.min.js') }}"></script>
@yield('script')
</html>