@props(['items' => [], 'label' => 'Navigasi sub-bagian'])

<nav aria-label="{{ $label }}" class="mb-8 border-b border-[#D6D3CB] pb-3">
    <ul class="flex flex-wrap gap-2">
        @foreach ($items as $item)
            <li>
                <a
                    href="{{ route($item['route']) }}"
                    @if (!empty($item['active'])) aria-current="page" @endif
                    class="min-h-11 inline-flex items-center rounded-md border px-4 py-2 text-xs font-semibold transition-colors {{ !empty($item['active']) ? 'border-[#0B2545] bg-[#0B2545] text-white' : 'border-[#6E737D] bg-[#FFFFFF] text-[#1B2430] hover:bg-[#EAF0F6]' }}"
                >
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
