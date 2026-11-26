@php
    $programNav = [
        ['label' => 'Corporate University', 'route' => 'program.corpu', 'active' => false],
        ['label' => 'Assessment Center', 'route' => 'program.assessment', 'active' => true],
        ['label' => 'Pelatihan', 'route' => 'diklat.index', 'active' => false],
        ['label' => 'Rintisan Gelar/Beasiswa', 'route' => 'program.rintisan-gelar', 'active' => false],
    ];
@endphp

<x-layouts.app
    title="Assessment Center - Program PPSDMAP Kemenhub"
    description="Layanan penilaian dan pemetaan kompetensi ASN sektor perhubungan melalui Assessment Center PPSDMAP."
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[['label' => 'Program', 'url' => route('diklat.index')], ['label' => 'Assessment Center']]" />
        <x-section-subnav :items="$programNav" label="Navigasi program PPSDMAP" />

        <div class="grid grid-cols-1 gap-10 lg:grid-cols-12 lg:items-start">
            <div class="lg:col-span-7">
                <span class="horizon-rule-ochre" aria-hidden="true"></span>
                <h1 class="type-h1 mt-4 text-[#0B2545]">Assessment Center SDM Aparatur Perhubungan</h1>
                <p class="mt-4 text-base leading-relaxed text-[#1B2430]">
                    Layanan penilaian kompetensi dan potensi pegawai untuk mendukung manajemen talenta, pengisian jabatan, serta pemetaan kebutuhan pengembangan SDM di lingkungan Kementerian Perhubungan.
                </p>

                <div class="mt-8 rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6">
                    <h2 class="type-h3 text-[#0B2545]">Ruang Lingkup Penilaian</h2>
                    <ul class="mt-4 list-disc space-y-2.5 pl-5 text-sm leading-relaxed text-[#1B2430]">
                        @foreach ($competencyFocus as $focus)
                            <li>{{ $focus }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-6">
                    <h2 class="type-h2 text-[#0B2545]">Alur Pelaksanaan Asesmen</h2>
                    <ol class="mt-4 space-y-3">
                        @foreach ($stages as $index => $stage)
                            <li class="flex items-start gap-3.5 rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-4">
                                <span class="tabular-code inline-flex h-7 w-7 shrink-0 items-center justify-center rounded-sm bg-[#0B2545] text-xs font-semibold text-white">
                                    0{{ $index + 1 }}
                                </span>
                                <span class="text-sm leading-relaxed text-[#1B2430]">{{ $stage }}</span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>

            <aside class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6 lg:col-span-5">
                <h2 class="type-h3 text-[#0B2545]">Koordinasi Pengusulan Asesmen</h2>
                <p class="mt-2 text-sm leading-relaxed text-[#4B5563]">
                    Unit kerja kepegawaian atau instansi mitra yang ingin menjadwalkan pemetaan kompetensi dapat menghubungi PPSDMAP melalui kanal resmi.
                </p>
                <div class="mt-5 flex flex-col gap-3">
                    <a
                        href="{{ route('kontak.index') }}"
                        class="min-h-11 inline-flex items-center justify-center rounded-md bg-[#0B2545] px-4 py-3 text-sm font-semibold text-white hover:bg-[#133C6D]"
                    >
                        Hubungi Tim Assessment Center
                    </a>
                    <a
                        href="{{ route('layanan.pengaduan') }}"
                        class="min-h-11 inline-flex items-center justify-center rounded-md border border-[#6E737D] px-4 py-3 text-sm font-semibold text-[#0B2545] hover:bg-[#EAF0F6]"
                    >
                        Isi Survei atau Masukan Layanan
                    </a>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.app>
