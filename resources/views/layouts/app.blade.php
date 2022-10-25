<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name', 'Laravel') }}</title>
    
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    
        {{-- Tomtom map --}}
        <script type="text/javascript" src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.20.0/maps/maps-web.min.js"></script>
    
        {{-- Tomtom searchbar --}}
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.1.2-public-preview.15/services/services-web.min.js"></script>
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js"></script>
        <script>
            (function() {
                window.SS = window.SS || {};
                SS.Require = function(callback) {
                    if (typeof callback === 'function') {
                        if (window.SS && SS.EventTrack) {
                            callback();
                        } else {
                            var siteSpect = document.getElementById('siteSpectLibraries');
                            var head = document.getElementsByTagName('head')[0];
                            if (siteSpect === null && typeof head !== 'undefined') {
                                siteSpect = document.createElement('script');
                                siteSpect.type = 'text/javascript';
                                siteSpect.src = '/__ssobj/core.js+ssdomvar.js+generic-adapter.js';
                                siteSpect.async = true;
                                siteSpect.id = 'siteSpectLibraries';
                                head.appendChild(siteSpect);
                            }
                            if (window.addEventListener) {
                                siteSpect.addEventListener('load', callback, false);
                            } else {
                                siteSpect.attachEvent('onload', callback, false);
                            }
                        }
                    }
                };
            })();
        </script>
    
        {{-- Delete confirmation --}}
        <script src="{{ asset('js/delete_confirmation.js') }}" defer></script>
    
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    
        {{-- Font awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    
        <!-- Styles -->
        <link rel='stylesheet' type='text/css'
            href='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox.css' />
        <link rel="stylesheet" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.20.0/maps/maps.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    </head>

<body class="bg-light">
    <div id="app">
        {{-- @include('includes.header') --}}

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img class="img fluid col-2" style="height: 30px;width:10px" src={{ asset('images/boolbnb_logo.png') }} alt="logo Air BnB">
                <a class="" href="{{ url('/') }}">

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('login') }}">Accedi</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('register') }}">Registrati</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-dark" href="{{ route('admin.flats.index') }}">Admin</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @include('includes.admin.alert')
            @yield('content')
        </main>
    </div>
</body>

</html>
