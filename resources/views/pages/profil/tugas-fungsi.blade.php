@php
    $profilNav = [
        ['label' => 'Sejarah', 'route' => 'profil.sejarah', 'active' => false],
        ['label' => 'Tugas dan Fungsi', 'route' => 'profil.tugas-fungsi', 'active' => true],
        ['label' => 'Struktur Organisasi', 'route' => 'profil.struktur', 'active' => false],
        ['label' => 'Fasilitas', 'route' => 'profil.fasilitas', 'active' => false],
    ];
@endphp

<x-layouts.app
    title="Tugas dan Fungsi - Profil PPSDMAP BPSDMP Kemenhub"
    description="Tugas pokok dan fungsi penyelenggaraan pendidikan, pelatihan, dan pembinaan kompetensi SDM aparatur perhubungan pada PPSDMAP."
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[['label' => 'Profil', 'url' => route('profil.tugas-fungsi')], ['label' => 'Tugas dan Fungsi']]" />
        <x-section-subnav :items="$profilNav" label="Navigasi profil instansi" />

        <div class="grid grid-cols-1 gap-10 lg:grid-cols-12 lg:items-start">
            <div class="lg:col-span-7">
                <span class="horizon-rule-ochre" aria-hidden="true"></span>
                <h1 class="type-h1 mt-4 text-[#0B2545]">Tugas dan Fungsi PPSDMAP</h1>
                <p class="mt-4 text-base leading-relaxed text-[#1B2430]">
                    Sebagai unit kerja eselon II di bawah Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP) Kementerian Perhubungan, PPSDMAP menjalankan mandat pengembangan kompetensi manajerial, struktural, fungsional, teknis, dan karakter aparatur.
                </p>

                <div class="mt-8 rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6">
                    <h2 class="type-h3 text-[#0B2545]">Tugas Pokok</h2>
                    <p class="mt-2 text-sm leading-relaxed text-[#1B2430] sm:text-base">
                        Melaksanakan penyusunan kebijakan teknis, pelaksanaan, pemantauan, evaluasi, dan pelaporan di bidang pendidikan dan pelatihan manajerial, struktural, dan fungsional bagi sumber daya manusia aparatur perhubungan, serta pembinaan teknis diklat pembangunan karakter.
                    </p>
                </div>

                <div class="mt-6">
                    <h2 class="type-h2 text-[#0B2545]">Fungsi Penyelenggaraan</h2>
                    <ol class="mt-4 space-y-3">
                        @foreach ($functions as $index => $function)
                            <li class="flex items-start gap-3.5 rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-4">
                                <span class="tabular-code inline-flex h-7 w-7 shrink-0 items-center justify-center rounded-sm bg-[#0B2545] text-xs font-semibold text-white">
                                    0{{ $index + 1 }}
                                </span>
                                <span class="text-sm leading-relaxed text-[#1B2430]">{{ $function }}</span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>

            <aside class="space-y-6 lg:col-span-5">
                <div class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6">
                    <h2 class="type-h3 text-[#0B2545]">Kedudukan Kampus</h2>
                    <p class="mt-2 text-sm leading-relaxed text-[#4B5563]">
                        Jl. Raya Parung - Bogor KM. 26,4, Kabupaten Bogor, Jawa Barat 16310.
                    </p>
                    <div class="mt-5 flex flex-wrap gap-3">
                        <a
                            href="{{ route('diklat.index') }}"
                            class="min-h-11 inline-flex items-center rounded-md bg-[#0B2545] px-4 py-2.5 text-sm font-semibold text-white hover:bg-[#133C6D]"
                        >
                            Lihat Katalog Pelatihan
                        </a>
                        <a
                            href="{{ route('profil.struktur') }}"
                            class="min-h-11 inline-flex items-center rounded-md border border-[#6E737D] px-4 py-2.5 text-sm font-semibold text-[#0B2545] hover:bg-[#EAF0F6]"
                        >
                            Lihat Struktur Organisasi
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.app>
