@props([
    'status' => 'terjadwal',
    'label' => null,
])

@php
    $styles = match ($status) {
        'dibuka', 'selesai_ok' => 'bg-[#DCFCE7] text-[#166534] border-[#166534]/30',
        'terjadwal', 'diproses', 'dummy' => 'bg-[#FEF9C3] text-[#854D0E] border-[#854D0E]/30',
        'mandiri', 'baru' => 'bg-[#EAF0F6] text-[#0B2545] border-[#1E4E79]/30',
        default => 'bg-[#F1EFEA] text-[#1B2430] border-[#D6D3CB]',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 rounded-sm border px-2.5 py-1 text-xs font-semibold {$styles}"]) }}>
    {{ $label ?? ucfirst($status) }}
</span>
