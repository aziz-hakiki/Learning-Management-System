<x-layouts.app
    title="Gerbang E-Learning dan FAQ - PPSDMAP Kemenhub"
    description="Panduan akses Learning Management System (LMS) PPSDMAP, daftar pelatihan daring, dan pertanyaan umum peserta diklat."
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[['label' => 'Layanan', 'url' => route('ppid.index')], ['label' => 'E-Learning / LMS Corpu']]" />
        <x-section-subnav :items="[
            ['label' => 'PPID', 'route' => 'ppid.index', 'active' => false],
            ['label' => 'Pengaduan dan Survei', 'route' => 'layanan.pengaduan', 'active' => false],
            ['label' => 'Penyewaan Aset', 'route' => 'layanan.aset', 'active' => false],
            ['label' => 'E-Learning / LMS Corpu', 'route' => 'elearning', 'active' => true],
        ]" label="Navigasi layanan PPSDMAP" />

        <div class="dark-surface rounded-md bg-[#0B2545] p-6 text-[#F8F7F4] sm:p-10">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:items-center">
                <div class="lg:col-span-8">
                    <span class="horizon-rule" aria-hidden="true"></span>
                    <h1 class="type-h1 mt-4 text-white">LMS Corpu dan E-Learning PPSDMAP</h1>
                    <p class="mt-3 max-w-2xl text-base leading-relaxed text-[#EAF0F6]">
                        Platform pembelajaran daring resmi bagi peserta diklat manajerial, teknis transportasi, Orientasi PPPK, Latsar CPNS, PRESTASI, dan pelatihan mandiri Zona Integritas Kementerian Perhubungan.
                    </p>
                </div>

                <div class="flex flex-col gap-3 lg:col-span-4">
                    <a
                        href="https://ppsdmap.bpsdm.kemenhub.go.id/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="min-h-11 inline-flex items-center justify-center gap-2 rounded-md bg-[#E5A91A] px-5 py-3 text-sm font-bold text-[#0B2545] hover:bg-[#D4990E]"
                    >
                        <span>Masuk ke LMS E-Learning</span>
                        <span aria-hidden="true">&#8599;</span>
                    </a>
                    <button
                        type="button"
                        id="open-lms-checklist-btn"
                        data-dialog-open="lms-checklist-dialog"
                        class="min-h-11 inline-flex items-center justify-center rounded-md border border-[#EAF0F6]/50 px-5 py-3 text-sm font-semibold text-white hover:bg-[#133C6D]"
                    >
                        Periksa Persyaratan Akun Sebelum Masuk
                    </button>
                </div>
            </div>
        </div>

        <section class="mt-12" aria-label="Alur akses LMS peserta">
            <h2 class="type-h2 text-[#0B2545]">Alur Akses Pembelajaran Daring</h2>
            <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-3">
                @foreach ($lmsSteps as $index => $step)
                    <div class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6">
                        <span class="tabular-code inline-flex h-8 w-8 items-center justify-center rounded-sm bg-[#EAF0F6] text-xs font-bold text-[#0B2545]">
                            0{{ $index + 1 }}
                        </span>
                        <h3 class="type-h3 mt-4 text-[#0B2545]">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#4B5563]">{{ $step['detail'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        @if ($onlinePrograms->isNotEmpty())
            <section class="mt-12 border-t border-[#D6D3CB] pt-10">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 class="type-h2 text-[#0B2545]">Program dengan Modul Daring / Blended</h2>
                        <p class="mt-1 text-sm text-[#4B5563]">Daftar pelatihan yang memanfaatkan LMS PPSDMAP selama penyelenggaraan.</p>
                    </div>
                    <a href="{{ route('diklat.index') }}" class="min-h-11 inline-flex items-center text-sm font-semibold text-[#133C6D] hover:underline">
                        Buka Katalog Lengkap
                    </a>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                    @foreach ($onlinePrograms as $program)
                        <x-program-card :program="$program" />
                    @endforeach
                </div>
            </section>
        @endif

        <section id="faq" class="mt-14 border-t border-[#D6D3CB] pt-10">
            <h2 class="type-h2 text-[#0B2545]">Pertanyaan Umum Peserta dan Pengguna LMS</h2>
            <p class="mt-2 text-sm text-[#4B5563]">
                Jawaban atas pertanyaan operasional seputar akun LMS, pemanggilan peserta, sertifikat, dan layanan informasi PPSDMAP.
            </p>

            <div class="mt-5 flex flex-wrap gap-2">
                <a
                    href="{{ route('elearning') }}#faq"
                    class="min-h-11 inline-flex items-center rounded-md border px-3.5 py-2 text-xs font-semibold {{ empty($selectedCategory) ? 'border-[#0B2545] bg-[#0B2545] text-white' : 'border-[#6E737D] bg-[#FFFFFF] text-[#1B2430] hover:bg-[#EAF0F6]' }}"
                >
                    Semua Topik
                </a>
                @foreach ($faqCategories as $key => $label)
                    <a
                        href="{{ route('elearning', ['faq_category' => $key]) }}#faq"
                        class="min-h-11 inline-flex items-center rounded-md border px-3.5 py-2 text-xs font-semibold {{ $selectedCategory === $key ? 'border-[#0B2545] bg-[#0B2545] text-white' : 'border-[#6E737D] bg-[#FFFFFF] text-[#1B2430] hover:bg-[#EAF0F6]' }}"
                    >
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <div class="mt-6 space-y-3">
                @forelse ($faqs as $faq)
                    <details class="group rounded-md border border-[#D6D3CB] bg-[#FFFFFF]">
                        <summary class="flex min-h-11 items-center justify-between gap-4 px-5 py-4 text-sm font-semibold text-[#0B2545] hover:bg-[#F8F7F4] sm:text-base">
                            <span>{{ $faq->question }}</span>
                            <span aria-hidden="true" class="shrink-0 text-xs font-bold text-[#1E4E79]">Buka / Tutup</span>
                        </summary>
                        <div class="border-t border-[#D6D3CB] px-5 py-4 text-sm leading-relaxed text-[#4B5563]">
                            <p class="mb-2 text-xs font-semibold text-[#8A5A00]">{{ $faq->categoryLabel() }}</p>
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </details>
                @empty
                    <x-state-empty
                        title="Belum ada FAQ pada topik ini"
                        description="Silakan tampilkan semua topik atau kirim pertanyaan Anda langsung melalui halaman Kontak & Helpdesk."
                        :resetUrl="route('elearning') . '#faq'"
                        resetLabel="Tampilkan Semua Topik FAQ"
                    />
                @endforelse
            </div>
        </section>
    </div>

    <dialog
        id="lms-checklist-dialog"
        data-portal-dialog
        aria-labelledby="lms-dialog-title"
        class="m-auto w-[calc(100%-2rem)] max-w-lg rounded-lg border border-[#D6D3CB] bg-[#FFFFFF] p-6 text-[#1B2430] shadow-xl backdrop:bg-[#0B2545]/60"
    >
        <div class="flex items-start justify-between gap-4 border-b border-[#D6D3CB] pb-4">
            <h2 id="lms-dialog-title" class="type-h3 text-[#0B2545]">Checklist Persiapan Masuk LMS</h2>
            <button
                type="button"
                data-dialog-close
                aria-label="Tutup dialog persiapan LMS"
                class="min-h-11 min-w-11 inline-flex items-center justify-center rounded-md border border-[#6E737D] px-3 text-xs font-semibold text-[#0B2545] hover:bg-[#EAF0F6]"
            >
                Tutup
            </button>
        </div>

        <ul class="mt-4 list-disc space-y-2.5 pl-5 text-sm leading-relaxed text-[#1B2430]">
            <li>Pastikan NIP dan nama lengkap Anda tercantum pada surat pemanggilan resmi atau daftar peserta kelas aktif.</li>
            <li>Siapkan kredensial awal yang dibagikan melalui email dinas atau grup koordinasi panitia penyelenggara.</li>
            <li>Jika mengalami kendala aktivasi, hubungi Helpdesk LMS di nomor <span class="tabular-code font-semibold">0811 1175 430</span> atau gunakan formulir Kontak.</li>
        </ul>

        <div class="mt-6 flex flex-wrap justify-end gap-3 border-t border-[#D6D3CB] pt-4">
            <button
                type="button"
                data-dialog-close
                class="min-h-11 rounded-md border border-[#6E737D] px-4 py-2 text-sm font-semibold text-[#0B2545] hover:bg-[#EAF0F6]"
            >
                Kembali
            </button>
            <a
                href="https://ppsdmap.bpsdm.kemenhub.go.id/"
                target="_blank"
                rel="noopener noreferrer"
                class="min-h-11 inline-flex items-center gap-2 rounded-md bg-[#0B2545] px-4 py-2 text-sm font-semibold text-white hover:bg-[#133C6D]"
            >
                <span>Lanjut ke Portal LMS</span>
                <span aria-hidden="true">&#8599;</span>
            </a>
        </div>
    </dialog>
</x-layouts.app>
