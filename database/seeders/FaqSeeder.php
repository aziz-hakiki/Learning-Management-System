<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'category' => 'lms',
                'question' => 'Bagaimana cara masuk ke platform LMS E-Learning PPSDMAP?',
                'answer' => 'Peserta yang telah terdaftar pada surat pemanggilan dapat menekan tombol "Masuk ke LMS E-Learning" pada halaman Gerbang E-Learning atau menu utama. Masuk menggunakan akun NIP atau kredensial yang dibagikan oleh panitia penyelenggara kelas.',
                'sort_order' => 1,
                'is_active' => true,
                'is_dummy' => true,
            ],
            [
                'category' => 'lms',
                'question' => 'Apa yang harus dilakukan jika mengalami kendala lupa kata sandi atau akun belum aktif di LMS?',
                'answer' => 'Periksa kembali email dinas atau grup koordinasi angkatan untuk melihat panduan aktivasi awal. Jika akun tetap terkunci, kirim laporan melalui formulir Kontak & Helpdesk pada portal ini atau hubungi nomor helpdesk resmi (0811 1175 430) dengan menyertakan NIP dan nama pelatihan.',
                'sort_order' => 2,
                'is_active' => true,
                'is_dummy' => true,
            ],
            [
                'category' => 'pendaftaran',
                'question' => 'Bagaimana alur pengusulan peserta diklat dari unit kerja Kementerian Perhubungan?',
                'answer' => 'Pengusulan peserta dilakukan secara berjenjang melalui pengelola kepegawaian (Bagian SDM/Kepegawaian) masing-masing unit kerja berdasarkan surat pemanggilan atau jadwal angkatan yang diterbitkan PPSDMAP.',
                'sort_order' => 3,
                'is_active' => true,
                'is_dummy' => true,
            ],
            [
                'category' => 'pendaftaran',
                'question' => 'Apa perbedaan metode klasikal, blended learning, dan daring mandiri?',
                'answer' => 'Metode klasikal dilaksanakan tatap muka penuh di Kampus PPSDMAP Parung atau lokasi yang ditunjuk. Blended learning memadukan pembelajaran mandiri/sinkronus daring melalui LMS sebelum sesi tatap muka. Daring atau akses mandiri berlangsung penuh melalui platform E-Learning.',
                'sort_order' => 4,
                'is_active' => true,
                'is_dummy' => true,
            ],
            [
                'category' => 'sertifikat',
                'question' => 'Kapan peserta dapat mengunduh sertifikat setelah menyelesaikan pelatihan?',
                'answer' => 'Sertifikat diterbitkan setelah peserta menuntaskan seluruh kewajiban kehadiran, penugasan, evaluasi penyelenggaraan, dan dinyatakan lulus sesuai ketentuan masing-masing program.',
                'sort_order' => 5,
                'is_active' => true,
                'is_dummy' => true,
            ],
            [
                'category' => 'umum',
                'question' => 'Bagaimana cara mengajukan permohonan informasi publik melalui PPID PPSDMAP?',
                'answer' => 'Pemohon dapat meninjau dokumen yang sudah tersedia pada halaman Layanan PPID terlebih dahulu. Jika dokumen yang dicari belum tercantum, silakan ajukan permohonan secara langsung melalui formulir Permohonan Informasi PPID pada halaman tersebut untuk mendapatkan kode referensi pelacakan.',
                'sort_order' => 6,
                'is_active' => true,
                'is_dummy' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                $faq
            );
        }
    }
}
