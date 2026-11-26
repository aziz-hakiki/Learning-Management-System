@php
    $programNav = [
        ['label' => 'Corporate University', 'route' => 'program.corpu', 'active' => true],
        ['label' => 'Assessment Center', 'route' => 'program.assessment', 'active' => false],
        ['label' => 'Pelatihan', 'route' => 'diklat.index', 'active' => false],
        ['label' => 'Rintisan Gelar/Beasiswa', 'route' => 'program.rintisan-gelar', 'active' => false],
    ];
@endphp

<x-layouts.app
    title="Corporate University - Program PPSDMAP Kemenhub"
    description="Pengembangan kompetensi terintegrasi Kemenhub Corporate University di lingkungan PPSDMAP BPSDMP Kemenhub."
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[['label' => 'Program', 'url' => route('diklat.index')], ['label' => 'Corporate University']]" />
        <x-section-subnav :items="$programNav" label="Navigasi program PPSDMAP" />

        <div class="dark-surface rounded-md bg-[#0B2545] p-6 text-[#F8F7F4] sm:p-10">
            <span class="horizon-rule" aria-hidden="true"></span>
            <h1 class="type-h1 mt-4 text-white">Kemenhub Corporate University (Corpu)</h1>
            <p class="mt-3 max-w-3xl text-base leading-relaxed text-[#EAF0F6]">
                Pendekatan pengembangan kompetensi SDM aparatur perhubungan yang menyelaraskan strategi organisasi Kementerian Perhubungan dengan jalur pembelajaran terstruktur melalui sekolah-sekolah tematik, pembelajaran di tempat kerja, dan LMS Corpu.
            </p>
            <div class="mt-6 flex flex-wrap gap-3">
                <a
                    href="{{ route('elearning') }}"
                    class="min-h-11 inline-flex items-center rounded-md bg-[#E5A91A] px-5 py-3 text-sm font-bold text-[#0B2545] hover:bg-[#D4990E]"
                >
                    Akses LMS Corpu
                </a>
                <a
                    href="{{ route('diklat.index') }}"
                    class="min-h-11 inline-flex items-center rounded-md border border-[#EAF0F6]/50 px-5 py-3 text-sm font-semibold text-white hover:bg-[#133C6D]"
                >
                    Telusuri Katalog Pelatihan
                </a>
            </div>
        </div>

        <section class="mt-10">
            <h2 class="type-h2 text-[#0B2545]">Pilar Pelaksanaan Pembelajaran</h2>
            <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-3">
                @foreach ($pillars as $index => $pillar)
                    <div class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6">
                        <span class="tabular-code inline-flex h-8 w-8 items-center justify-center rounded-sm bg-[#EAF0F6] text-xs font-bold text-[#0B2545]">
                            0{{ $index + 1 }}
                        </span>
                        <h3 class="type-h3 mt-4 text-[#0B2545]">{{ $pillar['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#4B5563]">{{ $pillar['detail'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        @if ($corpuPrograms->isNotEmpty())
            <section class="mt-12 border-t border-[#D6D3CB] pt-10">
                <h2 class="type-h2 text-[#0B2545]">Program Pelatihan Terkait</h2>
                <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-3">
                    @foreach ($corpuPrograms as $program)
                        <x-program-card :program="$program" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-layouts.app>
