@props(['items' => []])

<nav aria-label="Navigasi jejak halaman" class="mb-6 text-sm text-[#4B5563]">
    <ol class="flex flex-wrap items-center gap-2">
        <li>
            <a href="{{ route('home') }}" class="inline-flex min-h-11 items-center font-medium text-[#133C6D] hover:underline">
                Beranda
            </a>
        </li>
        @foreach ($items as $item)
            <li aria-hidden="true" class="text-[#6A6F78]">/</li>
            <li>
                @if (!empty($item['url']))
                    <a href="{{ $item['url'] }}" class="inline-flex min-h-11 items-center font-medium text-[#133C6D] hover:underline">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span aria-current="page" class="font-semibold text-[#0B2545]">
                        {{ $item['label'] }}
                    </span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
