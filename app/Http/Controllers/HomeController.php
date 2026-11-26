<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\PublicDocument;
use App\Models\TrainingProgram;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $programs = TrainingProgram::published()
            ->orderByDesc('is_featured')
            ->orderByDesc('published_at')
            ->get();

        $featuredArticle = Article::published()
            ->orderByDesc('is_featured')
            ->orderByDesc('published_at')
            ->first();

        $recentBulletins = Article::published()
            ->when($featuredArticle, fn ($q) => $q->whereKeyNot($featuredArticle->id))
            ->orderByDesc('published_at')
            ->limit(4)
            ->get();

        $highlightsPpid = PublicDocument::published()
            ->whereIn('category', array_keys(PublicDocument::PPID_CATEGORIES))
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('pages.home', [
            'programs' => $programs,
            'programCategories' => TrainingProgram::CATEGORIES,
            'featuredArticle' => $featuredArticle,
            'recentBulletins' => $recentBulletins,
            'highlightsPpid' => $highlightsPpid,
        ]);
    }
}
