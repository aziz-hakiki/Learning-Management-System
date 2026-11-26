<?php

namespace App\Http\Controllers;

use App\Models\PublicDocument;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicationController extends Controller
{
    public function bulletin(Request $request): View
    {
        $search = $request->string('q')->toString() ?: null;
        $year = $request->integer('year') ?: null;

        $bulletins = PublicDocument::published()
            ->where('category', 'ebuletin')
            ->when($year, fn ($q) => $q->where('year', $year))
            ->when($search, function ($q) use ($search): void {
                $term = '%'.trim($search).'%';
                $q->where(function ($inner) use ($term): void {
                    $inner->where('title', 'like', $term)
                        ->orWhere('document_number', 'like', $term)
                        ->orWhere('description', 'like', $term);
                });
            })
            ->orderByDesc('year')
            ->orderByDesc('published_at')
            ->get();

        $years = PublicDocument::published()
            ->where('category', 'ebuletin')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        return view('pages.publikasi.ebuletin', [
            'bulletins' => $bulletins,
            'years' => $years,
            'selectedYear' => $year,
            'searchQuery' => $search,
        ]);
    }
}
