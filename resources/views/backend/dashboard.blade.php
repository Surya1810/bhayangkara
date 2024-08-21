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
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary rounded-web">
                        <div class="inner">
                            <h3>0</h3>

                            <p>Our Client</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-clipboard-list"></i>
                        </div>
                        <a href="#" class="small-box-footer rounded-web">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
