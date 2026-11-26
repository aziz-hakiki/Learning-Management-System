<?php

namespace App\Http\Controllers;

use App\Models\TrainingProgram;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->string('category')->toString() ?: null;
        $search = $request->string('q')->toString() ?: null;

        $programs = TrainingProgram::published()
            ->filter($category, $search)
            ->orderByDesc('is_featured')
            ->orderBy('code')
            ->get();

        return view('pages.diklat.index', [
            'programs' => $programs,
            'categories' => TrainingProgram::CATEGORIES,
            'selectedCategory' => $category,
            'searchQuery' => $search,
        ]);
    }

    public function filter(Request $request): JsonResponse
    {
        $category = $request->string('category')->toString() ?: null;
        $search = $request->string('q')->toString() ?: null;

        $programs = TrainingProgram::published()
            ->filter($category, $search)
            ->orderByDesc('is_featured')
            ->orderBy('code')
            ->get();

        return response()->json([
            'count' => $programs->count(),
            'html' => view('pages.diklat._list', ['programs' => $programs])->render(),
        ]);
    }

    public function show(TrainingProgram $program): View
    {
        abort_if($program->published_at === null || $program->published_at->isFuture(), 404);

        $relatedPrograms = TrainingProgram::published()
            ->where('category', $program->category)
            ->whereKeyNot($program->id)
            ->orderBy('code')
            ->limit(3)
            ->get();

        return view('pages.diklat.show', [
            'program' => $program,
            'relatedPrograms' => $relatedPrograms,
        ]);
    }

    public function corporateUniversity(): View
    {
        $corpuPrograms = TrainingProgram::published()
            ->whereIn('category', ['manajerial', 'teknis', 'integritas'])
            ->orderByDesc('is_featured')
            ->limit(3)
            ->get();

        $pillars = [
            [
                'title' => 'Pembelajaran Berbasis Kebutuhan Organisasi',
                'detail' => 'Kurikulum disusun selaras dengan sasaran strategis Kementerian Perhubungan pada subsektor darat, laut, udara, perkeretaapian, serta tata kelola pemerintahan.',
            ],
            [
                'title' => 'Integrasi Jalur Belajar 10-20-70',
                'detail' => 'Menggabungkan pembelajaran terstruktur di kelas atau LMS (10%), bimbingan mentoring/coaching atasan (20%), dan praktik kerja langsung di satuan kerja (70%).',
            ],
            [
                'title' => 'Pemenuhan Hak Pengembangan 20 JP per Tahun',
                'detail' => 'Menyediakan ragam modul pelatihan klasikal, blended, Webinar Series, dan pelatihan mandiri melalui platform LMS Corpu.',
            ],
        ];

        return view('pages.program.corpu', [
            'pillars' => $pillars,
            'corpuPrograms' => $corpuPrograms,
        ]);
    }

    public function assessmentCenter(): View
    {
        $stages = [
            'Pengajuan permohonan asesmen kompetensi secara resmi dari Biro/Bagian Kepegawaian unit kerja.',
            'Pelaksanaan instrumen pemetaan kompetensi manajerial, sosial kultural, serta wawancara perilaku oleh asesor terakreditasi.',
            'Penyusunan laporan hasil asesmen dan rekomendasi pengembangan kompetensi bagi pimpinan unit kerja dan pegawai terkait.',
        ];

        $competencyFocus = [
            'Pemetaan kompetensi untuk pengisian jabatan pimpinan pratama, administrator, dan pengawas.',
            'Identifikasi kesenjangan kompetensi sebagai dasar rekomendasi pelatihan pada program Corporate University.',
            'Umpan balik pengembangan karier bagi ASN di lingkungan Kementerian Perhubungan.',
        ];

        return view('pages.program.assessment', [
            'stages' => $stages,
            'competencyFocus' => $competencyFocus,
        ]);
    }

    public function rintisanGelar(): View
    {
        $programs = TrainingProgram::published()
            ->where('category', 'fungsional')
            ->orderBy('code')
            ->get();

        $tracks = [
            [
                'title' => 'Pembekalan Persiapan Studi Pascasarjana',
                'detail' => 'Pendampingan peningkatan kemampuan bahasa Inggris akademik, penulisan esai rencana riset, dan persiapan seleksi masuk perguruan tinggi mitra.',
            ],
            [
                'title' => 'Program Tugas Belajar dan Beasiswa Sektor Transportasi',
                'detail' => 'Fasilitasi administrasi pengusulan ASN berprestasi sesuai ketentuan penetapan kebutuhan tugas belajar di Kementerian Perhubungan.',
            ],
            [
                'title' => 'Pemantauan Progres Akademik Karya Siswa',
                'detail' => 'Koordinasi berkala bersama instansi pengusul dan perguruan tinggi penyelenggara hingga penyelesaian studi dan penempatan kembali.',
            ],
        ];

        return view('pages.program.rintisan-gelar', [
            'tracks' => $tracks,
            'programs' => $programs,
        ]);
    }
}
