<x-layouts.app
    title="Layanan PPID dan Zona Integritas - PPSDMAP Kemenhub"
    description="Daftar informasi publik berkala, setiap saat, serta-merta, regulasi, maklumat Zona Integritas WBK/WBBM, dan formulir permohonan informasi PPID."
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[['label' => 'Layanan', 'url' => route('ppid.index')], ['label' => 'PPID']]" />
        <x-section-subnav :items="[
            ['label' => 'PPID', 'route' => 'ppid.index', 'active' => true],
            ['label' => 'Pengaduan dan Survei', 'route' => 'layanan.pengaduan', 'active' => false],
            ['label' => 'Penyewaan Aset', 'route' => 'layanan.aset', 'active' => false],
            ['label' => 'E-Learning / LMS Corpu', 'route' => 'elearning', 'active' => false],
        ]" label="Navigasi layanan PPSDMAP" />

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:items-end">
            <div class="lg:col-span-8">
                <span class="horizon-rule-ochre" aria-hidden="true"></span>
                <h1 class="type-h1 mt-4 text-[#0B2545]">Layanan PPID dan Zona Integritas (WBK/WBBM)</h1>
                <p class="mt-3 text-base leading-relaxed text-[#1B2430]">
                    Pejabat Pengelola Informasi dan Dokumentasi (PPID) PPSDMAP menyediakan akses dokumen informasi publik serta kanal pengajuan permohonan informasi secara transparan dan ramah disabilitas.
                </p>
            </div>
            <div class="lg:col-span-4 lg:text-right">
                <a
                    href="#permohonan-ppid"
                    class="min-h-11 inline-flex items-center justify-center rounded-md bg-[#0B2545] px-5 py-3 text-sm font-semibold text-white hover:bg-[#133C6D]"
                >
                    Ajukan Permohonan Informasi
                </a>
            </div>
        </div>

        <form method="GET" action="{{ route('ppid.index') }}" class="mt-8 rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-5 sm:p-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end">
                <div class="flex-1">
                    <label for="ppid-search" class="block text-sm font-semibold text-[#0B2545]">
                        Cari Judul atau Nomor Dokumen
                    </label>
                    <input
                        id="ppid-search"
                        name="q"
                        type="search"
                        value="{{ $searchQuery ?? '' }}"
                        placeholder="Contoh: Daftar Informasi Publik atau PPID-DUMMY"
                        class="mt-1.5 min-h-11 w-full rounded-md border border-[#6E737D] bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#1B2430]"
                    >
                </div>
                @if ($selectedCategory)
                    <input type="hidden" name="category" value="{{ $selectedCategory }}">
                @endif
                <button
                    type="submit"
                    class="min-h-11 inline-flex items-center justify-center rounded-md bg-[#0B2545] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#133C6D]"
                >
                    Saring Dokumen
                </button>
            </div>

            <div class="mt-5 flex flex-wrap gap-2">
                <a
                    href="{{ route('ppid.index', array_filter(['q' => $searchQuery])) }}"
                    class="min-h-11 inline-flex items-center rounded-md border px-3.5 py-2 text-xs font-semibold {{ empty($selectedCategory) ? 'border-[#0B2545] bg-[#0B2545] text-white' : 'border-[#6E737D] bg-[#FFFFFF] text-[#1B2430] hover:bg-[#EAF0F6]' }}"
                >
                    Semua Klasifikasi
                </a>
                @foreach ($categories as $key => $label)
                    <a
                        href="{{ route('ppid.index', array_filter(['category' => $key, 'q' => $searchQuery])) }}"
                        class="min-h-11 inline-flex items-center rounded-md border px-3.5 py-2 text-xs font-semibold {{ $selectedCategory === $key ? 'border-[#0B2545] bg-[#0B2545] text-white' : 'border-[#6E737D] bg-[#FFFFFF] text-[#1B2430] hover:bg-[#EAF0F6]' }}"
                    >
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </form>

        <section class="mt-8" aria-label="Daftar dokumen publik">
            @if ($documents->isEmpty())
                <x-state-empty
                    title="Dokumen tidak ditemukan"
                    description="Belum ada dokumen PPID atau regulasi yang sesuai dengan kata kunci Anda."
                    :resetUrl="route('ppid.index')"
                    resetLabel="Tampilkan Semua Dokumen"
                />
            @else
                {{-- Mobile stacked list to avoid horizontal table overflow (R-03) --}}
                <div class="space-y-4 md:hidden">
                    @foreach ($documents as $doc)
                        <div class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-5">
                            <div class="flex flex-wrap items-center justify-between gap-2 text-xs">
                                <span class="tabular-code font-semibold text-[#1E4E79]">{{ $doc->document_number }}</span>
                                <span class="tabular-code text-[#4B5563]">Tahun {{ $doc->year }}</span>
                            </div>
                            <h2 class="mt-2 text-base font-semibold text-[#0B2545]">{{ $doc->title }}</h2>
                            <p class="mt-1 text-xs font-medium text-[#1E4E79]">{{ $doc->categoryLabel() }}</p>
                            @if ($doc->description)
                                <p class="mt-2 text-sm text-[#4B5563]">{{ $doc->description }}</p>
                            @endif
                            @if ($doc->file_path)
                                <div class="mt-4">
                                    <a
                                        href="{{ asset(ltrim($doc->file_path, '/')) }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="min-h-11 inline-flex items-center justify-center rounded-md border border-[#6E737D] px-4 py-2 text-sm font-semibold text-[#0B2545] hover:bg-[#EAF0F6]"
                                    >
                                        Unduh Dokumen PDF
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Desktop structured table --}}
                <div class="hidden md:block overflow-x-auto rounded-md border border-[#D6D3CB] bg-[#FFFFFF]">
                    <table class="w-full border-collapse text-left text-sm">
                        <thead class="border-b border-[#D6D3CB] bg-[#F1EFEA] text-xs font-semibold uppercase tracking-wide text-[#0B2545]">
                            <tr>
                                <th scope="col" class="px-5 py-3.5">Nomor Dokumen</th>
                                <th scope="col" class="px-5 py-3.5">Judul dan Ringkasan</th>
                                <th scope="col" class="px-5 py-3.5">Klasifikasi</th>
                                <th scope="col" class="px-5 py-3.5">Tahun</th>
                                <th scope="col" class="px-5 py-3.5 text-right">Berkas</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#D6D3CB]">
                            @foreach ($documents as $doc)
                                <tr class="hover:bg-[#F8F7F4]">
                                    <td class="tabular-code whitespace-nowrap px-5 py-4 font-medium text-[#1E4E79]">
                                        {{ $doc->document_number ?? '-' }}
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="font-semibold text-[#0B2545]">{{ $doc->title }}</p>
                                        @if ($doc->description)
                                            <p class="mt-1 max-w-xl text-xs leading-relaxed text-[#4B5563]">{{ $doc->description }}</p>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4 text-xs font-medium text-[#1B2430]">
                                        {{ $doc->categoryLabel() }}
                                    </td>
                                    <td class="tabular-code whitespace-nowrap px-5 py-4 text-[#1B2430]">
                                        {{ $doc->year }}
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4 text-right">
                                        @if ($doc->file_path)
                                            <a
                                                href="{{ asset(ltrim($doc->file_path, '/')) }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="min-h-11 inline-flex items-center rounded-md border border-[#6E737D] px-3.5 py-2 text-xs font-semibold text-[#0B2545] hover:bg-[#EAF0F6]"
                                            >
                                                Unduh PDF
                                            </a>
                                        @elseif ($doc->external_url)
                                            <a
                                                href="{{ $doc->external_url }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="min-h-11 inline-flex items-center rounded-md border border-[#6E737D] px-3.5 py-2 text-xs font-semibold text-[#0B2545] hover:bg-[#EAF0F6]"
                                            >
                                                Buka Tautan
                                            </a>
                                        @else
                                            <span class="text-xs text-[#4B5563]">Belum dilampirkan</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        <section id="permohonan-ppid" class="mt-14 rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6 sm:p-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
                <div class="lg:col-span-4">
                    <span class="horizon-rule-ochre" aria-hidden="true"></span>
                    <h2 class="type-h2 mt-4 text-[#0B2545]">Formulir Permohonan Informasi Publik</h2>
                    <p class="mt-3 text-sm leading-relaxed text-[#4B5563]">
                        Apabila dokumen yang Anda butuhkan belum tersedia pada daftar di atas, ajukan permohonan resmi melalui formulir ini. Sistem akan menerbitkan nomor referensi untuk pelacakan tindak lanjut.
                    </p>
                </div>

                <div class="lg:col-span-8">
                    <x-inquiry-form
                        :action="route('ppid.store')"
                        formId="ppid-form"
                        successKey="ppid_success"
                        submitLabel="Ajukan Permohonan PPID"
                        subjectLabel="Jenis / Judul Informasi yang Dimohon"
                        subjectPlaceholder="Contoh: Salinan kalender penyelenggaraan diklat tahun berjalan"
                        messageLabel="Tujuan Penggunaan dan Rincian Informasi"
                        messagePlaceholder="Jelaskan informasi yang dibutuhkan serta bentuk salinan yang diharapkan (softcopy/dokumen digital)..."
                    />
                </div>
            </div>
        </section>
    </div>
</x-layouts.app>
