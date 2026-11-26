@props(['program', 'featured' => false])

<article class="flex flex-col justify-between rounded-md border border-[#D6D3CB] bg-[#FFFFFF] overflow-hidden {{ $featured ? 'md:col-span-2 lg:flex-row' : '' }}">
    @if ($program->thumbnail_path)
        <div class="{{ $featured ? 'lg:w-5/12 shrink-0' : '' }} bg-[#EAF0F6]">
            <img
                src="{{ asset(ltrim($program->thumbnail_path, '/')) }}"
                alt="Ilustrasi sampul program {{ $program->title }}"
                width="800"
                height="600"
                loading="lazy"
                class="h-full w-full object-cover aspect-[4/3]"
            >
        </div>
    @endif

    <div class="flex flex-1 flex-col justify-between p-5 sm:p-6">
        <div>
            <div class="flex flex-wrap items-center justify-between gap-2">
                <span class="tabular-code text-xs font-medium text-[#1E4E79]">
                    {{ $program->code }}
                </span>
                <x-status-badge
                    :status="$program->registration_status"
                    :label="$program->registrationStatusLabel()"
                />
            </div>

            <h3 class="type-h3 mt-3 text-[#0B2545]">
                <a href="{{ route('diklat.show', $program->slug) }}" class="hover:text-[#133C6D] hover:underline">
                    {{ $program->title }}
                </a>
            </h3>

            <p class="mt-2 text-sm leading-relaxed text-[#4B5563]">
                {{ $program->summary }}
            </p>
        </div>

        <div class="mt-5 border-t border-[#D6D3CB] pt-4">
            <dl class="grid grid-cols-1 gap-2 text-xs text-[#4B5563] sm:grid-cols-2">
                <div>
                    <dt class="font-semibold text-[#1B2430]">Rumpun</dt>
                    <dd>{{ $program->categoryLabel() }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-[#1B2430]">Metode &amp; Jadwal</dt>
                    <dd>{{ $program->deliveryModeLabel() }}, {{ $program->schedule_label }}</dd>
                </div>
            </dl>

            <div class="mt-4 flex items-center justify-between gap-3">
                <a
                    href="{{ route('diklat.show', $program->slug) }}"
                    class="min-h-11 inline-flex items-center font-semibold text-sm text-[#133C6D] hover:text-[#0B2545] hover:underline"
                >
                    Lihat Silabus Program
                </a>

                @if ($program->is_dummy)
                    <span class="text-xs font-medium text-[#8A5A00]">Data Contoh</span>
                @endif
            </div>
        </div>
    </div>
</article>
