<x-layouts.app
    title="Katalog Program Diklat - PPSDMAP Kemenhub"
    description="Daftar program pendidikan dan pelatihan manajerial, teknis transportasi, integritas, orientasi PPPK, dan webinar series PPSDMAP."
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[['label' => 'Program', 'url' => route('program.corpu')], ['label' => 'Pelatihan']]" />
        <x-section-subnav :items="[
            ['label' => 'Corporate University', 'route' => 'program.corpu', 'active' => false],
            ['label' => 'Assessment Center', 'route' => 'program.assessment', 'active' => false],
            ['label' => 'Pelatihan', 'route' => 'diklat.index', 'active' => true],
            ['label' => 'Rintisan Gelar/Beasiswa', 'route' => 'program.rintisan-gelar', 'active' => false],
        ]" label="Navigasi program PPSDMAP" />

        <div class="max-w-3xl">
            <span class="horizon-rule-ochre" aria-hidden="true"></span>
            <h1 class="type-h1 mt-4 text-[#0B2545]">Katalog Program dan Diklat PPSDMAP</h1>
            <p class="mt-3 text-base leading-relaxed text-[#4B5563]">
                Saring program berdasarkan rumpun pelatihan atau cari kode serta topik diklat yang ingin diikuti oleh unit kerja Anda.
            </p>
        </div>

        <form
            method="GET"
            action="{{ route('diklat.index') }}"
            data-program-filter-form
            data-filter-url="{{ route('diklat.filter') }}"
            class="mt-8 rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-5 sm:p-6"
        >
            <input type="hidden" name="category" value="{{ $selectedCategory ?? '' }}">

            <div class="flex flex-col gap-3 sm:flex-row sm:items-end">
                <div class="flex-1">
                    <label for="diklat-search" class="block text-sm font-semibold text-[#0B2545]">
                        Cari Judul atau Kode Program
                    </label>
                    <input
                        id="diklat-search"
                        name="q"
                        type="search"
                        value="{{ $searchQuery ?? '' }}"
                        placeholder="Contoh: PKP, PTT, PRESTASI, atau DIKLAT-INT-01"
                        class="mt-1.5 min-h-11 w-full rounded-md border border-[#6E737D] bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#1B2430]"
                    >
                </div>
                <button
                    type="submit"
                    class="min-h-11 inline-flex items-center justify-center rounded-md bg-[#0B2545] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#133C6D]"
                >
                    Cari Program
                </button>
            </div>

            <div class="mt-5 flex flex-wrap gap-2" role="group" aria-label="Filter kategori pelatihan">
                <button
                    type="button"
                    data-category-btn=""
                    aria-pressed="{{ empty($selectedCategory) ? 'true' : 'false' }}"
                    class="min-h-11 rounded-md border border-[#6E737D] bg-[#FFFFFF] px-3.5 py-2 text-xs font-semibold text-[#1B2430] hover:bg-[#EAF0F6] aria-[pressed=true]:border-[#0B2545] aria-[pressed=true]:bg-[#0B2545] aria-[pressed=true]:text-white"
                >
                    Semua Rumpun
                </button>
                @foreach ($categories as $key => $label)
                    <button
                        type="button"
                        data-category-btn="{{ $key }}"
                        aria-pressed="{{ $selectedCategory === $key ? 'true' : 'false' }}"
                        class="min-h-11 rounded-md border border-[#6E737D] bg-[#FFFFFF] px-3.5 py-2 text-xs font-semibold text-[#1B2430] hover:bg-[#EAF0F6] aria-[pressed=true]:border-[#0B2545] aria-[pressed=true]:bg-[#0B2545] aria-[pressed=true]:text-white"
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </form>

        <div class="mt-5 flex items-center justify-between gap-4">
            <p data-filter-status aria-live="polite" class="text-sm font-medium text-[#4B5563]">
                Menampilkan {{ $programs->count() }} program pelatihan.
            </p>
        </div>

        {{-- Explicit loading and error states (R-27) --}}
        <div data-filter-loading hidden role="status" aria-live="polite" class="mt-4 rounded-md border border-[#1E4E79]/30 bg-[#EAF0F6] p-4 text-sm font-medium text-[#0B2545]">
            Memuat daftar program diklat dari server...
        </div>

        <div data-filter-error hidden role="alert" class="mt-4 flex flex-col gap-3 rounded-md border border-[#991B1B]/40 bg-[#FEE2E2] p-4 text-sm text-[#991B1B] sm:flex-row sm:items-center sm:justify-between">
            <span>Data gagal dimuat dari server. Periksa koneksi jaringan Anda lalu coba lagi.</span>
            <button
                type="button"
                data-filter-retry
                class="min-h-11 inline-flex items-center justify-center rounded-md bg-[#991B1B] px-4 py-2 text-xs font-semibold text-white hover:bg-[#7F1D1D]"
            >
                Coba Muat Ulang
            </button>
        </div>

        <div data-program-results class="mt-6 transition-opacity">
            @include('pages.diklat._list', ['programs' => $programs])
        </div>
    </div>
</x-layouts.app>
