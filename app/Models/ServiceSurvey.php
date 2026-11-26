<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSurvey extends Model
{
    public const SERVICE_TYPES = [
        'diklat_manajerial' => 'Pelatihan Manajerial / Kepemimpinan',
        'diklat_teknis' => 'Pelatihan Teknis Transportasi',
        'lms_corpu' => 'Layanan LMS Corpu / E-Learning',
        'assessment_center' => 'Layanan Assessment Center',
        'ppid_informasi' => 'Layanan Informasi Publik (PPID)',
        'penyewaan_aset' => 'Layanan Penyewaan Aset dan Fasilitas',
    ];

    protected $fillable = [
        'service_type',
        'respondent_name',
        'respondent_unit',
        'rating_clarity',
        'rating_speed',
        'rating_officer',
        'rating_facility',
        'feedback',
    ];

    protected function casts(): array
    {
        return [
            'rating_clarity' => 'integer',
            'rating_speed' => 'integer',
            'rating_officer' => 'integer',
            'rating_facility' => 'integer',
        ];
    }

    public function serviceTypeLabel(): string
    {
        return self::SERVICE_TYPES[$this->service_type] ?? $this->service_type;
    }
}
