<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\TrainingProgram;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ElearningController extends Controller
{
    public function __invoke(Request $request): View
    {
        $selectedCategory = $request->string('faq_category')->toString() ?: null;

        $faqs = Faq::active()
            ->when(
                $selectedCategory && array_key_exists($selectedCategory, Faq::CATEGORIES),
                fn ($q) => $q->where('category', $selectedCategory)
            )
            ->get();

        $onlinePrograms = TrainingProgram::published()
            ->whereIn('delivery_mode', ['daring', 'blended'])
            ->orderByDesc('is_featured')
            ->orderBy('code')
            ->limit(4)
            ->get();

        $lmsSteps = [
            [
                'title' => 'Verifikasi Surat Pemanggilan atau Penugasan',
                'detail' => 'Pastikan nama dan NIP Anda terdaftar pada surat pemanggilan dari unit kerja pengusul atau terdaftar pada program pelatihan mandiri.',
            ],
            [
                'title' => 'Masuk ke Portal LMS PPSDMAP / EduHub',
                'detail' => 'Gunakan tautan resmi di halaman ini dan masukkan kredensial yang dibagikan oleh panitia penyelenggara kelas.',
            ],
            [
                'title' => 'Selesaikan Modul dan Evaluasi Pembelajaran',
                'detail' => 'Ikuti jadwal sesi daring, unggah penugasan, dan lengkapi kuesioner evaluasi penyelenggaraan untuk proses penerbitan sertifikat.',
            ],
        ];

        return view('pages.elearning', [
            'faqs' => $faqs,
            'faqCategories' => Faq::CATEGORIES,
            'selectedCategory' => $selectedCategory,
            'onlinePrograms' => $onlinePrograms,
            'lmsSteps' => $lmsSteps,
        ]);
    }
}
