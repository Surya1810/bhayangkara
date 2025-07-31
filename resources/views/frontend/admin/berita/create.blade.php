@extends('frontend.layouts.app')

@section('title')
    Buat Berita
@endsection

@push('css')
    <script src="https://cdn.tiny.cloud/1/4ce77u0y45a0kxjxqgmq8hyqdgrqd8pdetaervdmri41d1qa/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#body', // Replace this CSS selector to match the placeholder element for TinyMCE
            // plugins: 'powerpaste advcode code table lists checklist',
            // toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table | alignleft aligncenter alignright alignjustify | outdent indent'
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
@endpush

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
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
                                <div class="form-group">
                                    <label for="title" class="mb-0 form-label col-form-label-sm">Judul</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" placeholder="Tulis judul berita"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="form-group">
                                        <label class="mb-0 form-label col-form-label-sm col-form-label-sm mt-2"
                                            for="image">Thumbnail <small class="text-danger">*Thumbnail ratio
                                                4:3</small></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="file" id="image" name="image"
                                                    accept="image/png, image/jpeg, image/jpg, image/webp">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="mb-0 form-label col-form-label-sm" for="categories">Categories</label>
                                        <select
                                            class="form-control categories select2 @error('categories') is-invalid @enderror"
                                            style="width: 100%;" id="categories" name="categories">
                                            <option></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('categories') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('categories')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <textarea name="body" id="body" placeholder="tulis berita anda...">{{ old('title') }}</textarea>
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
        //Initialize Select2 Elements
        $('.categories').select2({
            placeholder: "Choose categories",
            allowClear: true
        })

        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });
    </script>
@endpush
