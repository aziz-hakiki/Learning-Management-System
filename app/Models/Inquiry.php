<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    public const TYPES = [
        'kontak_helpdesk' => 'Kontak & Helpdesk',
        'permohonan_ppid' => 'Permohonan Informasi PPID',
        'pengaduan_layanan' => 'Pengaduan Layanan & WBK',
        'penyewaan_aset' => 'Permintaan Penyewaan Aset',
    ];

    public const STATUSES = [
        'baru' => 'Baru Masuk',
        'diproses' => 'Sedang Diproses',
        'selesai' => 'Selesai',
    ];

    protected $fillable = [
        'reference_code',
        'type',
        'sender_name',
        'sender_email',
        'sender_phone',
        'sender_unit',
        'subject',
        'message',
        'status',
        'admin_notes',
        'responded_at',
    ];

    protected function casts(): array
    {
        return [
            'responded_at' => 'datetime',
        ];
    }

    /**
     * Generate a readable sequential reference code per inquiry type and year.
     */
    public static function generateReferenceCode(string $type): string
    {
        $prefix = match ($type) {
            'permohonan_ppid' => 'PPID',
            'pengaduan_layanan' => 'ADU',
            'penyewaan_aset' => 'ASET',
            default => 'HD',
        };
        $year = now()->format('Y');
        $base = "{$prefix}-{$year}-";

        $latest = self::query()
            ->where('reference_code', 'like', "{$base}%")
            ->orderByDesc('id')
            ->value('reference_code');

        $nextNumber = $latest ? ((int) substr($latest, strlen($base)) + 1) : 1;

        return sprintf('%s%04d', $base, $nextNumber);
    }

    public function typeLabel(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }
}
