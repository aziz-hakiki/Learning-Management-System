@php
    $layananNav = [
        ['label' => 'PPID', 'route' => 'ppid.index', 'active' => false],
        ['label' => 'Pengaduan dan Survei', 'route' => 'layanan.pengaduan', 'active' => true],
        ['label' => 'Penyewaan Aset', 'route' => 'layanan.aset', 'active' => false],
        ['label' => 'E-Learning / LMS Corpu', 'route' => 'elearning', 'active' => false],
    ];

    $ratingAspects = [
        'rating_clarity' => 'Kejelasan Informasi dan Prosedur Layanan',
        'rating_speed' => 'Kecepatan Waktu Penyelesaian Layanan',
        'rating_officer' => 'Respons dan Sikap Petugas Penyelenggara',
        'rating_facility' => 'Kualitas Sarana, Kelas, atau Sistem Daring',
    ];

    $ratingOptions = [
        1 => '1 - Kurang Baik',
        2 => '2 - Cukup',
        3 => '3 - Baik',
        4 => '4 - Sangat Baik',
    ];
@endphp

<x-layouts.app
    title="Pengaduan dan Survei - Layanan PPSDMAP Kemenhub"
    description="Kanal penyampaian pengaduan layanan publik, Zona Integritas WBK/WBBM, dan survei kepuasan peserta PPSDMAP."
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[['label' => 'Layanan', 'url' => route('ppid.index')], ['label' => 'Pengaduan dan Survei']]" />
        <x-section-subnav :items="$layananNav" label="Navigasi layanan PPSDMAP" />

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:items-end">
            <div class="lg:col-span-8">
                <span class="horizon-rule-ochre" aria-hidden="true"></span>
                <h1 class="type-h1 mt-4 text-[#0B2545]">Pengaduan Layanan dan Survei Kepuasan</h1>
                <p class="mt-3 text-base leading-relaxed text-[#1B2430]">
                    Sampaikan laporan kendala penyelenggaraan diklat, masukan Zona Integritas WBK/WBBM, maupun evaluasi kepuasan Anda atas pelayanan PPSDMAP. Untuk pertanyaan kontak umum dan bantuan akun LMS, Anda juga dapat mengunjungi halaman <a href="{{ route('kontak.index') }}" class="font-semibold text-[#133C6D] underline">Kontak dan Helpdesk</a>.
                </p>
            </div>
            <div class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-4 text-sm lg:col-span-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-[#4B5563]">Partisipasi Survei Tersimpan</p>
                <p class="tabular-code mt-1 text-lg font-bold text-[#0B2545]">{{ $surveyCount }} respons</p>
            </div>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-10 lg:grid-cols-12 lg:items-start">
            <section id="form-pengaduan" class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6 sm:p-8 lg:col-span-6">
                <h2 class="type-h2 text-[#0B2545]">Formulir Pengaduan Layanan</h2>
                <p class="mt-2 mb-6 text-sm text-[#4B5563]">
                    Setiap pengaduan memperoleh nomor tiket referensi dan diteruskan kepada unit pengawasan internal serta Bagian Tata Usaha.
                </p>

                <x-inquiry-form
                    :action="route('layanan.pengaduan.store')"
                    formId="complaint-form"
                    successKey="complaint_success"
                    submitLabel="Kirim Pengaduan Layanan"
                    subjectLabel="Topik Pengaduan / Masukan"
                    subjectPlaceholder="Contoh: Masukan fasilitas kelas atau keterlambatan dokumen"
                    messageLabel="Uraian Pengaduan dan Kronologi"
                    messagePlaceholder="Tuliskan rincian kejadian, tanggal, dan nama program bila terkait penyelenggaraan diklat..."
                />
            </section>

            <section id="form-survei" class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6 sm:p-8 lg:col-span-6">
                <h2 class="type-h2 text-[#0B2545]">Survei Kepuasan Layanan</h2>
                <p class="mt-2 mb-6 text-sm text-[#4B5563]">
                    Penilaian Anda digunakan sebagai bahan pemantauan mutu penyelenggaraan pelatihan dan layanan publik PPSDMAP.
                </p>

                @if (session('survey_success'))
                    <div role="status" aria-live="polite" class="mb-6 rounded-md border border-[#166534]/40 bg-[#DCFCE7] p-4 text-sm text-[#166534]">
                        <p class="font-semibold">Survei Tersimpan</p>
                        <p class="mt-1">{{ session('survey_success') }}</p>
                    </div>
                @endif

                @if ($errors->hasAny(['service_type', 'rating_clarity', 'rating_speed', 'rating_officer', 'rating_facility']))
                    <div id="survey-error-summary" tabindex="-1" role="alert" data-error-summary class="mb-6 rounded-md border border-[#991B1B]/40 bg-[#FEE2E2] p-4 text-sm text-[#991B1B]">
                        <p class="font-semibold">Mohon lengkapi pilihan survei yang bertanda wajib sebelum mengirim:</p>
                        <ul class="mt-2 list-disc space-y-1 pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('layanan.survei.store') }}" novalidate class="space-y-5">
                    @csrf

                    <div>
                        <label for="survey-service-type" class="block text-sm font-semibold text-[#0B2545]">
                            Jenis Layanan yang Dinilai <span class="text-[#991B1B]" aria-hidden="true">*</span>
                        </label>
                        <select
                            id="survey-service-type"
                            name="service_type"
                            required
                            @error('service_type') aria-invalid="true" aria-describedby="survey-service-error" @enderror
                            class="mt-1.5 min-h-11 w-full rounded-md border {{ $errors->has('service_type') ? 'border-[#991B1B]' : 'border-[#6E737D]' }} bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#1B2430]"
                        >
                            <option value="">Pilih layanan...</option>
                            @foreach ($serviceTypes as $key => $label)
                                <option value="{{ $key }}" @selected(old('service_type') === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('service_type')
                            <p id="survey-service-error" role="alert" class="mt-1.5 text-xs font-medium text-[#991B1B]">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="survey-name" class="block text-sm font-semibold text-[#0B2545]">Nama (Opsional)</label>
                            <input
                                id="survey-name"
                                name="respondent_name"
                                type="text"
                                value="{{ old('respondent_name') }}"
                                placeholder="Nama Anda"
                                class="mt-1.5 min-h-11 w-full rounded-md border border-[#6E737D] bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#1B2430]"
                            >
                        </div>
                        <div>
                            <label for="survey-unit" class="block text-sm font-semibold text-[#0B2545]">Unit Kerja (Opsional)</label>
                            <input
                                id="survey-unit"
                                name="respondent_unit"
                                type="text"
                                value="{{ old('respondent_unit') }}"
                                placeholder="Nama unit kerja / instansi"
                                class="mt-1.5 min-h-11 w-full rounded-md border border-[#6E737D] bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#1B2430]"
                            >
                        </div>
                    </div>

                    @foreach ($ratingAspects as $field => $aspectLabel)
                        <fieldset class="rounded-md border border-[#D6D3CB] bg-[#F8F7F4] p-4">
                            <legend class="px-1 text-sm font-semibold text-[#0B2545]">
                                {{ $aspectLabel }} <span class="text-[#991B1B]" aria-hidden="true">*</span>
                            </legend>
                            <div class="mt-2 grid grid-cols-2 gap-2 sm:grid-cols-4">
                                @foreach ($ratingOptions as $val => $optLabel)
                                    <label class="min-h-11 flex items-center gap-2 rounded-md border border-[#6A6F78] bg-[#FFFFFF] px-3 py-2 text-xs font-medium text-[#1B2430] hover:bg-[#EAF0F6]">
                                        <input
                                            type="radio"
                                            name="{{ $field }}"
                                            value="{{ $val }}"
                                            @checked((int) old($field) === $val)
                                            class="h-4 w-4 accent-[#0B2545]"
                                        >
                                        <span>{{ $optLabel }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error($field)
                                <p role="alert" class="mt-2 text-xs font-medium text-[#991B1B]">{{ $message }}</p>
                            @enderror
                        </fieldset>
                    @endforeach

                    <div>
                        <label for="survey-feedback" class="block text-sm font-semibold text-[#0B2545]">
                            Saran Perbaikan Layanan (Opsional)
                        </label>
                        <textarea
                            id="survey-feedback"
                            name="feedback"
                            rows="3"
                            placeholder="Tuliskan saran perbaikan agar kualitas layanan kediklatan semakin baik..."
                            class="mt-1.5 w-full rounded-md border border-[#6E737D] bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#1B2430]"
                        >{{ old('feedback') }}</textarea>
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="min-h-11 inline-flex items-center justify-center rounded-md bg-[#0B2545] px-6 py-3 text-sm font-semibold text-white hover:bg-[#133C6D]"
                        >
                            Kirim Survei Kepuasan
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-layouts.app>
