<?php

namespace App\Models;

use App\Models\Concerns\HasPublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasPublishedScope;

    public const TYPES = [
        'berita' => 'Berita',
        'pengumuman' => 'Pengumuman',
        'agenda' => 'Agenda Kegiatan',
    ];

    protected $fillable = [
        'title',
        'slug',
        'type',
        'excerpt',
        'body',
        'cover_image_path',
        'attachment_path',
        'event_date',
        'is_featured',
        'is_dummy',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_featured' => 'boolean',
            'is_dummy' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Filter articles by publication type and search phrase.
     */
    public function scopeFilter(Builder $query, ?string $type = null, ?string $search = null): Builder
    {
        return $query
            ->when($type && array_key_exists($type, self::TYPES), fn (Builder $q) => $q->where('type', $type))
            ->when($search, function (Builder $q) use ($search): void {
                $term = '%'.trim($search).'%';
                $q->where(function (Builder $inner) use ($term): void {
                    $inner->where('title', 'like', $term)
                        ->orWhere('excerpt', 'like', $term);
                });
            });
    }

    public function typeLabel(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }
}
