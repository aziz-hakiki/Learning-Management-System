<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ElearningController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PpidController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::prefix('profil')->name('profil.')->group(function (): void {
    Route::get('/', fn () => redirect()->route('profil.tugas-fungsi'))->name('index');
    Route::get('/sejarah', [ProfileController::class, 'sejarah'])->name('sejarah');
    Route::get('/tugas-fungsi', [ProfileController::class, 'tugasFungsi'])->name('tugas-fungsi');
    Route::get('/struktur-organisasi', [ProfileController::class, 'strukturOrganisasi'])->name('struktur');
    Route::get('/fasilitas', [ProfileController::class, 'fasilitas'])->name('fasilitas');
});

Route::prefix('program')->group(function (): void {
    Route::get('/corporate-university', [ProgramController::class, 'corporateUniversity'])->name('program.corpu');
    Route::get('/assessment-center', [ProgramController::class, 'assessmentCenter'])->name('program.assessment');
    Route::get('/pelatihan', [ProgramController::class, 'index'])->name('diklat.index');
    Route::get('/pelatihan/filter', [ProgramController::class, 'filter'])->name('diklat.filter');
    Route::get('/pelatihan/{program:slug}', [ProgramController::class, 'show'])->name('diklat.show');
    Route::get('/rintisan-gelar', [ProgramController::class, 'rintisanGelar'])->name('program.rintisan-gelar');
});

Route::prefix('publikasi')->group(function (): void {
    Route::get('/berita', [ArticleController::class, 'index'])->name('informasi.index');
    Route::get('/berita/{article:slug}', [ArticleController::class, 'show'])->name('informasi.show');
    Route::get('/e-buletin', [PublicationController::class, 'bulletin'])->name('publikasi.buletin');
});

Route::prefix('layanan')->group(function (): void {
    Route::get('/ppid', [PpidController::class, 'index'])->name('ppid.index');
    Route::post('/ppid/permohonan', [PpidController::class, 'store'])->name('ppid.store');

    Route::get('/pengaduan-survei', [ServiceController::class, 'complaintsAndSurvey'])->name('layanan.pengaduan');
    Route::post('/pengaduan-survei/pengaduan', [ServiceController::class, 'storeComplaint'])->name('layanan.pengaduan.store');
    Route::post('/pengaduan-survei/survei', [ServiceController::class, 'storeSurvey'])->name('layanan.survei.store');

    Route::get('/penyewaan-aset', [ServiceController::class, 'assetRental'])->name('layanan.aset');
    Route::post('/penyewaan-aset/permohonan', [ServiceController::class, 'storeAssetInquiry'])->name('layanan.aset.store');

    Route::get('/lms-corpu', ElearningController::class)->name('elearning');
});

Route::get('/kontak', [ContactController::class, 'index'])->name('kontak.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

// Legacy URL redirects so previously bookmarked paths resolve cleanly without 404s.
Route::get('/diklat', fn () => redirect()->route('diklat.index'));
Route::get('/diklat/{slug}', fn (string $slug) => redirect()->route('diklat.show', $slug));
Route::get('/informasi', fn () => redirect()->route('informasi.index'));
Route::get('/informasi/{slug}', fn (string $slug) => redirect()->route('informasi.show', $slug));
Route::get('/layanan-ppid', fn () => redirect()->route('ppid.index'));
Route::get('/e-learning', fn () => redirect()->route('elearning'));
