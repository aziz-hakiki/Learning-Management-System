@php
    $programNav = [
        ['label' => 'Corporate University', 'route' => 'program.corpu', 'active' => false],
        ['label' => 'Assessment Center', 'route' => 'program.assessment', 'active' => false],
        ['label' => 'Pelatihan', 'route' => 'diklat.index', 'active' => false],
        ['label' => 'Rintisan Gelar/Beasiswa', 'route' => 'program.rintisan-gelar', 'active' => true],
    ];
@endphp

<x-layouts.app
    title="Rintisan Gelar dan Beasiswa - Program PPSDMAP Kemenhub"
    description="Informasi program persiapan tugas belajar, rintisan gelar pascasarjana, dan beasiswa pengembangan SDM aparatur perhubungan."
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[['label' => 'Program', 'url' => route('diklat.index')], ['label' => 'Rintisan Gelar/Beasiswa']]" />
        <x-section-subnav :items="$programNav" label="Navigasi program PPSDMAP" />

        <div class="max-w-3xl">
            <span class="horizon-rule-ochre" aria-hidden="true"></span>
            <h1 class="type-h1 mt-4 text-[#0B2545]">Program Rintisan Gelar dan Beasiswa</h1>
            <p class="mt-3 text-base leading-relaxed text-[#1B2430]">
                Fasilitasi peningkatan kualifikasi akademik dan pembekalan persiapan tugas belajar pascasarjana bagi aparatur berprestasi di lingkungan Kementerian Perhubungan.
            </p>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-3">
            @foreach ($tracks as $track)
                <article class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6">
                    <h2 class="type-h3 text-[#0B2545]">{{ $track['title'] }}</h2>
                    <p class="mt-2.5 text-sm leading-relaxed text-[#4B5563]">{{ $track['detail'] }}</p>
                </article>
            @endforeach
        </div>

        <section class="mt-12 border-t border-[#D6D3CB] pt-10">
            <h2 class="type-h2 text-[#0B2545]">Daftar Program Fungsional &amp; Rintisan Gelar</h2>
            @if ($programs->isEmpty())
                <div class="mt-6">
                    <x-state-empty
                        title="Belum ada jadwal rintisan gelar aktif"
                        description="Informasi pembukaan seleksi baru akan diterbitkan melalui menu Publikasi -> Berita dan Pengumuman."
                        :resetUrl="route('informasi.index', ['type' => 'pengumuman'])"
                        resetLabel="Pantau Pengumuman Terbaru"
                    />
                </div>
            @else
                <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($programs as $program)
                        <x-program-card :program="$program" />
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</x-layouts.app>
