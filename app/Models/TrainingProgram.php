<?php

namespace App\Models;

use App\Models\Concerns\HasPublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TrainingProgram extends Model
{
    use HasPublishedScope;

    public const CATEGORIES = [
        'manajerial' => 'Kepemimpinan & Manajerial',
        'teknis' => 'Teknis Transportasi',
        'fungsional' => 'Fungsional & Rintisan Gelar',
        'integritas' => 'Karakter & Integritas',
        'orientasi' => 'Orientasi PPPK & Latsar',
        'webinar' => 'Webinar Series',
    ];

    public const DELIVERY_MODES = [
        'klasikal' => 'Klasikal (Tatap Muka)',
        'blended' => 'Blended Learning',
        'daring' => 'Daring / E-Learning',
    ];

    public const REGISTRATION_STATUSES = [
        'dibuka' => 'Pendaftaran Dibuka',
        'terjadwal' => 'Terjadwal',
        'mandiri' => 'Akses Mandiri',
        'selesai' => 'Selesai',
    ];

    protected $fillable = [
        'code',
        'title',
        'slug',
        'category',
        'delivery_mode',
        'registration_status',
        'summary',
        'curriculum',
        'target_audience',
        'schedule_label',
        'duration_hours',
        'lms_url',
        'thumbnail_path',
        'is_featured',
        'is_dummy',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'curriculum' => 'array',
            'duration_hours' => 'integer',
            'is_featured' => 'boolean',
            'is_dummy' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Filter catalog entries by category key and keyword search.
     */
    public function scopeFilter(Builder $query, ?string $category = null, ?string $search = null): Builder
    {
        return $query
            ->when($category && array_key_exists($category, self::CATEGORIES), fn (Builder $q) => $q->where('category', $category))
            ->when($search, function (Builder $q) use ($search): void {
                $term = '%'.trim($search).'%';
                $q->where(function (Builder $inner) use ($term): void {
                    $inner->where('title', 'like', $term)
                        ->orWhere('code', 'like', $term)
                        ->orWhere('summary', 'like', $term);
                });
            });
    }

    public function categoryLabel(): string
    {
        return self::CATEGORIES[$this->category] ?? $this->category;
    }

    public function deliveryModeLabel(): string
    {
        return self::DELIVERY_MODES[$this->delivery_mode] ?? $this->delivery_mode;
    }

    public function registrationStatusLabel(): string
    {
        return self::REGISTRATION_STATUSES[$this->registration_status] ?? $this->registration_status;
    }
}
