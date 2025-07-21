@extends('frontend.layouts.app')

@section('title')
    Beranda
@endsection

@push('css')
    <style>
        .pagination {
            margin: 0;
            padding: 0;
        }

        .pagination .page-item .page-link {
            border-radius: 0.375rem;
            color: #0d6efd;
            border: 1px solid #dee2e6;
            margin: 0 2px;
            padding: 0.375rem 0.75rem;
            transition: all 0.2s ease-in-out;
        }

        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            color: white;
            border-color: #0d6efd;
        }

        .pagination .page-item .page-link:hover {
            background-color: #e9ecef;
            text-decoration: none;
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
        }
    </style>
@endpush

@section('content')
    <!-- Higlight -->
    <section class="mb-4">
        <div class="container my-5">
            <h2><strong>Berita</strong></h2>
            <div class="row mt-2">

                @foreach ($beritas as $berita)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <a href="{{ route('detail.berita', $berita->slug) }}" class="text-decoration-none text-black">
                                <div class="row g-0 h-100">
                                    <div class="col-md-6">
                                        <div
                                            style="position: relative; width: 100%; padding-top: 56.25%; overflow: hidden; border-top-left-radius: 0.375rem; border-bottom-left-radius: 0.375rem;">
                                            <img src="{{ asset('storage/post/' . $berita->image) }}"
                                                alt="{{ $berita->slug }}"
                                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; display: block;">

                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex flex-column justify-content-between p-3">
                                        <div>
                                            <strong class="d-inline-block mb-2 text-danger">
                                                {{ optional($berita->category)->name ?? '-' }}
                                            </strong>
                                            <div class="mb-1 text-body-secondary">
                                                {{ \Carbon\Carbon::parse($berita->created_at)->format('M d') }} -
                                                {{ $berita->user->name }}
                                            </div>
                                            <h5 class="card-title mb-2">{{ Str::limit($berita->title, 50) }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-center mt-4">
                    {{ $beritas->links() }}
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
