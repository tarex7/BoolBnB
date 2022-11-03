<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/front.js') }}" defer></script>

    {{-- Tomtom map --}}
    <script type="text/javascript" src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.20.0/maps/maps-web.min.js">
    </script>

    {{-- Tomtom searchbar --}}
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.1.2-public-preview.15/services/services-web.min.js">
    </script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js">
    </script>
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


    <div class="container">
        <header style="position:fixed; top:0; left:0; right:0; z-index: 1">


            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm d-flex justify-content-between">
    
                <a href="{{ url('/') }}">
                    <img class="img-fluid  p-1" src={{ asset('images/boolbnb_logo.png') }} alt="logo Air BnB"
                        style="height:60px; width: 250px;">
    
                </a>
                
    
                <div class="d-flex" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul></ul>
    
                    <ul class="navbar mr-3 d-flex ">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item list-unstyled">
                                <a class="nav-link text-dark " href="{{ route('login') }}">Accedi</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item list-unstyled">
                                    <a class="nav-link text-dark list-unstyled mx-4" href="{{ route('register') }}">Registrati</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown list-unstyled">
    
    
                                <div class="d-flex " aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-dark mx-3 list-unstyled" href="{{ route('admin.flats.index') }}">
                                        I miei appartamenti
                                    </a>
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
    
                    <!-- Right Side Of Navbar -->
                </div>
    
            </nav>
        </header>
    </div>




    <div id="root"></div>
</body>

</html>
