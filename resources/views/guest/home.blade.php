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
    <link href="{{ asset('css/custom-css.css') }}" rel="stylesheet">

</head>

<body class="bg-light">


    <div class="container">
        <header style="position:fixed; top:0; left:0; right:0; z-index: 1">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">

                    <a href="{{ url('/') }}" class="col">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-50 0 500 100"
                            style="height:60px; width: 180px">
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
                                        fill: #dc143c;
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
                                        transform="translate(0 88.39)">B</text></g>
                            </g>
                        </svg>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse flex-grow-0" id="navbarTogglerDemo01">
                        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 d-flex ">
                            @guest
                                <li class="nav-item list-unstyled">
                                    <a class="nav-link text-dark  me-3 home-link text-end" href="{{ route('login') }}">Accedi</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item list-unstyled">
                                        <a class="nav-link text-dark text-end list-unstyled me-3 home-link "
                                            href="{{ route('register') }}">Registrati</a>
                                    </li>
                                @endif
                                @else
                                <a class="dropdown-item text-dark  text-end list-unstyled me-3 home-link"
                                        href="{{ route('admin.flats.index') }}">
                                        I miei appartamenti
                                    </a>
                                    <a class="dropdown-item text-end me-3 home-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none text-end">
                                        @csrf
                                    </form>
                                    @endguest
                            </ul>
                            
                        </div>
                    </div>
                </nav>


            </header>
        </div>




        <div id="root"></div>
    </body>

    </html>
