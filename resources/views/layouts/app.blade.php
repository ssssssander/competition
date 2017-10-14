<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="image/x-icon" rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-override.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-inverse text-uppercase">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Iron Maiden logo">
                </a>
            </div>
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route('index') }}" {{ Route::is('index') ? 'class=active' : null }}>Home</a>
                </li>
                <li>
                    <a href="{{ route('participate') }}" {{ Route::is('participate') ? 'class=active' : null }}>Deelnemen</a>
                </li>
                <li>
                    <a href="{{ route('vote_page') }}" {{ Route::is('vote_page') ? 'class=active' : null }}>Stem</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li>
                        <a href="{{ route('dashboard') }}" {{ Route::is('dashboard') ? 'class=active' : null }}>Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}">Log uit</a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}" {{ Route::is('login') ? 'class=active' : null }}>Log in</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    @yield('main')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>
