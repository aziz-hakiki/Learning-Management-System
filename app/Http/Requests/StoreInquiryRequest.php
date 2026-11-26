<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'sender_name' => ['required', 'string', 'min:3', 'max:120'],
            'sender_email' => ['required', 'email:rfc', 'max:150'],
            'sender_phone' => ['nullable', 'string', 'max:30'],
            'sender_unit' => ['nullable', 'string', 'max:150'],
            'subject' => ['required', 'string', 'min:5', 'max:180'],
            'message' => ['required', 'string', 'min:15', 'max:3000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'sender_name.required' => 'Nama lengkap wajib diisi.',
            'sender_name.min' => 'Nama lengkap minimal 3 karakter.',
            'sender_email.required' => 'Alamat email wajib diisi.',
            'sender_email.email' => 'Format alamat email tidak valid (contoh: nama@instansi.go.id).',
            'subject.required' => 'Perihal atau subjek wajib diisi.',
            'subject.min' => 'Perihal minimal 5 karakter.',
            'message.required' => 'Isi pesan atau rincian permohonan wajib diisi.',
            'message.min' => 'Isi pesan minimal 15 karakter agar tim dapat menindaklanjuti.',
        ];
    }
}
