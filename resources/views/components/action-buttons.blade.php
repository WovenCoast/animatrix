@props(["article", "show" => ["delete"]])

<div class="flex align-middle">
    @if(in_array("view", $show))
    <button class="view-button ml-12" data-redirect="{{ route("articles.show", $article->slug) }}">
        <i class="fa-solid fa-eye"></i>
    </button>
    @endif


    @if(in_array("edit", $show))
    <button class="edit-button ml-12" data-redirect="{{ route("articles.edit", $article->id) }}">
        <i class="fa-solid fa-edit"></i>
    </button>
    @endif

    @if(in_array("delete", $show))
    <button class="delete-button ml-12" data-article="{{ $article->id }}">
        <i class="fa-regular fa-trash-can"></i>
    </button>
    @endif
</div>
