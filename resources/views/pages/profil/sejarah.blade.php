@php
    $profilNav = [
        ['label' => 'Sejarah', 'route' => 'profil.sejarah', 'active' => true],
        ['label' => 'Tugas dan Fungsi', 'route' => 'profil.tugas-fungsi', 'active' => false],
        ['label' => 'Struktur Organisasi', 'route' => 'profil.struktur', 'active' => false],
        ['label' => 'Fasilitas', 'route' => 'profil.fasilitas', 'active' => false],
    ];
@endphp

<x-layouts.app
    title="Sejarah - Profil PPSDMAP BPSDMP Kemenhub"
    description="Sejarah dan perkembangan Pusat Pengembangan Sumber Daya Manusia Aparatur Perhubungan (PPSDMAP) di lingkungan Kementerian Perhubungan."
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[['label' => 'Profil', 'url' => route('profil.tugas-fungsi')], ['label' => 'Sejarah']]" />
        <x-section-subnav :items="$profilNav" label="Navigasi profil instansi" />

        <div class="grid grid-cols-1 gap-10 lg:grid-cols-12 lg:items-start">
            <div class="lg:col-span-7">
                <span class="horizon-rule-ochre" aria-hidden="true"></span>
                <h1 class="type-h1 mt-4 text-[#0B2545]">Sejarah PPSDMAP Kemenhub</h1>
                <p class="mt-4 text-base leading-relaxed text-[#1B2430]">
                    Pusat Pengembangan Sumber Daya Manusia Aparatur Perhubungan (PPSDMAP) berkembang seiring kebutuhan pembinaan kompetensi aparatur negara di sektor transportasi nasional di bawah Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP).
                </p>

                <div class="mt-8 space-y-5">
                    @foreach ($milestones as $index => $item)
                        <article class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <span class="tabular-code text-xs font-semibold text-[#8A5A00]">{{ $item['period'] }}</span>
                                <span class="tabular-code text-xs font-medium text-[#1E4E79]">0{{ $index + 1 }}</span>
                            </div>
                            <h2 class="type-h3 mt-2 text-[#0B2545]">{{ $item['title'] }}</h2>
                            <p class="mt-2 text-sm leading-relaxed text-[#4B5563]">{{ $item['detail'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>

            <aside class="space-y-6 lg:col-span-5">
                <figure class="overflow-hidden rounded-md border border-[#D6D3CB] bg-[#FFFFFF]">
                    <img
                        src="{{ asset('images/dummy/hero-kampus-dummy.svg') }}"
                        alt="Ilustrasi dummy gedung utama kampus PPSDMAP di Parung, Bogor"
                        width="1280"
                        height="720"
                        class="h-auto w-full object-cover aspect-video"
                    >
                    <figcaption class="border-t border-[#D6D3CB] p-4 text-xs leading-relaxed text-[#4B5563]">
                        Catatan Kejujuran Konten: Lini masa sejarah rinci beserta nomor peraturan pendirian resmi dapat dimasukkan melalui pembaruan arsip instansi [Data Sejarah Contoh].
                    </figcaption>
                </figure>
            </aside>
        </div>
    </div>
</x-layouts.app>
