<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProfileController extends Controller
{
    public function sejarah(): View
    {
        $milestones = [
            [
                'period' => 'Periode Pembentukan Awal [Data Tahun Menunggu Arsip]',
                'title' => 'Lembaga Pendidikan dan Pelatihan Aparatur Sektor Perhubungan',
                'detail' => 'Unit kerja dibentuk untuk menyelenggarakan pendidikan dan pelatihan kepemimpinan, teknis, dan fungsional bagi pegawai Kementerian Perhubungan.',
            ],
            [
                'period' => 'Penataan Organisasi BPSDMP [Data SK Menunggu Verifikasi]',
                'title' => 'Pengukuhan PPSDMAP di bawah Badan Pengembangan SDM Perhubungan',
                'detail' => 'Berperan sebagai unsur pelaksana pengembangan kompetensi manajerial, struktural, fungsional, serta pembinaan teknis pembangunan karakter aparatur di Kampus Parung, Bogor.',
            ],
            [
                'period' => 'Transformasi Pembelajaran & Zona Integritas',
                'title' => 'Pengembangan LMS Corpu dan Pembangunan WBK/WBBM',
                'detail' => 'Memadukan pelatihan klasikal dengan pembelajaran daring terstruktur (Corporate University) serta penguatan tata kelola birokrasi bersih melalui program PRESTASI bersama KPK.',
            ],
        ];

        return view('pages.profil.sejarah', [
            'milestones' => $milestones,
        ]);
    }

    public function tugasFungsi(): View
    {
        $functions = [
            'Penyusunan kebijakan teknis, rencana, dan program pengembangan sumber daya manusia aparatur perhubungan.',
            'Pelaksanaan pendidikan dan pelatihan manajerial, kepemimpinan, struktural, fungsional, dan teknis kedinasan.',
            'Pemberian pembinaan teknis kepada satuan organisasi yang menyelenggarakan pelatihan pembangunan karakter.',
            'Pengelolaan penjaminan mutu, evaluasi penyelenggaraan, dan kerja sama pengembangan kompetensi aparatur.',
            'Pengelolaan sistem pembelajaran daring (e-learning), layanan assessment center, data kediklatan, serta dukungan tata usaha satuan kerja.',
        ];

        return view('pages.profil.tugas-fungsi', [
            'functions' => $functions,
        ]);
    }

    public function strukturOrganisasi(): View
    {
        $organizationUnits = [
            [
                'level' => 'Pimpinan Satuan Kerja (Eselon II.b)',
                'unit' => 'Kepala Pusat Pengembangan SDM Aparatur Perhubungan',
                'holder' => 'Jabatan Pimpinan Tinggi Pratama [Profil Pejabat Menyusul / Data Resmi]',
                'mandate' => 'Memimpin perumusan kebijakan teknis, penyelenggaraan, pemantauan, dan evaluasi pengembangan kompetensi SDM aparatur perhubungan.',
            ],
            [
                'level' => 'Unit Administrasi',
                'unit' => 'Bagian Tata Usaha',
                'holder' => 'Subbagian Umum, Kepegawaian, Keuangan, dan Humas/PPID',
                'mandate' => 'Menyelenggarakan urusan ketatausahaan, kepegawaian, keuangan, perlengkapan, rumah tangga kampus, pengelolaan aset PNBP, serta layanan keterbukaan informasi publik.',
            ],
            [
                'level' => 'Unit Teknis & Fungsional',
                'unit' => 'Bidang Program, Penjaminan Mutu, dan Penyelenggaraan Diklat',
                'holder' => 'Kelompok Jabatan Fungsional, Widyaiswara, dan Asesor SDM',
                'mandate' => 'Mengelola perencanaan program Corporate University, pelaksanaan pelatihan manajerial, teknis transportasi, assessment center, rintisan gelar, serta evaluasi alumni.',
            ],
        ];

        return view('pages.profil.struktur-organisasi', [
            'organizationUnits' => $organizationUnits,
        ]);
    }

    public function fasilitas(): View
    {
        $facilities = [
            [
                'name' => 'Gedung Kelas dan Ruang Seminar Utama',
                'capacity' => 'Kapasitas standar diklat klasikal [Data Kapasitas Resmi Menyusul]',
                'description' => 'Ruang pembelajaran tatap muka untuk pelaksanaan PKP, Pelatihan Teknis Transportasi, serta sesi orientasi peserta di Kampus Parung.',
            ],
            [
                'name' => 'Auditorium dan Balai Pertemuan',
                'capacity' => 'Kegiatan skala besar dan upacara pembukaan [Data Resmi Menyusul]',
                'description' => 'Sarana penyelenggaraan rapat koordinasi, seminar tatap muka, serta kegiatan seremonial pembukaan dan penutupan angkatan.',
            ],
            [
                'name' => 'Asrama Peserta Diklat',
                'capacity' => 'Akomodasi peserta pelatihan klasikal [Data Jumlah Kamar Menyusul]',
                'description' => 'Fasilitas penginapan peserta selama mengikuti program pelatihan tatap muka maupun pembinaan karakter di kawasan kampus.',
            ],
            [
                'name' => 'Ruang Assessment Center dan Pembelajaran Daring',
                'capacity' => 'Sesi pemetaan kompetensi dan studio pembelajaran [Data Dummy]',
                'description' => 'Ruang wawancara, diskusi kelompok terarah, dan dukungan perangkat untuk pelaksanaan asesmen kompetensi serta webinar.',
            ],
        ];

        return view('pages.profil.fasilitas', [
            'facilities' => $facilities,
        ]);
    }
}
