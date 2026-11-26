@props([
    'title' => 'PPSDMAP BPSDMP Kementerian Perhubungan',
    'description' => 'Portal informasi publik, katalog program pelatihan, layanan PPID, dan gerbang E-Learning Pusat Pengembangan Sumber Daya Manusia Aparatur Perhubungan.',
])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8F7F4] text-[#1B2430] antialiased flex min-h-dvh flex-col">
    <a href="#main-content" class="skip-link">Langsung ke konten utama</a>

    @php
        $menuGroups = [
            [
                'id' => 'profil',
                'label' => 'Profil',
                'active' => request()->routeIs('profil.*'),
                'items' => [
                    ['label' => 'Sejarah', 'route' => 'profil.sejarah', 'active' => request()->routeIs('profil.sejarah')],
                    ['label' => 'Tugas dan Fungsi', 'route' => 'profil.tugas-fungsi', 'active' => request()->routeIs('profil.tugas-fungsi')],
                    ['label' => 'Struktur Organisasi', 'route' => 'profil.struktur', 'active' => request()->routeIs('profil.struktur')],
                    ['label' => 'Fasilitas', 'route' => 'profil.fasilitas', 'active' => request()->routeIs('profil.fasilitas')],
                ],
            ],
            [
                'id' => 'program',
                'label' => 'Program',
                'active' => request()->routeIs('program.*', 'diklat.*'),
                'items' => [
                    ['label' => 'Corporate University', 'route' => 'program.corpu', 'active' => request()->routeIs('program.corpu')],
                    ['label' => 'Assessment Center', 'route' => 'program.assessment', 'active' => request()->routeIs('program.assessment')],
                    ['label' => 'Pelatihan', 'route' => 'diklat.index', 'active' => request()->routeIs('diklat.*')],
                    ['label' => 'Rintisan Gelar/Beasiswa', 'route' => 'program.rintisan-gelar', 'active' => request()->routeIs('program.rintisan-gelar')],
                ],
            ],
            [
                'id' => 'publikasi',
                'label' => 'Publikasi',
                'active' => request()->routeIs('informasi.*', 'publikasi.*'),
                'items' => [
                    ['label' => 'Berita', 'route' => 'informasi.index', 'active' => request()->routeIs('informasi.*')],
                    ['label' => 'E-Buletin', 'route' => 'publikasi.buletin', 'active' => request()->routeIs('publikasi.buletin')],
                ],
            ],
            [
                'id' => 'layanan',
                'label' => 'Layanan',
                'active' => request()->routeIs('ppid.*', 'layanan.*', 'elearning'),
                'items' => [
                    ['label' => 'PPID', 'route' => 'ppid.index', 'active' => request()->routeIs('ppid.*')],
                    ['label' => 'Pengaduan dan Survei', 'route' => 'layanan.pengaduan', 'active' => request()->routeIs('layanan.pengaduan*')],
                    ['label' => 'Penyewaan Aset', 'route' => 'layanan.aset', 'active' => request()->routeIs('layanan.aset*')],
                    ['label' => 'E-Learning / LMS Corpu', 'route' => 'elearning', 'active' => request()->routeIs('elearning')],
                ],
            ],
        ];
    @endphp

    <header class="relative z-40 border-b border-[#D6D3CB] bg-[#FFFFFF]">
        <div class="mx-auto flex max-w-[1240px] items-center justify-between gap-4 px-4 py-3 sm:px-6">
            <a href="{{ route('home') }}" aria-label="Beranda PPSDMAP Kemenhub" class="min-h-11 inline-flex items-center rounded-md py-1 pr-2">
                <x-brand-logo />
            </a>

            <nav aria-label="Navigasi utama" class="hidden lg:flex lg:items-center lg:gap-1">
                @foreach ($menuGroups as $group)
                    <div class="relative" data-dropdown-root>
                        <button
                            type="button"
                            data-dropdown-toggle
                            aria-expanded="false"
                            aria-controls="desktop-menu-{{ $group['id'] }}"
                            class="min-h-11 inline-flex items-center gap-1.5 px-3.5 py-2 text-sm transition-colors rounded-md {{ $group['active'] ? 'font-semibold text-[#0B2545] border-b-2 border-[#8A5A00] rounded-b-none' : 'font-medium text-[#1B2430] hover:text-[#0B2545] hover:bg-[#EAF0F6]' }}"
                        >
                            <span>{{ $group['label'] }}</span>
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 8l4 4 4-4"/>
                            </svg>
                        </button>

                        <div
                            id="desktop-menu-{{ $group['id'] }}"
                            data-dropdown-panel
                            hidden
                            class="absolute left-0 top-full z-50 mt-1.5 w-64 rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-2 shadow-lg"
                        >
                            <ul class="space-y-1">
                                @foreach ($group['items'] as $sub)
                                    <li>
                                        <a
                                            href="{{ route($sub['route']) }}"
                                            @if ($sub['active']) aria-current="page" @endif
                                            class="min-h-11 flex items-center rounded-md px-3 py-2 text-sm transition-colors {{ $sub['active'] ? 'bg-[#EAF0F6] font-semibold text-[#0B2545] border-l-4 border-[#8A5A00]' : 'font-medium text-[#1B2430] hover:bg-[#F1EFEA] hover:text-[#0B2545]' }}"
                                        >
                                            {{ $sub['label'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </nav>

            <div class="hidden lg:flex lg:items-center lg:gap-3">
                <a
                    href="{{ route('kontak.index') }}"
                    @if (request()->routeIs('kontak.*')) aria-current="page" @endif
                    class="min-h-11 inline-flex items-center justify-center rounded-md px-5 py-2.5 text-sm font-semibold transition-colors {{ request()->routeIs('kontak.*') ? 'bg-[#E5A91A] text-[#0B2545] hover:bg-[#D4990E]' : 'bg-[#0B2545] text-white hover:bg-[#133C6D]' }}"
                >
                    Kontak
                </a>
            </div>

            <button
                type="button"
                data-nav-toggle
                aria-expanded="false"
                aria-controls="mobile-nav-drawer"
                aria-label="Buka menu navigasi"
                class="lg:hidden min-h-11 min-w-11 inline-flex items-center gap-2 rounded-md border border-[#6E737D] bg-[#FFFFFF] px-3.5 py-2 text-sm font-semibold text-[#0B2545] hover:bg-[#EAF0F6]"
            >
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="square" d="M4 7h16M4 12h16M4 17h16"/>
                </svg>
                <span>Menu</span>
            </button>
        </div>
    </header>

    <div
        id="mobile-nav-drawer"
        data-nav-drawer
        role="dialog"
        aria-modal="true"
        aria-label="Menu navigasi portal PPSDMAP"
        hidden
        class="fixed inset-0 z-50 lg:hidden"
    >
        <div data-nav-close class="fixed inset-0 bg-[#0B2545]/60"></div>
        <div class="relative ml-auto flex h-full w-full max-w-sm flex-col justify-between bg-[#FFFFFF] p-6 shadow-xl overflow-y-auto">
            <div>
                <div class="flex items-center justify-between border-b border-[#D6D3CB] pb-4">
                    <span class="font-display text-lg font-bold text-[#0B2545]">Menu Portal</span>
                    <button
                        type="button"
                        data-nav-close
                        aria-label="Tutup menu navigasi"
                        class="min-h-11 min-w-11 inline-flex items-center justify-center rounded-md border border-[#6E737D] px-3 text-sm font-semibold text-[#0B2545] hover:bg-[#EAF0F6]"
                    >
                        Tutup
                    </button>
                </div>

                <nav aria-label="Navigasi seluler" class="mt-4 space-y-2">
                    @foreach ($menuGroups as $group)
                        <details class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF]" @if ($group['active'] || $loop->first) open @endif>
                            <summary class="flex min-h-11 items-center justify-between px-3.5 py-2.5 text-sm font-bold text-[#0B2545] hover:bg-[#F8F7F4]">
                                <span>{{ $group['label'] }}</span>
                                <span aria-hidden="true" class="text-xs font-medium text-[#4B5563]">Sub-menu</span>
                            </summary>
                            <ul class="border-t border-[#D6D3CB] bg-[#F8F7F4] p-2 space-y-1">
                                @foreach ($group['items'] as $sub)
                                    <li>
                                        <a
                                            href="{{ route($sub['route']) }}"
                                            @if ($sub['active']) aria-current="page" @endif
                                            class="min-h-11 flex items-center rounded-md px-3 py-2 text-sm {{ $sub['active'] ? 'bg-[#EAF0F6] font-semibold text-[#0B2545] border-l-4 border-[#8A5A00]' : 'font-medium text-[#1B2430] hover:bg-[#FFFFFF]' }}"
                                        >
                                            {{ $sub['label'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </details>
                    @endforeach

                    <div class="pt-3">
                        <a
                            href="{{ route('kontak.index') }}"
                            @if (request()->routeIs('kontak.*')) aria-current="page" @endif
                            class="min-h-11 w-full inline-flex items-center justify-center rounded-md bg-[#0B2545] px-4 py-3 text-sm font-semibold text-white hover:bg-[#133C6D]"
                        >
                            Kontak
                        </a>
                    </div>
                </nav>
            </div>

            <div class="mt-8 border-t border-[#D6D3CB] pt-4 text-sm text-[#4B5563]">
                <p class="font-semibold text-[#0B2545]">Helpdesk Kediklatan</p>
                <p class="mt-1">Email: ppsdmap@kemenhub.go.id</p>
                <p>Layanan Peserta: 0811 1175 430</p>
            </div>
        </div>
    </div>

    <main id="main-content" tabindex="-1" class="flex-1">
        {{ $slot }}
    </main>

    <footer class="dark-surface border-t-4 border-[#E5A91A] bg-[#0B2545] text-[#F8F7F4]">
        <div class="mx-auto max-w-[1240px] px-4 py-12 sm:px-6 lg:py-16">
            <div class="grid grid-cols-1 gap-10 md:grid-cols-12">
                <div class="md:col-span-12 lg:col-span-5">
                    <x-brand-logo variant="dark" />
                    <p class="mt-4 max-w-md text-sm leading-relaxed text-[#EAF0F6]">
                        Pusat Pengembangan Sumber Daya Manusia Aparatur Perhubungan (PPSDMAP) menyelenggarakan pendidikan dan pelatihan manajerial, struktural, fungsional, teknis transportasi, assessment center, serta pembinaan karakter bagi SDM aparatur Kementerian Perhubungan.
                    </p>
                    <address class="mt-5 not-italic text-sm leading-relaxed text-[#EAF0F6]">
                        <strong class="block font-semibold text-white">Kampus dan Kantor Pusat</strong>
                        Jl. Raya Parung - Bogor KM. 26,4, Kabupaten Bogor, Jawa Barat 16310
                    </address>
                </div>

                <div class="md:col-span-6 lg:col-span-4">
                    <h2 class="text-sm font-semibold uppercase tracking-wide text-[#E5A91A]">Navigasi Portal</h2>
                    <ul class="mt-4 grid grid-cols-1 gap-x-4 gap-y-1 text-sm sm:grid-cols-2">
                        <li><a href="{{ route('profil.sejarah') }}" class="inline-flex min-h-11 items-center py-1 text-[#EAF0F6] hover:text-white hover:underline">Sejarah</a></li>
                        <li><a href="{{ route('profil.tugas-fungsi') }}" class="inline-flex min-h-11 items-center py-1 text-[#EAF0F6] hover:text-white hover:underline">Tugas dan Fungsi</a></li>
                        <li><a href="{{ route('program.corpu') }}" class="inline-flex min-h-11 items-center py-1 text-[#EAF0F6] hover:text-white hover:underline">Corporate University</a></li>
                        <li><a href="{{ route('program.assessment') }}" class="inline-flex min-h-11 items-center py-1 text-[#EAF0F6] hover:text-white hover:underline">Assessment Center</a></li>
                        <li><a href="{{ route('diklat.index') }}" class="inline-flex min-h-11 items-center py-1 text-[#EAF0F6] hover:text-white hover:underline">Pelatihan</a></li>
                        <li><a href="{{ route('program.rintisan-gelar') }}" class="inline-flex min-h-11 items-center py-1 text-[#EAF0F6] hover:text-white hover:underline">Rintisan Gelar</a></li>
                        <li><a href="{{ route('informasi.index') }}" class="inline-flex min-h-11 items-center py-1 text-[#EAF0F6] hover:text-white hover:underline">Berita</a></li>
                        <li><a href="{{ route('publikasi.buletin') }}" class="inline-flex min-h-11 items-center py-1 text-[#EAF0F6] hover:text-white hover:underline">E-Buletin</a></li>
                        <li><a href="{{ route('ppid.index') }}" class="inline-flex min-h-11 items-center py-1 text-[#EAF0F6] hover:text-white hover:underline">Layanan PPID</a></li>
                        <li><a href="{{ route('layanan.pengaduan') }}" class="inline-flex min-h-11 items-center py-1 text-[#EAF0F6] hover:text-white hover:underline">Pengaduan &amp; Survei</a></li>
                        <li><a href="{{ route('layanan.aset') }}" class="inline-flex min-h-11 items-center py-1 text-[#EAF0F6] hover:text-white hover:underline">Penyewaan Aset</a></li>
                        <li><a href="{{ route('kontak.index') }}" class="inline-flex min-h-11 items-center py-1 text-[#EAF0F6] hover:text-white hover:underline">Kontak &amp; Helpdesk</a></li>
                    </ul>
                </div>

                <div class="md:col-span-6 lg:col-span-3">
                    <h2 class="text-sm font-semibold uppercase tracking-wide text-[#E5A91A]">Kanal Resmi</h2>
                    <ul class="mt-4 space-y-2.5 text-sm text-[#EAF0F6]">
                        <li>
                            <span class="block text-xs text-[#D6D3CB]">Email Resmi</span>
                            <a href="mailto:ppsdmap@kemenhub.go.id" class="inline-flex min-h-11 items-center font-medium text-white hover:underline">ppsdmap@kemenhub.go.id</a>
                        </li>
                        <li>
                            <span class="block text-xs text-[#D6D3CB]">Helpdesk LMS / Diklat</span>
                            <span class="tabular-code block font-medium text-white">0811 1175 430</span>
                        </li>
                        <li>
                            <span class="block text-xs text-[#D6D3CB]">Telepon Kantor</span>
                            <span class="tabular-code block font-medium text-white">(0251) 7540092</span>
                        </li>
                        <li class="pt-1">
                            <a
                                href="https://ppsdmap.bpsdm.kemenhub.go.id/"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="min-h-11 inline-flex items-center gap-2 rounded-md border border-[#E5A91A] px-3.5 py-2 text-sm font-semibold text-[#E5A91A] hover:bg-[#E5A91A] hover:text-[#0B2545]"
                            >
                                <span>Portal LMS Corpu</span>
                                <span aria-hidden="true">&#8599;</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-10 flex flex-col gap-3 border-t border-[#1E4E79] pt-6 text-xs text-[#EAF0F6] sm:flex-row sm:items-center sm:justify-between">
                <p>Pusat Pengembangan SDM Aparatur Perhubungan, BPSDMP Kementerian Perhubungan RI.</p>
                <p>Catatan: Gambar ilustrasi dan konten bertanda [Dummy] merupakan data contoh prototipe portal.</p>
            </div>
        </div>
    </footer>
</body>
</html>
