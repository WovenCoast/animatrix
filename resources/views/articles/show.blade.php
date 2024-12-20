@extends('layout')

@section('content')
    <div class="container">
        <section aria-label="header">
            <div class="flex justify-between align-middle">
                <h1 class="card-title fw-bold align-items-top">
                    @if(! $article->published)
                        <span class="badge fs-4 rounded-pill text-bg-secondary">DRAFT</span>
                    @endif
                    {{ $article->title }}
                </h1>
                @include('components.action-buttons', ["article" => $article, "show" => ["edit", "delete"]])
            </div>
            <br>
            <h6>{{ $article->published_at->format('j F Y') }}</h6>
        </section>

        <img
            class="my-6 w-full"
            src="{{ $article->featured_image->getFullUrl("large") }}"
            alt="{{ $article->title }}"
        >

        <section aria-label="content" class="flex justify-center">
            <div class="w-[48em]">
                {!! $article->content !!}
            </div>
        </section>
    </div>
@endsection
