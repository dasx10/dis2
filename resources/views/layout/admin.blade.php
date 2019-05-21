<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @yield('head')
</head>
<body class="app">
    @yield('content')
    @yield('script')
</body>
</html>