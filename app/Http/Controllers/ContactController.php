<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Services\InquirySubmissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('pages.kontak');
    }

    public function store(StoreInquiryRequest $request, InquirySubmissionService $service): RedirectResponse
    {
        $inquiry = $service->submit('kontak_helpdesk', $request->validated());

        return redirect()
            ->route('kontak.index')
            ->with('contact_success', "Pesan Anda tercatat dengan nomor tiket {$inquiry->reference_code}. Tim helpdesk akan meninjau laporan tersebut.");
    }
}
