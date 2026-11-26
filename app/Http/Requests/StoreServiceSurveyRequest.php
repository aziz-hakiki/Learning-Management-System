<?php

namespace App\Http\Requests;

use App\Models\ServiceSurvey;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServiceSurveyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, list<mixed>>
     */
    public function rules(): array
    {
        return [
            'service_type' => ['required', 'string', Rule::in(array_keys(ServiceSurvey::SERVICE_TYPES))],
            'respondent_name' => ['nullable', 'string', 'max:120'],
            'respondent_unit' => ['nullable', 'string', 'max:150'],
            'rating_clarity' => ['required', 'integer', 'between:1,4'],
            'rating_speed' => ['required', 'integer', 'between:1,4'],
            'rating_officer' => ['required', 'integer', 'between:1,4'],
            'rating_facility' => ['required', 'integer', 'between:1,4'],
            'feedback' => ['nullable', 'string', 'max:1500'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'service_type.required' => 'Pilih jenis layanan yang dinilai.',
            'service_type.in' => 'Jenis layanan tidak valid.',
            'rating_clarity.required' => 'Penilaian kejelasan prosedur wajib dipilih.',
            'rating_speed.required' => 'Penilaian kecepatan waktu layanan wajib dipilih.',
            'rating_officer.required' => 'Penilaian sikap dan respons petugas wajib dipilih.',
            'rating_facility.required' => 'Penilaian sarana atau sistem layanan wajib dipilih.',
        ];
    }
}
