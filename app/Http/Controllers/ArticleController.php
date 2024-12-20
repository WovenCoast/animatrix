<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Factory|Application
    {
        $articles = Article::query();
        if ($request->has('search')) {
            $articles
                ->where("title", "like", "%{$request->get('search')}%")
                ->orWhere("excerpt", "like", "%{$request->get('search')}%");
        }
        if ($request->has('sortBy')) {
            $articles
                ->orderBy($request->get('sortBy'))
                ->orderByDesc($request->get('sortDesc'));
        }

        if ((! $request->has('drafts')) || $request->boolean('drafts') === false) {
            $articles
                ->where('published', 1);
        }
        $articles = $articles->get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory|Application
    {
        $article = new Article();
        return view('articles.edit', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $article = new Article($request->validated());
        $article->save();
        $article->updateSingleMedia('featured_image', $request);

        $request->session()->flash('success', 'Article created successfully.');

        return redirect()->route('articles.edit', $article->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article): View|Factory|Application
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): View|Factory|Application
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $article->update($request->validated());
        $article->updateSingleMedia('featured_image', $request);
        $request->session()->flash('success', 'Article updated successfully.');
        return redirect()->route("articles.show", $article->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Article $article): void
    {
        $request->session()->flash('success', 'Article deleted successfully.');
        $article->delete();
    }
}
