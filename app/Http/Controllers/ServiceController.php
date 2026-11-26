<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Http\Requests\StoreServiceSurveyRequest;
use App\Models\ServiceSurvey;
use App\Services\InquirySubmissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function complaintsAndSurvey(): View
    {
        $surveyCount = ServiceSurvey::count();

        return view('pages.layanan.pengaduan-survei', [
            'serviceTypes' => ServiceSurvey::SERVICE_TYPES,
            'surveyCount' => $surveyCount,
        ]);
    }

    public function storeComplaint(StoreInquiryRequest $request, InquirySubmissionService $service): RedirectResponse
    {
        $inquiry = $service->submit('pengaduan_layanan', $request->validated());

        return redirect()
            ->route('layanan.pengaduan', ['#form-pengaduan'])
            ->with('complaint_success', "Pengaduan atau masukan layanan tercatat dengan kode {$inquiry->reference_code}.");
    }

    public function storeSurvey(StoreServiceSurveyRequest $request): RedirectResponse
    {
        ServiceSurvey::create($request->validated());

        return redirect()
            ->route('layanan.pengaduan', ['#form-survei'])
            ->with('survey_success', 'Terima kasih. Penilaian survei kepuasan layanan Anda telah tersimpan untuk evaluasi mutu.');
    }

    public function assetRental(): View
    {
        $assets = [
            [
                'code' => 'ASET-01',
                'name' => 'Auditorium Utama Kampus Parung',
                'usage' => 'Seminar, Rapat Koordinasi, dan Pertemuan Instansi',
                'capacity' => '[Kapasitas & Tarif PNBP Resmi Menyusul]',
                'status' => 'tersedia',
            ],
            [
                'code' => 'ASET-02',
                'name' => 'Ruang Kelas Pelatihan dan Diskusi',
                'usage' => 'Diklat, Lokakarya, dan Ujian Sertifikasi',
                'capacity' => '[Kapasitas & Tarif PNBP Resmi Menyusul]',
                'status' => 'tersedia',
            ],
            [
                'code' => 'ASET-03',
                'name' => 'Asrama Peserta Pelatihan',
                'usage' => 'Akomodasi Peserta Program Non-Internal / Kerja Sama',
                'capacity' => '[Jumlah Unit & Tarif PNBP Resmi Menyusul]',
                'status' => 'terjadwal',
            ],
        ];

        return view('pages.layanan.penyewaan-aset', [
            'assets' => $assets,
        ]);
    }

    public function storeAssetInquiry(StoreInquiryRequest $request, InquirySubmissionService $service): RedirectResponse
    {
        $inquiry = $service->submit('penyewaan_aset', $request->validated());

        return redirect()
            ->route('layanan.aset', ['#permohonan-aset'])
            ->with('asset_success', "Permintaan informasi pemanfaatan aset tercatat dengan nomor referensi {$inquiry->reference_code}.");
    }
}
