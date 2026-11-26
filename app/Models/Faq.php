<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public const CATEGORIES = [
        'lms' => 'Akses LMS & E-Learning',
        'pendaftaran' => 'Pendaftaran & Pemanggilan',
        'sertifikat' => 'Sertifikat & Evaluasi',
        'umum' => 'Layanan Umum & PPID',
    ];

    protected $fillable = [
        'category',
        'question',
        'answer',
        'sort_order',
        'is_active',
        'is_dummy',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'is_dummy' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
    }

    public function categoryLabel(): string
    {
        return self::CATEGORIES[$this->category] ?? $this->category;
    }
}
