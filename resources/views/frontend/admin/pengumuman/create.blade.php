@extends('frontend.layouts.app')

@section('title')
    Unggah Pengumuman
@endsection

@push('css')
@endpush

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="card card-outline rounded-web card-secondary">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <h3 class="card-title">Tulis Berita</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul</label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Upload Gambar (200x800 px)</label>
                                    <input type="file" name="image" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="position" class="form-label">Posisi</label>
                                    <select name="position" class="form-select" required>
                                        <option value="left">Kiri</option>
                                        <option value="right">Kanan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer rounded-web">
                                <button type="submit" class="btn btn-warning rounded-web float-right">Upload</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });
    </script>
@endpush
