<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $articles = $user->isModerator()
            ? Article::with('user')->latest()->get()
            : $user->articles()->latest()->get();

        return view('articles.index', compact('articles'));
    }

    public function create(): View
    {
        Gate::authorize('create', Article::class);

        return view('articles.create');
    }

    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $request->user()->articles()->create($request->validated());

        return redirect()->route('articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function show(Article $article): View
    {
        Gate::authorize('view', $article);

        return view('articles.show', compact('article'));
    }

    public function edit(Article $article): View
    {
        Gate::authorize('update', $article);

        return view('articles.edit', compact('article'));
    }

    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $article->update($request->validated());

        return redirect()->route('articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        Gate::authorize('delete', $article);

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article deleted.');
    }
}
