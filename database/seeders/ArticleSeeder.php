<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Pembukaan Program Pengembangan Kompetensi Manajerial dan Teknis Transportasi Tahun Anggaran Berjalan (Konten Dummy)',
                'slug' => 'pembukaan-program-pengembangan-kompetensi-tahun-berjalan',
                'type' => 'berita',
                'excerpt' => 'PPSDMAP BPSDMP Kemenhub menyiapkan rangkaian pelatihan struktural, teknis transportasi, dan penguatan integritas bagi ASN di kampus Parung maupun secara daring melalui LMS.',
                'body' => "Pusat Pengembangan Sumber Daya Manusia Aparatur Perhubungan (PPSDMAP) menyelenggarakan rangkaian pelatihan manajerial, teknis transportasi, dan pembinaan karakter untuk mendukung peningkatan kompetensi aparatur Kementerian Perhubungan.\n\nPenyelenggaraan pelatihan dilaksanakan melalui pendekatan blended learning yang memadukan materi daring pada platform E-Learning dengan sesi tatap muka di Kampus PPSDMAP Parung, Kabupaten Bogor.\n\nCatatan: Artikel ini adalah konten contoh (dummy) yang disiapkan untuk verifikasi tata letak editorial portal dan dapat diganti melalui Panel Admin CMS dengan rilis resmi humas.",
                'cover_image_path' => '/images/dummy/artikel-utama-dummy.svg',
                'attachment_path' => null,
                'event_date' => null,
                'is_featured' => true,
                'is_dummy' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Pemanggilan Peserta Pelatihan Refleksi dan Aktualisasi Integritas (PRESTASI) (Contoh Pengumuman)',
                'slug' => 'pemanggilan-peserta-pelatihan-prestasi-contoh',
                'type' => 'pengumuman',
                'excerpt' => 'Informasi tata cara verifikasi akun LMS dan kelengkapan surat tugas bagi peserta unit kerja yang terjadwal mengikuti pelatihan PRESTASI.',
                'body' => "Unit kerja pengusul dimohon memastikan seluruh calon peserta telah memiliki akun aktif pada platform LMS PPSDMAP serta mengunggah surat tugas resmi sesuai jadwal angkatan.\n\nApabila terdapat kendala akses akun atau pembaruan data kepegawaian, peserta dapat menghubungi layanan helpdesk PPSDMAP melalui formulir kontak resmi pada portal ini.\n\nCatatan: Ini adalah pengumuman contoh (dummy) untuk menguji tampilan daftar pengumuman.",
                'cover_image_path' => null,
                'attachment_path' => '/docs/contoh-dokumen-ppid-dummy.pdf',
                'event_date' => now()->addDays(14)->toDateString(),
                'is_featured' => false,
                'is_dummy' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Webinar Series PPSDMAP: Penguatan Tata Kelola SDM dan Jabatan Fungsional (Contoh Agenda)',
                'slug' => 'webinar-series-tata-kelola-sdm-contoh',
                'type' => 'agenda',
                'excerpt' => 'Agenda seri diskusi daring mengenai pengembangan kompetensi dan kebijakan jabatan fungsional di lingkungan Kementerian Perhubungan.',
                'body' => "Webinar Series PPSDMAP terbuka bagi aparatur perhubungan yang ingin mengikuti pemutakhiran kebijakan pengelolaan sumber daya manusia dan tata kelola jabatan fungsional.\n\nTautan ruang virtual dan materi paparan tersedia melalui portal E-Learning setelah peserta terdaftar pada sesi terkait.\n\nCatatan: Agenda ini merupakan data contoh (dummy) sebelum jadwal resmi diinput operator.",
                'cover_image_path' => '/images/dummy/artikel-webinar-dummy.svg',
                'attachment_path' => null,
                'event_date' => now()->addDays(10)->toDateString(),
                'is_featured' => false,
                'is_dummy' => true,
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'Panduan Akses Pelatihan Mandiri Zona Integritas WBK dan WBBM di LMS (Contoh Pengumuman)',
                'slug' => 'panduan-pelatihan-mandiri-zona-integritas-contoh',
                'type' => 'pengumuman',
                'excerpt' => 'Pelatihan mandiri Zona Integritas dapat diakses oleh pegawai Kementerian Perhubungan untuk memahami enam area perubahan reformasi birokrasi.',
                'body' => "Pegawai di lingkungan Kementerian Perhubungan dapat mengikuti Pelatihan Mandiri Pembangunan Zona Integritas Menuju WBK/WBBM secara daring.\n\nPeserta diminta menuntaskan seluruh modul evaluasi mandiri sesuai alur yang tercantum pada halaman Gerbang E-Learning.\n\nCatatan: Dokumen dan pengumuman ini adalah data contoh (dummy).",
                'cover_image_path' => null,
                'attachment_path' => '/docs/contoh-dokumen-ppid-dummy.pdf',
                'event_date' => null,
                'is_featured' => false,
                'is_dummy' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Peningkatan Layanan Informasi Publik PPID dan Kemudahan Akses Disabilitas (Konten Dummy)',
                'slug' => 'peningkatan-layanan-informasi-publik-ppid-dummy',
                'type' => 'berita',
                'excerpt' => 'PPSDMAP menata kembali kanal keterbukaan informasi publik PPID dengan standar aksesibilitas web agar mudah diakses oleh seluruh pemohon.',
                'body' => "Sebagai unit kerja yang membangun Zona Integritas menuju WBK/WBBM, PPSDMAP menata penyajian dokumen informasi berkala, informasi serta-merta, serta formulir permohonan informasi publik secara terstruktur.\n\nSeluruh halaman pada portal baru dirancang agar dapat diakses dengan navigasi keyboard dan kontras warna yang memadai.\n\nCatatan: Konten berita ini merupakan materi contoh (dummy).",
                'cover_image_path' => '/images/dummy/artikel-utama-dummy.svg',
                'attachment_path' => null,
                'event_date' => null,
                'is_featured' => false,
                'is_dummy' => true,
                'published_at' => now()->subDays(6),
            ],
            [
                'title' => 'Jadwal Pemeliharaan Berkala Sistem E-Learning PPSDMAP (Contoh Pengumuman)',
                'slug' => 'jadwal-pemeliharaan-sistem-elearning-contoh',
                'type' => 'pengumuman',
                'excerpt' => 'Pemberitahuan contoh mengenai jadwal pemeliharaan sistem pembelajaran daring dan alternatif kanal bantuan helpdesk peserta.',
                'body' => "Pemberitahuan pemeliharaan berkala platform pembelajaran daring bertujuan menjaga kestabilan akses selama pelaksanaan ujian dan unggah tugas peserta.\n\nCatatan: Pengumuman ini adalah data contoh (dummy) dan tidak merepresentasikan gangguan sistem aktual.",
                'cover_image_path' => null,
                'attachment_path' => null,
                'event_date' => now()->addDays(21)->toDateString(),
                'is_featured' => false,
                'is_dummy' => true,
                'published_at' => now()->subDays(8),
            ],
        ];

        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['slug' => $article['slug']],
                $article
            );
        }
    }
}
