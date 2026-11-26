@php
    $layananNav = [
        ['label' => 'PPID', 'route' => 'ppid.index', 'active' => false],
        ['label' => 'Pengaduan dan Survei', 'route' => 'layanan.pengaduan', 'active' => false],
        ['label' => 'Penyewaan Aset', 'route' => 'layanan.aset', 'active' => true],
        ['label' => 'E-Learning / LMS Corpu', 'route' => 'elearning', 'active' => false],
    ];
@endphp

<x-layouts.app
    title="Penyewaan Aset - Layanan PPSDMAP Kemenhub"
    description="Informasi pemanfaatan dan penyewaan aset fasilitas kampus PPSDMAP di Parung, Bogor beserta formulir permohonan penggunaan."
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[['label' => 'Layanan', 'url' => route('ppid.index')], ['label' => 'Penyewaan Aset']]" />
        <x-section-subnav :items="$layananNav" label="Navigasi layanan PPSDMAP" />

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:items-center">
            <div class="lg:col-span-7">
                <span class="horizon-rule-ochre" aria-hidden="true"></span>
                <h1 class="type-h1 mt-4 text-[#0B2545]">Layanan Pemanfaatan dan Penyewaan Aset</h1>
                <p class="mt-3 text-base leading-relaxed text-[#1B2430]">
                    Satuan kerja Kementerian Perhubungan maupun instansi mitra dapat mengajukan pemanfaatan sarana gedung, ruang kelas, auditorium, dan asrama di Kampus PPSDMAP Parung di luar jadwal penggunaan diklat internal, sesuai ketentuan pengelolaan Penerimaan Negara Bukan Pajak (PNBP).
                </p>
            </div>
            <div class="lg:col-span-5">
                <figure class="overflow-hidden rounded-md border border-[#D6D3CB] bg-[#FFFFFF]">
                    <img
                        src="{{ asset('images/dummy/kampus-fasilitas-dummy.svg') }}"
                        alt="Ilustrasi dummy aset gedung dan fasilitas Kampus PPSDMAP Parung"
                        width="960"
                        height="720"
                        class="h-auto w-full object-cover aspect-[4/3]"
                    >
                </figure>
            </div>
        </div>

        <section class="mt-10" aria-label="Daftar aset yang dapat dimanfaatkan">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="type-h2 text-[#0B2545]">Daftar Aset dan Sarana Kampus</h2>
                <x-status-badge status="dummy" label="Data Tarif & Kapasitas Menunggu SK Resmi" />
            </div>

            {{-- Mobile card layout --}}
            <div class="mt-5 space-y-4 md:hidden">
                @foreach ($assets as $asset)
                    <article class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-5">
                        <div class="flex items-center justify-between gap-2">
                            <span class="tabular-code text-xs font-semibold text-[#1E4E79]">{{ $asset['code'] }}</span>
                            <x-status-badge :status="$asset['status'] === 'tersedia' ? 'dibuka' : 'terjadwal'" :label="ucfirst($asset['status'])" />
                        </div>
                        <h3 class="mt-2 text-base font-semibold text-[#0B2545]">{{ $asset['name'] }}</h3>
                        <p class="mt-1 text-sm text-[#4B5563]">{{ $asset['usage'] }}</p>
                        <p class="mt-2 text-xs font-medium text-[#8A5A00]">{{ $asset['capacity'] }}</p>
                    </article>
                @endforeach
            </div>

            {{-- Desktop table layout --}}
            <div class="mt-5 hidden md:block overflow-x-auto rounded-md border border-[#D6D3CB] bg-[#FFFFFF]">
                <table class="w-full border-collapse text-left text-sm">
                    <thead class="border-b border-[#D6D3CB] bg-[#F1EFEA] text-xs font-semibold uppercase tracking-wide text-[#0B2545]">
                        <tr>
                            <th scope="col" class="px-5 py-3.5">Kode Aset</th>
                            <th scope="col" class="px-5 py-3.5">Nama Fasilitas</th>
                            <th scope="col" class="px-5 py-3.5">Peruntukan</th>
                            <th scope="col" class="px-5 py-3.5">Kapasitas &amp; Tarif PNBP</th>
                            <th scope="col" class="px-5 py-3.5">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#D6D3CB]">
                        @foreach ($assets as $asset)
                            <tr class="hover:bg-[#F8F7F4]">
                                <td class="tabular-code whitespace-nowrap px-5 py-4 font-semibold text-[#1E4E79]">{{ $asset['code'] }}</td>
                                <td class="px-5 py-4 font-semibold text-[#0B2545]">{{ $asset['name'] }}</td>
                                <td class="px-5 py-4 text-[#4B5563]">{{ $asset['usage'] }}</td>
                                <td class="px-5 py-4 text-xs font-medium text-[#8A5A00]">{{ $asset['capacity'] }}</td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    <x-status-badge :status="$asset['status'] === 'tersedia' ? 'dibuka' : 'terjadwal'" :label="ucfirst($asset['status'])" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section id="permohonan-aset" class="mt-12 rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6 sm:p-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
                <div class="lg:col-span-4">
                    <span class="horizon-rule-ochre" aria-hidden="true"></span>
                    <h2 class="type-h2 mt-4 text-[#0B2545]">Ajukan Permintaan Ketersediaan Aset</h2>
                    <p class="mt-3 text-sm leading-relaxed text-[#4B5563]">
                        Isi formulir ini untuk mengecek ketersediaan jadwal gedung/asrama dan memperoleh informasi prosedur administrasi serta tarif PNBP resmi.
                    </p>
                </div>

                <div class="lg:col-span-8">
                    <x-inquiry-form
                        :action="route('layanan.aset.store')"
                        formId="asset-inquiry-form"
                        successKey="asset_success"
                        submitLabel="Kirim Permintaan Informasi Aset"
                        subjectLabel="Fasilitas yang Diajukan & Perkiraan Tanggal"
                        subjectPlaceholder="Contoh: Permintaan ketersediaan Auditorium Utama untuk tanggal kegiatan"
                        messageLabel="Kebutuhan Kegiatan, Jumlah Peserta, dan Durasi"
                        messagePlaceholder="Jelaskan nama kegiatan, perkiraan jumlah peserta, serta fasilitas pendukung yang dibutuhkan..."
                    />
                </div>
            </div>
        </section>
    </div>
</x-layouts.app>
