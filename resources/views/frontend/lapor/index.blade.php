@extends('frontend.layouts.app')

@section('title')
    Lapor
@endsection

@push('css')
@endpush

@section('content')
    <div class="container my-3">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="text-center"><strong>Lapor</strong></h2>
                <p>Silahkan laporkan kejadian yang anda alami.
                </p>
                <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Nama sesuai KTP" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="ktp" class="form-label">KTP</label>
                                <input type="text" class="form-control @error('ktp') is-invalid @enderror" id="ktp"
                                    name="ktp" placeholder="Nomor NIK" value="{{ old('ktp') }}">
                                @error('ktp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="phone" class="form-label">Telepon</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" placeholder="Nomor yang dapat dihubungi"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label for="kronologis" class="form-label">Kronologis</label>
                                <textarea class="form-control @error('kronologis') is-invalid @enderror" name="kronologis" id="kronologis"
                                    rows="6">{{ old('kronologis') }}</textarea>
                                @error('kronologis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label for="file" class="form-label">Bukti <small class="text-danger">*Hanya gambar, max
                                        10MB</small></label>
                                <input class="form-control @error('file') is-invalid @enderror" type="file"
                                    id="file" name="file" accept="image/*" required>
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger rounded-pill mt-3 text-center">Upload</button>
                    </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
