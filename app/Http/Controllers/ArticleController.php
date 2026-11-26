<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $type = $request->string('type')->toString() ?: null;
        $search = $request->string('q')->toString() ?: null;

        $articles = Article::published()
            ->filter($type, $search)
            ->orderByDesc('published_at')
            ->paginate(6)
            ->withQueryString();

        return view('pages.informasi.index', [
            'articles' => $articles,
            'types' => Article::TYPES,
            'selectedType' => $type,
            'searchQuery' => $search,
        ]);
    }

    public function show(Article $article): View
    {
        abort_if($article->published_at === null || $article->published_at->isFuture(), 404);

        $recentArticles = Article::published()
            ->whereKeyNot($article->id)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('pages.informasi.show', [
            'article' => $article,
            'recentArticles' => $recentArticles,
        ]);
    }
}
