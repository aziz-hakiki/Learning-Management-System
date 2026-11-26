<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Models\PublicDocument;
use App\Services\InquirySubmissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PpidController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->string('category')->toString() ?: null;
        $search = $request->string('q')->toString() ?: null;

        $documents = PublicDocument::published()
            ->whereIn('category', array_keys(PublicDocument::PPID_CATEGORIES))
            ->filter($category, $search)
            ->orderByDesc('year')
            ->orderByDesc('published_at')
            ->get();

        return view('pages.ppid', [
            'documents' => $documents,
            'categories' => PublicDocument::PPID_CATEGORIES,
            'selectedCategory' => $category,
            'searchQuery' => $search,
        ]);
    }

    public function store(StoreInquiryRequest $request, InquirySubmissionService $service): RedirectResponse
    {
        $inquiry = $service->submit('permohonan_ppid', $request->validated());

        return redirect()
            ->route('ppid.index', ['#permohonan-ppid'])
            ->with('ppid_success', "Permohonan informasi publik tercatat dengan nomor referensi {$inquiry->reference_code}.");
    }
}
