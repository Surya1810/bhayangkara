<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="keywords" content="Partner, Bhayangkara, wartawan, indonesia, PWRIB">
    <meta name="author" content="Partner Bhayangkara">

    <title>@yield('title') | Partner Bhayangkara</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/FontAwesome/6.2.1/css/all.min.css') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open Sans:400,500,600,700,800,900&display=swap"
        rel="stylesheet" />

    <!-- Our style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_fe.css') }}">

    <style>
        .background-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image: url('{{ asset('assets/img/background/1.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .background-wrapper::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7);
        }
    </style>

    @stack('css')
</head>

<body style="padding-top: 85px">
    <div class="background-wrapper"></div>
    @php
        $time = Carbon\Carbon::now();
    @endphp
    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light shadow" aria-label="Main navigation">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <img src="{{ asset('assets/img/logo/main_logo.png') }}" alt="logo" height="60">
            </a>
            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse offcanvas-collapse justify-content-end bg-light" id="navbarsExampleDefault">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link mx-2 text-black" aria-current="page"
                            href="{{ route('landing') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 text-black" aria-current="page" href="{{ route('tentang') }}">Tentang
                            Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 text-black" aria-current="page" href="{{ route('kontak') }}">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="nav-scroller bg-body shadow-sm">
        <div class="container">
            <nav class="nav" aria-label="Secondary navigation">
                <a class="nav-link active text-decoration-none"
                    aria-current="page">{{ $time->toFormattedDateString() }}</a>
                <a class="nav-link"><i class="fa-solid fa-envelope"></i>
                    partnernewsbhayangkara@gmail.com</a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <main style="min-height: 100svh">
        @yield('content')
    </main>

    <!-- Main Footer -->
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-body-secondary">© 2025 <strong>Partner Bhayangkara</strong></p> <a
                href="{{ route('landing') }}"
                class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
                aria-label="Bootstrap"> <img src="{{ asset('assets/img/logo/main_logo.png') }}" alt="logo"
                    height="60"></a>
            <ul class="nav col-md-4 justify-content-end">
                @guest
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link px-2 text-body-secondary">Masuk</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('register') }}"
                            class="nav-link px-2 text-body-secondary">Daftar</a></li>
                @endguest

                @auth
                    <li class="nav-item"><a href="{{ route('dashboard') }}"
                            class="nav-link px-2 text-body-secondary">Halaman Admin</a></li>
                @endauth


            </ul>
        </footer>
    </div>

    <!-- Back to top button -->
    <button type="button" class="btn btn-dark btn-floating btn-lg shadow-lg " id="btn-back-to-top"
        aria-label="Back to Top">
        <i class="fas fa-angle-up fa-2xl text-center" style="color: #FFFFFF"></i>
    </button>

    <!-- REQUIRED SCRIPTS -->

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        (() => {
            'use strict'

            document.querySelector('#navbarSideCollapse').addEventListener('click', () => {
                document.querySelector('.offcanvas-collapse').classList.toggle('open')
            })
        })()
    </script>
    <script>
        //Back to Top Button
        let mybutton = document.getElementById("btn-back-to-top");

        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
            ) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        mybutton.addEventListener("click", backToTop);

        function backToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>

    @stack('scripts')
</body>

</html>
