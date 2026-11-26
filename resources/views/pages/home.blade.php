<x-layouts.app
    title="Beranda - PPSDMAP BPSDMP Kementerian Perhubungan"
    description="Portal informasi kediklatan, katalog program pengembangan kompetensi, layanan PPID, dan gerbang E-Learning PPSDMAP Kementerian Perhubungan."
>
    {{-- Section 1: Editorial Split Hero --}}
    <section class="border-b border-[#D6D3CB] bg-[#FFFFFF]">
        <div class="mx-auto grid max-w-[1240px] grid-cols-1 items-center gap-10 px-4 py-10 sm:px-6 md:py-14 lg:grid-cols-12 lg:gap-12 lg:py-16">
            <div class="lg:col-span-6">
                <span class="horizon-rule-ochre" aria-hidden="true"></span>
                <h1 class="type-h1 mt-5 text-[#0B2545]">
                    Pengembangan Kompetensi SDM Aparatur Perhubungan
                </h1>
                <p class="mt-4 max-w-xl text-base leading-relaxed text-[#1B2430]">
                    Pusat Pengembangan Sumber Daya Manusia Aparatur Perhubungan (PPSDMAP) di bawah BPSDMP Kementerian Perhubungan menyelenggarakan pendidikan dan pelatihan manajerial, struktural, fungsional, teknis transportasi, serta pembinaan karakter bagi ASN sektor perhubungan.
                </p>

                <div class="mt-7 flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center">
                    <a
                        href="{{ route('diklat.index') }}"
                        class="min-h-11 inline-flex items-center justify-center rounded-md bg-[#0B2545] px-5 py-3 text-sm font-semibold text-white hover:bg-[#133C6D]"
                    >
                        Lihat Katalog Diklat
                    </a>
                    <a
                        href="{{ route('elearning') }}"
                        class="min-h-11 inline-flex items-center justify-center rounded-md border border-[#6E737D] bg-[#FFFFFF] px-5 py-3 text-sm font-semibold text-[#0B2545] hover:bg-[#EAF0F6]"
                    >
                        Masuk ke Gerbang E-Learning
                    </a>
                </div>
            </div>

            <div class="lg:col-span-6">
                <figure class="overflow-hidden rounded-lg border border-[#D6D3CB] bg-[#F1EFEA]">
                    <img
                        src="{{ asset('images/dummy/hero-kampus-dummy.svg') }}"
                        alt="Ilustrasi arsitektural dummy kampus PPSDMAP di Parung, Bogor"
                        width="1280"
                        height="720"
                        fetchpriority="high"
                        class="h-auto w-full object-cover aspect-video"
                    >
                    <figcaption class="border-t border-[#D6D3CB] bg-[#F8F7F4] px-4 py-2.5 text-xs text-[#4B5563]">
                        Ilustrasi prototipe [Asset Dummy]. Lokasi kantor: Jl. Raya Parung - Bogor KM. 26,4, Kab. Bogor.
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>

    {{-- Section 2: Jalur Layanan Utama (Asimetris Berhierarki) --}}
    <section class="mx-auto max-w-[1240px] px-4 py-12 sm:px-6 lg:py-16">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
            <div class="dark-surface flex flex-col justify-between rounded-md bg-[#0B2545] p-6 text-[#F8F7F4] sm:p-8 lg:col-span-7">
                <div>
                    <span class="horizon-rule" aria-hidden="true"></span>
                    <h2 class="type-h2 mt-4 text-white">Akses Pembelajaran Daring dan LMS Peserta</h2>
                    <p class="mt-3 max-w-xl text-sm leading-relaxed text-[#EAF0F6] sm:text-base">
                        Peserta Pelatihan Teknis Transportasi, PKP, PRESTASI, Orientasi PPPK, Latsar CPNS, dan Pelatihan Mandiri Zona Integritas mengakses materi ajar serta evaluasi melalui sistem E-Learning PPSDMAP.
                    </p>
                </div>

                <div class="mt-7 flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center">
                    <a
                        href="{{ route('elearning') }}"
                        class="min-h-11 inline-flex items-center justify-center rounded-md bg-[#E5A91A] px-5 py-3 text-sm font-bold text-[#0B2545] hover:bg-[#D4990E]"
                    >
                        Buka Panduan dan Tautan LMS
                    </a>
                    <a
                        href="{{ route('kontak.index') }}"
                        class="min-h-11 inline-flex items-center justify-center rounded-md border border-[#EAF0F6]/50 px-5 py-3 text-sm font-semibold text-white hover:bg-[#133C6D]"
                    >
                        Hubungi Helpdesk Akun
                    </a>
                </div>
            </div>

            <div class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6 sm:p-8 lg:col-span-5">
                <h2 class="type-h3 text-[#0B2545]">Layanan Portal Lainnya</h2>
                <ul class="mt-4 divide-y divide-[#D6D3CB]">
                    <li class="py-3.5 first:pt-0">
                        <a href="{{ route('ppid.index') }}" class="group block rounded-md py-1">
                            <span class="block text-sm font-semibold text-[#133C6D] group-hover:underline">Keterbukaan Informasi Publik (PPID)</span>
                            <span class="mt-1 block text-xs text-[#4B5563]">Unduh daftar informasi berkala, regulasi, dan ajukan permohonan informasi.</span>
                        </a>
                    </li>
                    <li class="py-3.5">
                        <a href="{{ route('profil.tugas-fungsi') }}" class="group block rounded-md py-1">
                            <span class="block text-sm font-semibold text-[#133C6D] group-hover:underline">Mandat, Struktur, dan Fasilitas Kampus</span>
                            <span class="mt-1 block text-xs text-[#4B5563]">Tugas pokok, fungsi pembinaan karakter, serta fasilitas pembelajaran Parung.</span>
                        </a>
                    </li>
                    <li class="py-3.5">
                        <a href="{{ route('program.assessment') }}" class="group block rounded-md py-1">
                            <span class="block text-sm font-semibold text-[#133C6D] group-hover:underline">Assessment Center dan Corporate University</span>
                            <span class="mt-1 block text-xs text-[#4B5563]">Pemetaan kompetensi ASN serta pengembangan terpadu Kemenhub Corpu.</span>
                        </a>
                    </li>
                    <li class="py-3.5 last:pb-0">
                        <a href="{{ route('layanan.pengaduan') }}" class="group block rounded-md py-1">
                            <span class="block text-sm font-semibold text-[#133C6D] group-hover:underline">Pengaduan, Survei, dan Penyewaan Aset</span>
                            <span class="mt-1 block text-xs text-[#4B5563]">Kanal umpan balik pelayanan publik dan pemanfaatan fasilitas kampus.</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    {{-- Section 3: Program Pengembangan Kompetensi (ARIA Tabs) --}}
    <section data-tabs-root class="border-y border-[#D6D3CB] bg-[#FFFFFF]">
        <div class="mx-auto max-w-[1240px] px-4 py-12 sm:px-6 lg:py-16">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <span class="horizon-rule-ochre" aria-hidden="true"></span>
                    <h2 class="type-h2 mt-4 text-[#0B2545]">Program Pengembangan Kompetensi</h2>
                    <p class="mt-2 max-w-2xl text-sm text-[#4B5563] sm:text-base">
                        Telusuri program pelatihan aktif dan terjadwal berdasarkan rumpun kompetensi aparatur perhubungan.
                    </p>
                </div>
                <a
                    href="{{ route('diklat.index') }}"
                    class="min-h-11 inline-flex items-center font-semibold text-sm text-[#133C6D] hover:text-[#0B2545] hover:underline shrink-0"
                >
                    Lihat Semua Program ({{ $programs->count() }})
                </a>
            </div>

            @php
                $tabKeys = [
                    'unggulan' => 'Program Unggulan',
                    'manajerial' => $programCategories['manajerial'],
                    'teknis' => $programCategories['teknis'],
                    'integritas' => $programCategories['integritas'],
                    'orientasi' => $programCategories['orientasi'],
                ];
            @endphp

            <div
                role="tablist"
                aria-label="Filter rumpun program pelatihan"
                data-tablist
                class="mt-7 flex flex-wrap gap-2 border-b border-[#D6D3CB] pb-3"
            >
                @foreach ($tabKeys as $key => $label)
                    <button
                        type="button"
                        role="tab"
                        id="tab-program-{{ $key }}"
                        aria-controls="panel-program-{{ $key }}"
                        aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                        tabindex="{{ $loop->first ? '0' : '-1' }}"
                        class="min-h-11 rounded-md border px-4 py-2 text-sm font-semibold transition-colors aria-selected:border-[#0B2545] aria-selected:bg-[#0B2545] aria-selected:text-white border-[#6E737D] bg-[#FFFFFF] text-[#1B2430] hover:bg-[#EAF0F6]"
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            @foreach ($tabKeys as $key => $label)
                @php
                    $items = $key === 'unggulan'
                        ? $programs->where('is_featured', true)->values()
                        : $programs->where('category', $key)->values();
                @endphp
                <div
                    role="tabpanel"
                    id="panel-program-{{ $key }}"
                    aria-labelledby="tab-program-{{ $key }}"
                    @if (! $loop->first) hidden @endif
                    class="mt-6"
                >
                    @if ($items->isEmpty())
                        <x-state-empty
                            title="Belum ada program pada kelompok {{ $label }}"
                            description="Silakan buka direktori program lengkap untuk melihat kategori pelatihan lainnya."
                            :resetUrl="route('diklat.index')"
                            resetLabel="Buka Direktori Lengkap"
                        />
                    @else
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($items as $program)
                                <x-program-card :program="$program" :featured="$loop->first && $key === 'unggulan'" />
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    {{-- Section 4: Kabar Terbaru dan Pengumuman (Asymmetric Bulletin Layout) --}}
    <section class="mx-auto max-w-[1240px] px-4 py-12 sm:px-6 lg:py-16">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <span class="horizon-rule-ochre" aria-hidden="true"></span>
                <h2 class="type-h2 mt-4 text-[#0B2545]">Berita, Pengumuman, dan Agenda</h2>
            </div>
            <a
                href="{{ route('informasi.index') }}"
                class="min-h-11 inline-flex items-center font-semibold text-sm text-[#133C6D] hover:text-[#0B2545] hover:underline"
            >
                Arsip Informasi Lengkap
            </a>
        </div>

        @if ($featuredArticle)
            <div class="mt-7 grid grid-cols-1 gap-8 lg:grid-cols-12">
                <article class="overflow-hidden rounded-md border border-[#D6D3CB] bg-[#FFFFFF] lg:col-span-7">
                    @if ($featuredArticle->cover_image_path)
                        <img
                            src="{{ asset(ltrim($featuredArticle->cover_image_path, '/')) }}"
                            alt="Ilustrasi sampul berita {{ $featuredArticle->title }}"
                            width="1200"
                            height="675"
                            loading="lazy"
                            class="h-auto w-full object-cover aspect-video"
                        >
                    @endif
                    <div class="p-6 sm:p-7">
                        <div class="flex flex-wrap items-center gap-3 text-xs text-[#4B5563]">
                            <x-status-badge status="mandiri" :label="$featuredArticle->typeLabel()" />
                            <time datetime="{{ $featuredArticle->published_at?->toDateString() }}" class="tabular-code">
                                {{ $featuredArticle->published_at?->translatedFormat('d F Y') }}
                            </time>
                        </div>
                        <h3 class="type-h3 mt-3 text-[#0B2545]">
                            <a href="{{ route('informasi.show', $featuredArticle->slug) }}" class="hover:text-[#133C6D] hover:underline">
                                {{ $featuredArticle->title }}
                            </a>
                        </h3>
                        <p class="mt-2.5 text-sm leading-relaxed text-[#4B5563]">
                            {{ $featuredArticle->excerpt }}
                        </p>
                        <div class="mt-5">
                            <a
                                href="{{ route('informasi.show', $featuredArticle->slug) }}"
                                class="min-h-11 inline-flex items-center font-semibold text-sm text-[#133C6D] hover:underline"
                            >
                                Baca Berita Lengkap
                            </a>
                        </div>
                    </div>
                </article>

                <div class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6 sm:p-7 lg:col-span-5">
                    <h3 class="type-h3 text-[#0B2545]">Pengumuman dan Agenda Terbaru</h3>
                    @if ($recentBulletins->isEmpty())
                        <p class="mt-4 text-sm text-[#4B5563]">Belum ada pengumuman tambahan yang diterbitkan.</p>
                    @else
                        <ul class="mt-4 divide-y divide-[#D6D3CB]">
                            @foreach ($recentBulletins as $bulletin)
                                <li class="py-4 first:pt-0 last:pb-0">
                                    <div class="flex items-center justify-between gap-2 text-xs text-[#4B5563]">
                                        <span class="font-semibold text-[#1E4E79]">{{ $bulletin->typeLabel() }}</span>
                                        <time datetime="{{ $bulletin->published_at?->toDateString() }}" class="tabular-code">
                                            {{ $bulletin->published_at?->translatedFormat('d M Y') }}
                                        </time>
                                    </div>
                                    <a
                                        href="{{ route('informasi.show', $bulletin->slug) }}"
                                        class="mt-1.5 block text-sm font-semibold leading-snug text-[#0B2545] hover:text-[#133C6D] hover:underline"
                                    >
                                        {{ $bulletin->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        @else
            <div class="mt-6">
                <x-state-empty
                    title="Belum ada berita atau pengumuman terbit"
                    description="Konten berita dan pengumuman kediklatan belum tersedia pada database saat ini."
                />
            </div>
        @endif
    </section>

    {{-- Section 5: Tata Kelola Zona Integritas & PPID --}}
    <section class="border-t border-[#D6D3CB] bg-[#F1EFEA]">
        <div class="mx-auto max-w-[1240px] px-4 py-12 sm:px-6 lg:py-16">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:items-start">
                <div class="lg:col-span-5">
                    <span class="horizon-rule-ochre" aria-hidden="true"></span>
                    <h2 class="type-h2 mt-4 text-[#0B2545]">Zona Integritas (WBK/WBBM) dan Layanan PPID</h2>
                    <p class="mt-3 text-sm leading-relaxed text-[#1B2430] sm:text-base">
                        PPSDMAP berkomitmen membangun birokrasi yang bersih dan melayani melalui penguatan integritas pegawai (PRESTASI bersama KPK) serta keterbukaan informasi publik yang dapat diakses langsung oleh masyarakat.
                    </p>
                    <div class="mt-6">
                        <a
                            href="{{ route('ppid.index') }}"
                            class="min-h-11 inline-flex items-center justify-center rounded-md bg-[#0B2545] px-5 py-3 text-sm font-semibold text-white hover:bg-[#133C6D]"
                        >
                            Buka Dokumen dan Permohonan PPID
                        </a>
                    </div>
                </div>

                <div class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6 lg:col-span-7">
                    <h3 class="type-h3 text-[#0B2545]">Dokumen Informasi Publik Terbaru (Contoh)</h3>
                    @if ($highlightsPpid->isEmpty())
                        <p class="mt-3 text-sm text-[#4B5563]">Belum ada dokumen PPID yang dipublikasikan.</p>
                    @else
                        <ul class="mt-4 divide-y divide-[#D6D3CB]">
                            @foreach ($highlightsPpid as $doc)
                                <li class="flex flex-col gap-3 py-4 first:pt-0 last:pb-0 sm:flex-row sm:items-center sm:justify-between">
                                    <div>
                                        <div class="flex flex-wrap items-center gap-2 text-xs text-[#4B5563]">
                                            <span class="tabular-code font-medium text-[#1E4E79]">{{ $doc->document_number }}</span>
                                            <span>{{ $doc->categoryLabel() }}</span>
                                        </div>
                                        <p class="mt-1 text-sm font-semibold text-[#0B2545]">{{ $doc->title }}</p>
                                    </div>
                                    @if ($doc->file_path)
                                        <a
                                            href="{{ asset(ltrim($doc->file_path, '/')) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="min-h-11 inline-flex items-center justify-center rounded-md border border-[#6E737D] px-4 py-2 text-xs font-semibold text-[#0B2545] hover:bg-[#EAF0F6] shrink-0"
                                        >
                                            Unduh PDF
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
