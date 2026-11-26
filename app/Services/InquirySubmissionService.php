<?php

namespace App\Services;

use App\Models\Inquiry;
use Illuminate\Support\Facades\DB;

class InquirySubmissionService
{
    /**
     * Persist a public helpdesk or PPID inquiry with a unique reference code.
     *
     * @param  array<string, mixed>  $validated
     */
    public function submit(string $type, array $validated): Inquiry
    {
        return DB::transaction(function () use ($type, $validated): Inquiry {
            return Inquiry::create([
                'reference_code' => Inquiry::generateReferenceCode($type),
                'type' => $type,
                'sender_name' => $validated['sender_name'],
                'sender_email' => $validated['sender_email'],
                'sender_phone' => $validated['sender_phone'] ?? null,
                'sender_unit' => $validated['sender_unit'] ?? null,
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'status' => 'baru',
            ]);
        });
    }
}
