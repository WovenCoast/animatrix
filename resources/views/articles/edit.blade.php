@extends('layout')

@section('content')
        <div class="flex justify-between align-middle mb-4">
            @if(is_null(request()->route("article")))
                <h1 class="fw-bold">
                    New Post
                </h1>
            @else
                <h1 class="card-title fw-bold">Edit Post</h1>
                @include('components.action-buttons', ["article" => $article, "show" => ["view", "delete"]])
            @endif
        </div>
    <x-forms::form files :model="$article" >
        <x-forms::input name="title" />
        <x-forms::input name="slug" />
        <x-forms::wysiwyg name="content" />
        <x-forms::textarea name="excerpt" />
        <x-forms::image name="featured_image" width="1920" height="1080" max="500kb" />
        <x-forms::checkbox name="published" />
        <x-forms::datetime name="published_at" />
        <button type="submit">Submit</button>
    </x-forms::form>
@endsection
