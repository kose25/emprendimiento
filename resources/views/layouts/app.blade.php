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
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        @media (min-width: 576px) {
            .carousel-item img {
                width: auto !important;
                height: 100px;
                max-height: 100px;
            }
        }
    </style>
</head>

<body>
    <div id="particles-js" style="position: absolute; width: 100%; height: 100%;"></div>
    <div id="app" style=" background-image: url('{{ asset('img/Mesa de trabajo 1 copia 2-min.png') }}'); background-position: center; background-repeat: no-repeat;  background-size: cover; ">
        <nav class="navbar navbar-expand-md navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/ISOTIPO RED REGIONAL DE EMPRENDIMIENTO.svg') }}" width="30" height="30" class="d-inline-block align-top" alt="">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
            @yield('content')

        </main>
        <!-- Footer -->
        <footer class="page-footer font-small bg-dark text-white pt-4">



            <!-- Footer Links -->
            <div class="container-fluid text-center text-md-left">


                <!-- Grid row -->
                <div class="row">

                    <!-- Grid column -->
                    <div class="col-md-6 mt-md-0 mt-3">

                        <!-- Content -->
                        <h5 class="text-uppercase">{{ config('app.name', 'Laravel') }}</h5>
                        <p>Edif. Cámara de Comercio de Cúcuta – Calle 10 No 4-38 - PBX 57-7-5880110 / 5880111
                            <br>E-mail: <a href="mailto:cindoccc@cccucuta.org.co" target="_blank">cindoccc@cccucuta.org.co</a> / <a href="https://www.cccucuta.org.co/" target="_blank">www.cccucuta.org.co</a><br>
                            Cúcuta - Norte de Santander - Colombia
                        </p>

                    </div>
                    <!-- Grid column -->

                    <hr class="clearfix w-100 d-md-none pb-3">

                    <!-- Grid column -->
                    <div class="col-md-2 mb-md-0 mb-3 offset-md-2 d-none d-md-block">
                        <img src="{{asset('img/LOGO-CAMARA-COMERCIO-BLANCO-2.png')}}" class="img-fluid" alt="">


                        {{-- <!-- Links -->
                        <h5 class="text-uppercase">Links</h5>

                        <ul class="list-unstyled">
                            <li>
                                <a href="#!">Link 1</a>
                            </li>
                            <li>
                                <a href="#!">Link 2</a>
                            </li>
                            <li>
                                <a href="#!">Link 3</a>
                            </li>
                            <li>
                                <a href="#!">Link 4</a>
                            </li>
                        </ul>--}}

                    </div>
                    <!-- Grid column -->
                    <!-- Grid column -->
                    <div class="col-5 mb-md-0 mb-3 offset-1 d-md-none">
                        <img src="{{asset('img/LOGO-CAMARA-COMERCIO-BLANCO-2.png')}}" class="img-fluid" alt="">


                        {{-- <!-- Links -->
                        <h5 class="text-uppercase">Links</h5>

                        <ul class="list-unstyled">
                            <li>
                                <a href="#!">Link 1</a>
                            </li>
                            <li>
                                <a href="#!">Link 2</a>
                            </li>
                            <li>
                                <a href="#!">Link 3</a>
                            </li>
                            <li>
                                <a href="#!">Link 4</a>
                            </li>
                        </ul>--}}

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 mb-md-0 mb-3 d-none d-md-block">

                        <img src="{{asset('img/LOGO-ALCALDIA---BLANCO.png')}}" class="img-fluid" alt="">


                        {{--<!-- Links -->
                        <h5 class="text-uppercase">Links</h5>

                        <ul class="list-unstyled">
                            <li>
                                <a href="#!">Link 1</a>
                            </li>
                            <li>
                                <a href="#!">Link 2</a>
                            </li>
                            <li>
                                <a href="#!">Link 3</a>
                            </li>
                            <li>
                                <a href="#!">Link 4</a>
                            </li>
                        </ul>--}}

                    </div>
                    <!-- Grid column -->
                    <div class="col-5 mb-md-0 mb-3 d-md-none">

                        <img src="{{asset('img/LOGO-ALCALDIA---BLANCO.png')}}" class="img-fluid" alt="">


                        {{--<!-- Links -->
                        <h5 class="text-uppercase">Links</h5>

                        <ul class="list-unstyled">
                            <li>
                                <a href="#!">Link 1</a>
                            </li>
                            <li>
                                <a href="#!">Link 2</a>
                            </li>
                            <li>
                                <a href="#!">Link 3</a>
                            </li>
                            <li>
                                <a href="#!">Link 4</a>
                            </li>
                        </ul>--}}

                    </div>

                </div>
                <!-- Grid row -->

            </div>
            <!-- Footer Links -->
            <div class="container text-center">
                <!-- Section: Social media -->
                <p>Siguenos:</p>
                <section>
                    <!-- Facebook -->
                    <a class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/camaracucuta" role="button" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <!-- Twitter -->
                    <a class="btn btn-outline-light btn-floating m-1" href="https://twitter.com/cccucuta" role="button" target="_blank"><i class="fab fa-twitter"></i></a>
                    <!-- Instagram -->
                    <a class="btn btn-outline-light btn-floating m-1" href="https://www.instagram.com/camaracucuta/" role="button" target="_blank"><i class="fab fa-instagram"></i></a>
                </section>
                <!-- Section: Social media -->
            </div>

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3">© 2021 Copyright:
                <a href="#">{{ config('app.name', 'Laravel') }}</a>
            </div>
            <!-- Copyright -->

        </footer>
        <!-- Footer -->
    </div>


    <script>
        /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
        particlesJS.load('particles-js', "{{ asset('js/particles.json') }}", function() {
            console.log('callback - particles.js config loaded');
        });
    </script>
    <script>
        var x = document.getElementsByClassName("carousel-item");
        var i;
        for (i = 0; i < x.length; i++) {
            x[i].setAttribute("data-interval", "3000");
        }
    </script>
</body>

</html>