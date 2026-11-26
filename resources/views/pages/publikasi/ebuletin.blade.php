@php
    $publikasiNav = [
        ['label' => 'Berita', 'route' => 'informasi.index', 'active' => false],
        ['label' => 'E-Buletin', 'route' => 'publikasi.buletin', 'active' => true],
    ];
@endphp

<x-layouts.app
    title="E-Buletin - Publikasi PPSDMAP Kemenhub"
    description="Arsip terbitan E-Buletin digital Pusat Pengembangan Sumber Daya Manusia Aparatur Perhubungan."
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[['label' => 'Publikasi', 'url' => route('informasi.index')], ['label' => 'E-Buletin']]" />
        <x-section-subnav :items="$publikasiNav" label="Navigasi publikasi PPSDMAP" />

        <div class="max-w-3xl">
            <span class="horizon-rule-ochre" aria-hidden="true"></span>
            <h1 class="type-h1 mt-4 text-[#0B2545]">Arsip E-Buletin PPSDMAP</h1>
            <p class="mt-3 text-base leading-relaxed text-[#4B5563]">
                Terbitan berkala digital yang merangkum dinamika penyelenggaraan diklat, artikel gagasan widyaiswara, serta informasi tata kelola SDM aparatur perhubungan.
            </p>
        </div>

        <form method="GET" action="{{ route('publikasi.buletin') }}" class="mt-8 rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-5 sm:p-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end">
                <div class="flex-1">
                    <label for="buletin-search" class="block text-sm font-semibold text-[#0B2545]">
                        Cari Judul atau Nomor Edisi
                    </label>
                    <input
                        id="buletin-search"
                        name="q"
                        type="search"
                        value="{{ $searchQuery ?? '' }}"
                        placeholder="Contoh: Edisi 01 atau Corporate University"
                        class="mt-1.5 min-h-11 w-full rounded-md border border-[#6E737D] bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#1B2430]"
                    >
                </div>
                @if ($selectedYear)
                    <input type="hidden" name="year" value="{{ $selectedYear }}">
                @endif
                <button
                    type="submit"
                    class="min-h-11 inline-flex items-center justify-center rounded-md bg-[#0B2545] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#133C6D]"
                >
                    Cari E-Buletin
                </button>
            </div>

            @if ($years->isNotEmpty())
                <div class="mt-5 flex flex-wrap gap-2">
                    <a
                        href="{{ route('publikasi.buletin', array_filter(['q' => $searchQuery])) }}"
                        class="min-h-11 inline-flex items-center rounded-md border px-3.5 py-2 text-xs font-semibold {{ empty($selectedYear) ? 'border-[#0B2545] bg-[#0B2545] text-white' : 'border-[#6E737D] bg-[#FFFFFF] text-[#1B2430] hover:bg-[#EAF0F6]' }}"
                    >
                        Semua Tahun
                    </a>
                    @foreach ($years as $yearItem)
                        <a
                            href="{{ route('publikasi.buletin', array_filter(['year' => $yearItem, 'q' => $searchQuery])) }}"
                            class="min-h-11 inline-flex items-center rounded-md border px-3.5 py-2 text-xs font-semibold {{ (int) $selectedYear === (int) $yearItem ? 'border-[#0B2545] bg-[#0B2545] text-white' : 'border-[#6E737D] bg-[#FFFFFF] text-[#1B2430] hover:bg-[#EAF0F6]' }}"
                        >
                            Tahun {{ $yearItem }}
                        </a>
                    @endforeach
                </div>
            @endif
        </form>

        <div class="mt-8">
            @if ($bulletins->isEmpty())
                <x-state-empty
                    title="E-Buletin tidak ditemukan"
                    description="Belum ada edisi E-Buletin yang cocok dengan kata kunci atau tahun terbit yang dipilih."
                    :resetUrl="route('publikasi.buletin')"
                    resetLabel="Tampilkan Semua Edisi"
                />
            @else
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    @foreach ($bulletins as $item)
                        <article class="flex flex-col justify-between rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6">
                            <div>
                                <div class="flex flex-wrap items-center justify-between gap-2 text-xs">
                                    <span class="tabular-code font-semibold text-[#1E4E79]">{{ $item->document_number }}</span>
                                    <span class="tabular-code text-[#4B5563]">Tahun {{ $item->year }}</span>
                                </div>
                                <h2 class="type-h3 mt-3 text-[#0B2545]">{{ $item->title }}</h2>
                                @if ($item->description)
                                    <p class="mt-2.5 text-sm leading-relaxed text-[#4B5563]">{{ $item->description }}</p>
                                @endif
                            </div>

                            <div class="mt-5 flex flex-wrap items-center justify-between gap-3 border-t border-[#D6D3CB] pt-4">
                                @if ($item->file_path)
                                    <a
                                        href="{{ asset(ltrim($item->file_path, '/')) }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="min-h-11 inline-flex items-center gap-2 rounded-md bg-[#0B2545] px-4 py-2 text-xs font-semibold text-white hover:bg-[#133C6D]"
                                    >
                                        <span>Unduh E-Buletin PDF</span>
                                        <span aria-hidden="true">&#8599;</span>
                                    </a>
                                @endif
                                @if ($item->is_dummy)
                                    <x-status-badge status="dummy" label="Edisi Contoh (Dummy)" />
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
