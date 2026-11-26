@php
    $profilNav = [
        ['label' => 'Sejarah', 'route' => 'profil.sejarah', 'active' => false],
        ['label' => 'Tugas dan Fungsi', 'route' => 'profil.tugas-fungsi', 'active' => false],
        ['label' => 'Struktur Organisasi', 'route' => 'profil.struktur', 'active' => true],
        ['label' => 'Fasilitas', 'route' => 'profil.fasilitas', 'active' => false],
    ];
@endphp

<x-layouts.app
    title="Struktur Organisasi - Profil PPSDMAP Kemenhub"
    description="Susunan organisasi dan unit pelaksana tugas Pusat Pengembangan SDM Aparatur Perhubungan."
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[['label' => 'Profil', 'url' => route('profil.tugas-fungsi')], ['label' => 'Struktur Organisasi']]" />
        <x-section-subnav :items="$profilNav" label="Navigasi profil instansi" />

        <div class="max-w-3xl">
            <span class="horizon-rule-ochre" aria-hidden="true"></span>
            <h1 class="type-h1 mt-4 text-[#0B2545]">Struktur Organisasi PPSDMAP</h1>
            <p class="mt-3 text-base leading-relaxed text-[#4B5563]">
                Susunan unit kerja mengacu pada Organisasi dan Tata Kerja BPSDMP Kementerian Perhubungan. Data nama pejabat aktif diisi setelah konfirmasi resmi instansi.
            </p>
        </div>

        <div class="mt-8 space-y-6">
            @foreach ($organizationUnits as $index => $unit)
                <article class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6 {{ $index === 0 ? 'border-l-4 border-l-[#0B2545]' : '' }}">
                    <p class="text-xs font-semibold uppercase tracking-wide text-[#1E4E79]">{{ $unit['level'] }}</p>
                    <h2 class="type-h3 mt-1.5 text-[#0B2545]">{{ $unit['unit'] }}</h2>
                    <p class="mt-1 text-xs font-semibold text-[#8A5A00]">{{ $unit['holder'] }}</p>
                    <p class="mt-3 max-w-3xl text-sm leading-relaxed text-[#4B5563]">{{ $unit['mandate'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</x-layouts.app>
