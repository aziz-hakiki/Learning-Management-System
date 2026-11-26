@php
    $profilNav = [
        ['label' => 'Sejarah', 'route' => 'profil.sejarah', 'active' => false],
        ['label' => 'Tugas dan Fungsi', 'route' => 'profil.tugas-fungsi', 'active' => false],
        ['label' => 'Struktur Organisasi', 'route' => 'profil.struktur', 'active' => false],
        ['label' => 'Fasilitas', 'route' => 'profil.fasilitas', 'active' => true],
    ];
@endphp

<x-layouts.app
    title="Fasilitas Kampus - Profil PPSDMAP Kemenhub"
    description="Sarana ruang kelas, auditorium, asrama peserta, dan fasilitas pembelajaran di Kampus PPSDMAP Parung, Bogor."
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[['label' => 'Profil', 'url' => route('profil.tugas-fungsi')], ['label' => 'Fasilitas']]" />
        <x-section-subnav :items="$profilNav" label="Navigasi profil instansi" />

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:items-center">
            <div class="lg:col-span-6">
                <span class="horizon-rule-ochre" aria-hidden="true"></span>
                <h1 class="type-h1 mt-4 text-[#0B2545]">Fasilitas Kampus PPSDMAP Parung</h1>
                <p class="mt-3 text-base leading-relaxed text-[#1B2430]">
                    Kawasan kampus di Jl. Raya Parung - Bogor KM. 26,4 dilengkapi sarana kelas, auditorium, asrama, dan ruang asesmen untuk mendukung penyelenggaraan diklat klasikal maupun blended learning.
                </p>
                <div class="mt-6">
                    <a
                        href="{{ route('layanan.aset') }}"
                        class="min-h-11 inline-flex items-center rounded-md bg-[#0B2545] px-5 py-3 text-sm font-semibold text-white hover:bg-[#133C6D]"
                    >
                        Informasi Penyewaan Aset dan Fasilitas
                    </a>
                </div>
            </div>

            <div class="lg:col-span-6">
                <figure class="overflow-hidden rounded-md border border-[#D6D3CB] bg-[#FFFFFF]">
                    <img
                        src="{{ asset('images/dummy/kampus-fasilitas-dummy.svg') }}"
                        alt="Ilustrasi dummy fasilitas gedung pembelajaran dan asrama PPSDMAP Parung"
                        width="960"
                        height="720"
                        class="h-auto w-full object-cover aspect-[4/3]"
                    >
                    <figcaption class="border-t border-[#D6D3CB] p-4 text-xs text-[#4B5563]">
                        Ilustrasi prototipe [Asset Dummy]. Foto aktual sarana pembelajaran akan menggantikan gambar ini pada tahap finalisasi konten.
                    </figcaption>
                </figure>
            </div>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-2">
            @foreach ($facilities as $facility)
                <article class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6">
                    <h2 class="type-h3 text-[#0B2545]">{{ $facility['name'] }}</h2>
                    <p class="mt-1.5 text-xs font-semibold text-[#8A5A00]">{{ $facility['capacity'] }}</p>
                    <p class="mt-3 text-sm leading-relaxed text-[#4B5563]">{{ $facility['description'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</x-layouts.app>
