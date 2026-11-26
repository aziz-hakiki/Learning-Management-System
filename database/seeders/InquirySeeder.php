<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use Illuminate\Database\Seeder;

class InquirySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'reference_code' => 'HD-2026-0001',
                'type' => 'kontak_helpdesk',
                'sender_name' => 'Peserta Contoh (Data Dummy)',
                'sender_email' => 'contoh.peserta@example.test',
                'sender_phone' => '0800-0000-0001',
                'sender_unit' => 'Unit Kerja Contoh (Dummy)',
                'subject' => 'Contoh Permintaan Bantuan Reset Akses LMS (Dummy)',
                'message' => 'Ini adalah entri kotak masuk contoh (dummy) untuk memverifikasi alur pengelolaan tiket helpdesk pada panel admin.',
                'status' => 'baru',
                'admin_notes' => null,
                'responded_at' => null,
            ],
            [
                'reference_code' => 'PPID-2026-0001',
                'type' => 'permohonan_ppid',
                'sender_name' => 'Pemohon Informasi Contoh (Data Dummy)',
                'sender_email' => 'contoh.ppid@example.test',
                'sender_phone' => null,
                'sender_unit' => 'Instansi Contoh (Dummy)',
                'subject' => 'Contoh Permohonan Salinan Dokumen Kalender Diklat (Dummy)',
                'message' => 'Ini adalah entri permohonan PPID contoh (dummy) untuk menguji status pemrosesan dan catatan tindak lanjut admin.',
                'status' => 'diproses',
                'admin_notes' => 'Catatan tindak lanjut contoh (dummy) oleh operator PPID.',
                'responded_at' => now()->subDay(),
            ],
        ];

        foreach ($items as $item) {
            Inquiry::updateOrCreate(
                ['reference_code' => $item['reference_code']],
                $item
            );
        }
    }
}
