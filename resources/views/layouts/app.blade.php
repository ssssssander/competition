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

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootbox.min.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/override.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-inverse text-uppercase">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Iron Maiden logo">
                </a>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ route('index') }}" {{ Route::is('index') ? 'class=active' : null }}>Home</a>
                    </li>
                    <li>
                        <a href="{{ route('participate') }}" {{ Route::is('participate') ? 'class=active' : null }}>Deelnemen</a>
                    </li>
                    <li>
                        <a href="{{ route('vote') }}" {{ Route::is('vote') ? 'class=active' : null }}>Stem</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        <li>
                            <a href="{{ route('dashboard') }}" {{ Route::is('dashboard') ? 'class=active' : null }}>Dashboard</a>
                        </li>
                        <li>
                            <a>
                                {!! Form::open(['route' => 'logout']) !!}
                                {!! Form::submit('Log uit') !!}
                                {!! Form::close() !!}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}" {{ Route::is('login') ? 'class=active' : null }}><small>Admin login</small></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('main')

    <!-- Inline script -->
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip({
                trigger : 'hover'
            });
        });
    </script>
</body>
</html>
