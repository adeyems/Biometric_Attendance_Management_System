<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
             {{--   <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Queen Ede Secondary School') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
--}}
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="/"> <img src="{{ asset('images/logo.jpg') }}" style="max-width: 150px; max-height: 100px" alt="Logo"></a>
                        </li>
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
                        {{--</li>--}}
                    </ul>
                        <div class="col-md-10" style="font-size: medium">
                           ONLINE STUDENT MONITORING SYSTEM USING FINGERPRINT SCANNER
                        </div>
                    <!-- Right Side Of Navbar -->
                    @if(session()->has('user'))
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a> <img src="{{ asset('images/user-alt.png') }}" style="max-width: 32px; max-height: 32px"></a>
                        </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}">{{ __('Logout') }}</a>
                            </li>
                    </ul>
                    @endisset
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
