<x-layouts.app
    title="Berita, Pengumuman, dan Agenda - PPSDMAP Kemenhub"
    description="Arsip berita kegiatan kediklatan, pengumuman pemanggilan peserta, dan agenda webinar PPSDMAP Kementerian Perhubungan."
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[['label' => 'Publikasi', 'url' => route('informasi.index')], ['label' => 'Berita']]" />
        <x-section-subnav :items="[
            ['label' => 'Berita', 'route' => 'informasi.index', 'active' => true],
            ['label' => 'E-Buletin', 'route' => 'publikasi.buletin', 'active' => false],
        ]" label="Navigasi publikasi PPSDMAP" />

        <div class="max-w-3xl">
            <span class="horizon-rule-ochre" aria-hidden="true"></span>
            <h1 class="type-h1 mt-4 text-[#0B2545]">Berita, Pengumuman, dan Agenda</h1>
            <p class="mt-3 text-base leading-relaxed text-[#4B5563]">
                Kabar penyelenggaraan diklat, edaran pemanggilan peserta, serta jadwal agenda webinar aparatur perhubungan.
            </p>
        </div>

        <form method="GET" action="{{ route('informasi.index') }}" class="mt-8 rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-5 sm:p-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end">
                <div class="flex-1">
                    <label for="informasi-search" class="block text-sm font-semibold text-[#0B2545]">
                        Cari Judul Berita atau Pengumuman
                    </label>
                    <input
                        id="informasi-search"
                        name="q"
                        type="search"
                        value="{{ $searchQuery ?? '' }}"
                        placeholder="Contoh: PRESTASI, Zona Integritas, atau Webinar"
                        class="mt-1.5 min-h-11 w-full rounded-md border border-[#6E737D] bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#1B2430]"
                    >
                </div>
                @if ($selectedType)
                    <input type="hidden" name="type" value="{{ $selectedType }}">
                @endif
                <button
                    type="submit"
                    class="min-h-11 inline-flex items-center justify-center rounded-md bg-[#0B2545] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#133C6D]"
                >
                    Cari Informasi
                </button>
            </div>

            <div class="mt-5 flex flex-wrap gap-2">
                <a
                    href="{{ route('informasi.index', array_filter(['q' => $searchQuery])) }}"
                    class="min-h-11 inline-flex items-center rounded-md border px-3.5 py-2 text-xs font-semibold {{ empty($selectedType) ? 'border-[#0B2545] bg-[#0B2545] text-white' : 'border-[#6E737D] bg-[#FFFFFF] text-[#1B2430] hover:bg-[#EAF0F6]' }}"
                >
                    Semua Kategori
                </a>
                @foreach ($types as $key => $label)
                    <a
                        href="{{ route('informasi.index', array_filter(['type' => $key, 'q' => $searchQuery])) }}"
                        class="min-h-11 inline-flex items-center rounded-md border px-3.5 py-2 text-xs font-semibold {{ $selectedType === $key ? 'border-[#0B2545] bg-[#0B2545] text-white' : 'border-[#6E737D] bg-[#FFFFFF] text-[#1B2430] hover:bg-[#EAF0F6]' }}"
                    >
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </form>

        <div class="mt-8">
            @if ($articles->isEmpty())
                <x-state-empty
                    title="Informasi tidak ditemukan"
                    description="Belum ada berita atau pengumuman yang cocok dengan pencarian Anda. Silakan tampilkan seluruh kategori informasi."
                    :resetUrl="route('informasi.index')"
                    resetLabel="Tampilkan Semua Informasi"
                />
            @else
                <div class="space-y-5">
                    @foreach ($articles as $article)
                        <article class="flex flex-col overflow-hidden rounded-md border border-[#D6D3CB] bg-[#FFFFFF] md:flex-row">
                            @if ($article->cover_image_path)
                                <div class="bg-[#EAF0F6] md:w-72 shrink-0">
                                    <img
                                        src="{{ asset(ltrim($article->cover_image_path, '/')) }}"
                                        alt="Ilustrasi sampul {{ $article->title }}"
                                        width="1200"
                                        height="675"
                                        loading="lazy"
                                        class="h-full w-full object-cover aspect-video"
                                    >
                                </div>
                            @endif

                            <div class="flex flex-1 flex-col justify-between p-5 sm:p-6">
                                <div>
                                    <div class="flex flex-wrap items-center gap-3 text-xs text-[#4B5563]">
                                        <x-status-badge status="mandiri" :label="$article->typeLabel()" />
                                        <time datetime="{{ $article->published_at?->toDateString() }}" class="tabular-code">
                                            {{ $article->published_at?->translatedFormat('d F Y') }}
                                        </time>
                                        @if ($article->event_date)
                                            <span class="tabular-code font-medium text-[#8A5A00]">
                                                Tanggal Kegiatan: {{ $article->event_date->translatedFormat('d M Y') }}
                                            </span>
                                        @endif
                                    </div>

                                    <h2 class="type-h3 mt-3 text-[#0B2545]">
                                        <a href="{{ route('informasi.show', $article->slug) }}" class="hover:text-[#133C6D] hover:underline">
                                            {{ $article->title }}
                                        </a>
                                    </h2>

                                    <p class="mt-2 max-w-3xl text-sm leading-relaxed text-[#4B5563]">
                                        {{ $article->excerpt }}
                                    </p>
                                </div>

                                <div class="mt-4 flex items-center justify-between gap-4 border-t border-[#D6D3CB] pt-3">
                                    <a
                                        href="{{ route('informasi.show', $article->slug) }}"
                                        class="min-h-11 inline-flex items-center text-sm font-semibold text-[#133C6D] hover:underline"
                                    >
                                        Baca Selengkapnya
                                    </a>

                                    @if ($article->is_dummy)
                                        <span class="text-xs font-medium text-[#8A5A00]">Konten Contoh</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($articles->hasPages())
                    <div class="mt-8">
                        {{ $articles->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-layouts.app>
