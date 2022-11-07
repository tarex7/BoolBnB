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


    {{-- Tomtom map --}}
    <script type="text/javascript" src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.20.0/maps/maps-web.min.js">
    </script>

    {{-- Tomtom searchbar --}}
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.1.2-public-preview.15/services/services-web.min.js">
    </script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js">
    </script>
    <!-- includes the Braintree JS client SDK -->
    <script src="https://js.braintreegateway.com/web/dropin/1.33.4/js/dropin.min.js"></script>

    <!-- includes jQuery -->
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
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
    <link href="{{ asset('css/custom-css.css') }}" rel="stylesheet">

</head>

<body class="bg-light">
    <div id="app" >


        <nav class="navbar navbar-expand-md main-nav shadow-sm d-flex justify-content-between">
            <a href="{{ url('/') }}">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-50 0 500 100" style="height:60px; width: 180px">
                    <defs>
                        <style>
                            .cls-1 {
                                font-size: 48.44px;
                                stroke: #fff;
                                stroke-miterlimit: 10;
                                stroke-width: 2px;
                                font-family: AdobeGothicStd-Bold-KSCpc-EUC-H, Adobe Gothic Std;
                            }

                            .cls-1,
                            .cls-2 {
                                fill: #fff;
                            }

                            .cls-2 {
                                font-size: 106.49px;
                                font-family: BrushScriptStd, Brush Script Std;
                            }
                        </style>
                    </defs>
                    <g id="Layer_2" data-name="Layer 2">
                        <g id="Layer_1-2" data-name="Layer 1"><text class="cls-1"
                                transform="translate(72.99 84.86)">oolBnB</text><text class="cls-2"
                                transform="translate(0 88.39)">B</text>
                        </g>
                    </g>
                </svg>
            </a>

            <div class="me-3" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->

                <ul class="navbar-nav d-flex">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('login') }}">Accedi</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('register') }}">Registrati</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <!-- Authentication Links -->
                            <div class="d-flex me-3 justify-content-center w-100" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-dark mx-3 text-white" href="{{ route('admin.flats.index') }}">
                                    I miei appartamenti
                                </a>
                                <a class="dropdown-item text-white" href="{{ route('logout') }}"
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


        @include('includes.admin.alert')
        @yield('content')

    </div>
    @include('includes.footer')

</body>

</html>
