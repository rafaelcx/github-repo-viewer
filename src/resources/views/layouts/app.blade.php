<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name', 'RepoViewer')}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
    <body>
    @include('navbar')
    <div class="container mt-5">
        @yield('content')
    </div>

    <footer class="footer font-small black">
        <div class="container footer-copyright text-center py-3">
            <span>© 2020 Copyright: <a href="https://github.com/rafaelcx">Github.com</a></span>
        </div>
    </footer>
</body>
</html>
