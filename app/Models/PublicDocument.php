<?php

namespace App\Models;

use App\Models\Concerns\HasPublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PublicDocument extends Model
{
    use HasPublishedScope;

    public const CATEGORIES = [
        'berkala' => 'Informasi Berkala',
        'serta-merta' => 'Informasi Serta-Merta',
        'setiap-saat' => 'Informasi Setiap Saat',
        'regulasi' => 'Regulasi & Pedoman',
        'zona-integritas' => 'Zona Integritas (WBK/WBBM)',
        'ebuletin' => 'E-Buletin PPSDMAP',
    ];

    public const PPID_CATEGORIES = [
        'berkala' => 'Informasi Berkala',
        'serta-merta' => 'Informasi Serta-Merta',
        'setiap-saat' => 'Informasi Setiap Saat',
        'regulasi' => 'Regulasi & Pedoman',
        'zona-integritas' => 'Zona Integritas (WBK/WBBM)',
    ];

    protected $fillable = [
        'title',
        'category',
        'document_number',
        'year',
        'description',
        'file_path',
        'external_url',
        'is_dummy',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'is_dummy' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Filter PPID and regulatory documents by classification or keyword.
     */
    public function scopeFilter(Builder $query, ?string $category = null, ?string $search = null): Builder
    {
        return $query
            ->when($category && array_key_exists($category, self::CATEGORIES), fn (Builder $q) => $q->where('category', $category))
            ->when($search, function (Builder $q) use ($search): void {
                $term = '%'.trim($search).'%';
                $q->where(function (Builder $inner) use ($term): void {
                    $inner->where('title', 'like', $term)
                        ->orWhere('document_number', 'like', $term);
                });
            });
    }

    public function categoryLabel(): string
    {
        return self::CATEGORIES[$this->category] ?? $this->category;
    }
}
