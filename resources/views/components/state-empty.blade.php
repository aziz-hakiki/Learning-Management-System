@props([
    'title' => 'Data belum tersedia',
    'description' => 'Belum ada entri yang cocok dengan kriteria pencarian saat ini.',
    'resetUrl' => null,
    'resetLabel' => 'Tampilkan Semua Data',
    'resetAttr' => null,
])

<div class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6 sm:p-8">
    <h3 class="type-h3 text-[#0B2545]">{{ $title }}</h3>
    <p class="mt-2 max-w-xl text-sm leading-relaxed text-[#4B5563]">{{ $description }}</p>

    @if ($resetUrl)
        <div class="mt-5">
            <a
                href="{{ $resetUrl }}"
                @if ($resetAttr) {{ $resetAttr }} @endif
                class="min-h-11 inline-flex items-center rounded-md border border-[#6E737D] bg-[#FFFFFF] px-4 py-2.5 text-sm font-semibold text-[#0B2545] hover:bg-[#EAF0F6]"
            >
                {{ $resetLabel }}
            </a>
        </div>
    @endif
</div>
