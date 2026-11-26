<?php

namespace Database\Seeders;

use App\Models\PublicDocument;
use Illuminate\Database\Seeder;

class PublicDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $documents = [
            [
                'title' => 'Daftar Informasi Publik (DIP) PPSDMAP BPSDMP Kemenhub (Contoh Dummy)',
                'category' => 'berkala',
                'document_number' => 'PPID-DUMMY-01/2026',
                'year' => 2026,
                'description' => 'Contoh daftar klasifikasi informasi publik yang wajib disediakan dan diumumkan secara berkala pada satuan kerja PPSDMAP.',
                'file_path' => '/docs/contoh-dokumen-ppid-dummy.pdf',
                'external_url' => null,
                'is_dummy' => true,
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'Standar Pelayanan Publik Kediklatan PPSDMAP (Contoh Dummy)',
                'category' => 'setiap-saat',
                'document_number' => 'SP-DUMMY-02/2026',
                'year' => 2026,
                'description' => 'Contoh dokumen standar pelayanan penyelenggaraan pendidikan dan pelatihan serta prosedur penyelesaian pengaduan peserta.',
                'file_path' => '/docs/contoh-dokumen-ppid-dummy.pdf',
                'external_url' => null,
                'is_dummy' => true,
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Maklumat Pelayanan Pembangunan Zona Integritas WBK/WBBM (Contoh Dummy)',
                'category' => 'zona-integritas',
                'document_number' => 'ZI-DUMMY-03/2026',
                'year' => 2026,
                'description' => 'Contoh dokumen pernyataan komitmen pimpinan dan pegawai PPSDMAP dalam penyelenggaraan pelayanan bersih dan bebas korupsi.',
                'file_path' => '/docs/contoh-dokumen-ppid-dummy.pdf',
                'external_url' => null,
                'is_dummy' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Pedoman Penyelenggaraan Pembelajaran Jarak Jauh / E-Learning (Contoh Dummy)',
                'category' => 'regulasi',
                'document_number' => 'PED-DUMMY-04/2026',
                'year' => 2026,
                'description' => 'Contoh ringkasan tata tertib peserta, kewajiban kehadiran daring, dan kriteria kelulusan pada LMS PPSDMAP.',
                'file_path' => '/docs/contoh-dokumen-ppid-dummy.pdf',
                'external_url' => null,
                'is_dummy' => true,
                'published_at' => now()->subDays(8),
            ],
            [
                'title' => 'Informasi Perubahan Jadwal atau Keadaan Darurat Penyelenggaraan Diklat (Contoh Dummy)',
                'category' => 'serta-merta',
                'document_number' => 'SM-DUMMY-05/2026',
                'year' => 2026,
                'description' => 'Contoh slot dokumen untuk pengumuman perubahan mendadak jadwal kelas, lokasi, atau protokol kedaruratan peserta.',
                'file_path' => '/docs/contoh-dokumen-ppid-dummy.pdf',
                'external_url' => null,
                'is_dummy' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'E-Buletin PPSDMAP Edisi 01: Penguatan Kompetensi ASN Perhubungan (Contoh Dummy)',
                'category' => 'ebuletin',
                'document_number' => 'BULETIN-DUMMY-01/2026',
                'year' => 2026,
                'description' => 'Edisi contoh buletin digital yang merangkum liputan program pelatihan manajerial, teknis transportasi, dan budaya integritas aparatur.',
                'file_path' => '/docs/contoh-dokumen-ppid-dummy.pdf',
                'external_url' => null,
                'is_dummy' => true,
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'E-Buletin PPSDMAP Edisi 02: Pembelajaran Corporate University dan WBK (Contoh Dummy)',
                'category' => 'ebuletin',
                'document_number' => 'BULETIN-DUMMY-02/2026',
                'year' => 2026,
                'description' => 'Edisi contoh mengenai penerapan pembelajaran digital LMS Corpu, Webinar Series, serta capaian pembangunan Zona Integritas.',
                'file_path' => '/docs/contoh-dokumen-ppid-dummy.pdf',
                'external_url' => null,
                'is_dummy' => true,
                'published_at' => now()->subDays(2),
            ],
        ];

        foreach ($documents as $doc) {
            PublicDocument::updateOrCreate(
                ['document_number' => $doc['document_number']],
                $doc
            );
        }
    }
}
