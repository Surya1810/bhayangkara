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

    <!-- Sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open Sans:400,500,600,700,800,900&display=swap"
        rel="stylesheet" />

    <!-- Our style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style_fe.css') }}">

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/4ce77u0y45a0kxjxqgmq8hyqdgrqd8pdetaervdmri41d1qa/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#desc',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks| bold italic | bullist numlist | code | table | alignleft aligncenter alignright alignjustify | indent outdent'
        });
    </script>

    <style>
        .background-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image: url('{{ asset('assets/img/background/2.jpg') }}');
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
                <span class="fs-6 ms-2 text-danger"><strong>Partner Bhayangkara</strong></span>
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
                        <a class="nav-link mx-2 text-black" aria-current="page" href="{{ route('redaksi') }}">Tim
                            Redaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 text-black" aria-current="page" href="{{ route('lapor') }}">Lapor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 text-black" aria-current="page" href="{{ route('kontak') }}">Kontak</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <button
                                class="nav-link dropdown-toggle text-black {{ request()->is('posts*') ? 'active' : '' }}"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">Admin</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('posts.create') }}">Buat Berita</a></li>
                                @if (Auth::user()->role == 'Admin')
                                    <li><a class="dropdown-item" href="{{ route('posts.index') }}">Approval Berita</a></li>
                                    <li><a class="dropdown-item" href="{{ route('anggota.index') }}">Approval
                                            Pendaftaran</a>
                                    </li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="nav-scroller bg-danger shadow-sm">
        <div class="container">
            <nav class="nav" aria-label="Secondary navigation">
                <a class="nav-link active text-decoration-none text-white"
                    aria-current="page"><strong>{{ $time->toFormattedDateString() }}</strong></a>

                @foreach ($categories as $category)
                    <a href="{{ route('kategori', $category->slug) }}" class="nav-link text-white">
                        {{ $category->name }}</a>
                @endforeach
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <main style="min-height: 100svh">
        @yield('content')
    </main>

    <!-- Main Footer -->
    <footer class="bg-dark">
        <div class="container pt-5 pb-2">
            <div class="row">
                <div class="col-12 col-md-5 mb-3">
                    <a href="{{ route('landing') }}"
                        class="d-flex align-items-center mb-5 link-body-emphasis text-decoration-none">
                        <img src="{{ asset('assets/img/logo/main_logo.png') }}" alt="PWRI-B" height="80px">
                        <span class="fs-4 ms-2 text-danger"><strong>Partner Bhayangkara</strong></span>
                    </a>
                    <p class="text-danger">Media Online Mitra Polri</p>
                    <p class="text-light">
                        <i class="fa-solid fa-location-dot me-3"></i>
                        Jl. Tubagus Ismail VIII No.41 RT.002 RW.010, Kelurahan Sekeloa, Kecamatan Coblong, Kota
                        Bandung
                    </p>
                    <p class="text-light">
                        <i class="fa-solid fa-envelope-open-text me-3"></i>
                        partnernewsbhayangkara@gmail.com
                    </p>
                </div>
                <div class="col-md-1"></div>
                <div class="col-6 col-md-3 mb-3">
                    <h5 class="text-danger">MENU</h5>
                    <hr class="text-light">
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="{{ route('landing') }}"
                                class="nav-link p-0 text-light">Beranda</a>
                        </li>
                        <li class="nav-item mb-2"><a href="{{ route('tentang') }}"
                                class="nav-link p-0 text-light">Tentang Kami</a>
                        </li>
                        <li class="nav-item mb-2"><a href="{{ route('redaksi') }}"
                                class="nav-link p-0 text-light">Tim
                                Redaksi</a>
                        </li>
                        <li class="nav-item mb-2"><a href="{{ route('lapor') }}"
                                class="nav-link p-0 text-light">Lapor</a>
                        </li>
                        <li class="nav-item mb-2"><a href="{{ route('kontak') }}"
                                class="nav-link p-0 text-light">Kontak</a>
                        </li>
                        @guest
                            <li class="nav-item mb-2"><a href="{{ route('login') }}"
                                    class="nav-link p-0 text-light">Masuk</a>
                            </li>
                            <li class="nav-item mb-2"><a href="{{ route('register') }}"
                                    class="nav-link p-0 text-light">Daftar</a>
                            </li>
                        @endguest
                    </ul>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <h5 class="text-danger">KATEGORI</h5>
                    <hr class="text-light">
                    <ul class="nav flex-column">
                        @foreach ($categories as $category)
                            <li class="nav-item mb-2"><a href="{{ route('kategori', $category->slug) }}"
                                    class="nav-link p-0 text-light">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row text-center pt-4 mt-4 mb-3 border-top text-light">
                <small>&copy; Copyright 2025 <strong class="text-danger">Partner Bhayangkara</strong> - All rights
                    reserved.</small>
            </div>
        </div>
    </footer>

    <!-- Back to top button -->
    <button type="button" class="btn btn-dark btn-floating btn-lg shadow-lg " id="btn-back-to-top"
        aria-label="Back to Top">
        <i class="fas fa-angle-up fa-2xl text-center" style="color: #fff"></i>
    </button>

    <!-- REQUIRED SCRIPTS -->

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>

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

    <!-- Sweetalert2 -->
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true
        })

        @if (session('pesan'))
            @switch(session('level-alert'))
                @case('alert-success')
                Toast.fire({
                    icon: 'success',
                    title: '{{ Session::get('pesan') }}'
                })
                @break

                @case('alert-danger')
                Toast.fire({
                    icon: 'error',
                    title: '{{ Session::get('pesan') }}'
                })
                @break

                @case('alert-warning')
                Toast.fire({
                    icon: 'warning',
                    title: '{{ Session::get('pesan') }}'
                })
                @break

                @case('alert-question')
                Toast.fire({
                    icon: 'question',
                    title: '{{ Session::get('pesan') }}'
                })
                @break

                @default
                Toast.fire({
                    icon: 'info',
                    title: '{{ Session::get('pesan') }}'
                })
            @endswitch
        @endif
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                Toast.fire({
                    icon: 'error',
                    title: '{{ $error }}'
                })
            @endforeach
        @endif
    </script>

    @stack('scripts')
</body>

</html>
