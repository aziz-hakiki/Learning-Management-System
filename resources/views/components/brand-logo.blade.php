{{-- Temporary geometric brand mark; replace with official Kemenhub/BPSDMP vector logo before production. --}}
@props([
    'variant' => 'light',
    'showSubtitle' => true,
])

@php
    $isDark = $variant === 'dark';
    $titleColor = $isDark ? 'text-white' : 'text-[#0B2545]';
    $subtitleColor = $isDark ? 'text-[#EAF0F6]' : 'text-[#4B5563]';
    $markBg = $isDark ? '#133C6D' : '#0B2545';
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-3']) }}>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="44" height="44" aria-hidden="true" class="shrink-0">
        <rect width="48" height="48" rx="6" fill="{{ $markBg }}"/>
        <rect x="6" y="36" width="36" height="2.5" fill="#E5A91A"/>
        <circle cx="24" cy="21" r="10.5" fill="none" stroke="#EAF0F6" stroke-width="2"/>
        <polygon points="24,12 27.5,21 24,30 20.5,21" fill="#E5A91A"/>
        <circle cx="24" cy="21" r="2.2" fill="{{ $markBg }}"/>
    </svg>
    <span class="flex flex-col leading-tight">
        <span class="font-display text-base font-bold tracking-tight {{ $titleColor }}">
            PPSDMAP Kemenhub
        </span>
        @if ($showSubtitle)
            <span class="text-xs font-medium {{ $subtitleColor }}">
                BPSDMP Kementerian Perhubungan
            </span>
        @endif
    </span>
</span>
