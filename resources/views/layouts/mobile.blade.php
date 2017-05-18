<!doctype html>
<html class="no-js fixed-layout">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <title>{{ trans('welcome.mobile') }}</title>
    <link rel="stylesheet" href="{{ elixir('css/all.css') }}"/>
</head>
<body style="background:#ececec">
<div class="pet_mian">
    @yield('content')
</div>
</body>
<script src="{{ elixir('js/jquery.js') }}"></script>
<script src="{{ elixir('js/all.js') }}"></script>
    @yield('script')
</html>