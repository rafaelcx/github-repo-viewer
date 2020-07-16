<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset("css/app.css")}}">

        <title>{{config('app.name', 'RepoViewer')}}</title>
    </head>
    <body>
        @include('navbar')
        <div class="container">
            @yield('content')
        </div>

        <footer class="footer font-small blue">
            <div class="footer-copyright text-center py-3">© 2020 Copyright:
                <a href="https://mdbootstrap.com/">Bootstrap.com</a>
            </div>
        </footer>
    </body>
</html>
