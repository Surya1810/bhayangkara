@extends('frontend.layouts.app')

@section('title')
    Berita
@endsection

@push('css')
@endpush

@section('content')
    <div class="container my-3">
        <div class="row g-5">
            <div class="col-md-8 bg-light">
                <article class="blog-post">
                    <img src="{{ asset('storage/post/' . $news->image) }}" class="d-block w-100 mb-3"
                        alt="{{ $news->slug }}">
                    <h2 class="display-5 link-body-emphasis mb-1"><strong>{{ $news->title }}</strong></h2>
                    <p class="blog-post-meta"> {{ \Carbon\Carbon::parse($news->created_at)->format('M d') }}</p>
                    {!! $news->body !!}
                </article>
            </div>
            <div class="col-md-4">
                <div class="position-sticky" style="top: 2rem;">
                    <div>
                        <h4 class="fst-italic">Berita Terbaru</h4>
                        <ul class="list-unstyled">
                            @foreach ($latest as $berita)
                                <li>
                                    <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
                                        href="#"> <img src="{{ asset('storage/post/' . $berita->image) }}"
                                            class="d-block w-100" alt="{{ $berita->slug }}" height="96">
                                        <div class="col-lg-8">
                                            <h6 class="mb-0">{{ Str::limit($berita->title, 50) }}</h6> <small
                                                class="text-body-secondary">{{ \Carbon\Carbon::parse($berita->created_at)->format('M d') }}</small>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
