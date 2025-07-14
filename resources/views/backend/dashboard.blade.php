@extends('backend.layouts.app')

@section('title')
    Dashboard
@endsection

@push('css')
@endpush

@section('content')
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline rounded-web card-danger">
                        <div class="card-body pb-0">
                            <h4>Hello, <strong>{{ Auth::user()->name }}</strong></h4>
                            <p>Selamat datang di <strong>Dashboard Partner Bhayangkara!</strong> Selamat bekerja...</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-3 col-6">
                    <a href="{{ route('posts.index') }}">
                        <div class="small-box bg-danger rounded-web">
                            <div class="inner">
                                <h3>{{ $total_berita }}</h3>

                                <p>Berita</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-solid fa-file-pen"></i>
                            </div>
                            <span class="small-box-footer rounded-web text-white">More info <i
                                    class="fas fa-arrow-circle-right"></i></span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <a href="{{ route('posts.approval') }}">
                        <div class="small-box bg-danger rounded-web">
                            <div class="inner">
                                <h3>{{ $total_approval_berita }}</h3>

                                <p>Approval Berita</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-solid fa-file-pen"></i>
                            </div>
                            <span class="small-box-footer rounded-web text-white">More info <i
                                    class="fas fa-arrow-circle-right"></i></span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <a href="{{ route('anggota.index') }}">
                        <div class="small-box bg-danger rounded-web">
                            <div class="inner">
                                <h3>{{ $total_anggota }}</h3>

                                <p>Daftar Anggota</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-solid fa-user"></i>
                            </div>
                            <span class="small-box-footer rounded-web text-white">More info <i
                                    class="fas fa-arrow-circle-right"></i></span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <a href="{{ route('anggota.approval') }}">
                        <div class="small-box bg-danger rounded-web">
                            <div class="inner">
                                <h3>{{ $total_approval_anggota }}</h3>

                                <p>Pendaftaran Anggota</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-solid fa-user"></i>
                            </div>
                            <span class="small-box-footer rounded-web text-white">More info <i
                                    class="fas fa-arrow-circle-right"></i></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
