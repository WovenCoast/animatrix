@extends('layout')

@section('content')
    <div class="flex">
        <a href="{{ route("articles.create") }}" type="button" class="btn btn-primary mb-4 px-6 py-2 fw-semibold">
            <i class="fa-solid fa-plus"></i> Add New
        </a>
        @if (request()->has("drafts"))
            <a href="{{ request()->fullUrlWithoutQuery("drafts") }}" type="button" class="btn btn-primary mb-4 px-6 py-2 fw-semibold ml-3">
                <i class="fa-solid fa-eye"></i> View Only Published
            </a>
        @else
            <a href="{{ request()->fullUrlWithQuery(["drafts"=>1]) }}" type="button" class="btn btn-primary mb-4 px-6 py-2 fw-semibold ml-3">
                <i class="fa-solid fa-eye"></i> View Drafts
            </a>
        @endif
    </div>

    @foreach($articles as $article)
        <div class="card mb-3 border-0 shadow" >
            <div class="row g-0">
                <a class="col-md-4" href="{{ route("articles.show", $article->slug) }}">
                    <img
                        src="{{ $article->featured_image?->getFullUrl("thumb") }}"
                        class="h-full w-full object-cover"
                        alt="{{ $article->title }}"
                    />
                </a>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="flex justify-between align-middle">
                            <h5 class="card-title fw-bold">
                                @if(! $article->published)
                                    <span class="badge rounded-pill text-bg-secondary">DRAFT</span>
                                @endif
                                {{ $article->title }}
                            </h5>
                            @include('components.action-buttons', ["article" => $article, "show" => ["edit", "delete"]])
                        </div>
                        <p class="card-text">{{ $article->excerpt }}</p>
                        <a href="{{ route("articles.show", $article->slug) }}" type="button" class="btn btn-primary fw-semibold mb-4">
                            Read More <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
