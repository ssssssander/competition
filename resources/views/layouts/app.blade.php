<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1", shrink-to-fit=no>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Wedstrijd') }} | @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('index') }}">Game Mania</a>
            </div>
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('participate') }}">Neem deel</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li>
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}">Login voor wedstrijdverantwoordelijke</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    @yield('content')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
