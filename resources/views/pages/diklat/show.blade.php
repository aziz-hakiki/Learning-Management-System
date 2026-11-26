<x-layouts.app
    :title="$program->title . ' - Katalog Diklat PPSDMAP'"
    :description="$program->summary"
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[
            ['label' => 'Program', 'url' => route('program.corpu')],
            ['label' => 'Pelatihan', 'url' => route('diklat.index')],
            ['label' => $program->code],
        ]" />

        <div class="grid grid-cols-1 gap-10 lg:grid-cols-12 lg:items-start">
            <div class="lg:col-span-8">
                <div class="flex flex-wrap items-center gap-3">
                    <span class="tabular-code text-sm font-semibold text-[#1E4E79]">{{ $program->code }}</span>
                    <x-status-badge
                        :status="$program->registration_status"
                        :label="$program->registrationStatusLabel()"
                    />
                    @if ($program->is_dummy)
                        <x-status-badge status="dummy" label="Data Contoh (Dummy)" />
                    @endif
                </div>

                <h1 class="type-h1 mt-3 text-[#0B2545]">{{ $program->title }}</h1>

                <p class="mt-4 max-w-[68ch] text-base leading-relaxed text-[#1B2430]">
                    {{ $program->summary }}
                </p>

                <div class="mt-8 rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6">
                    <h2 class="type-h3 text-[#0B2545]">Pokok Materi dan Kurikulum</h2>
                    @if (!empty($program->curriculum))
                        <ol class="mt-4 space-y-3">
                            @foreach ($program->curriculum as $idx => $topic)
                                <li class="flex items-start gap-3 border-b border-[#D6D3CB] pb-3 last:border-b-0 last:pb-0">
                                    <span class="tabular-code text-xs font-semibold text-[#8A5A00] pt-1">
                                        0{{ $idx + 1 }}
                                    </span>
                                    <span class="text-sm leading-relaxed text-[#1B2430]">{{ $topic }}</span>
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <p class="mt-3 text-sm text-[#4B5563]">
                            Rincian silabus lengkap dibagikan melalui surat pemanggilan atau halaman kursus di LMS.
                        </p>
                    @endif
                </div>
            </div>

            <aside class="space-y-6 lg:col-span-4">
                @if ($program->thumbnail_path)
                    <div class="overflow-hidden rounded-md border border-[#D6D3CB] bg-[#FFFFFF]">
                        <img
                            src="{{ asset(ltrim($program->thumbnail_path, '/')) }}"
                            alt="Ilustrasi sampul program {{ $program->title }}"
                            width="800"
                            height="600"
                            class="h-auto w-full object-cover aspect-[4/3]"
                        >
                    </div>
                @endif

                <div class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6">
                    <h2 class="type-h3 text-[#0B2545]">Ringkasan Penyelenggaraan</h2>
                    <dl class="mt-4 space-y-3 text-sm">
                        <div class="border-b border-[#D6D3CB] pb-2.5">
                            <dt class="text-xs font-semibold text-[#4B5563]">Rumpun Pelatihan</dt>
                            <dd class="mt-0.5 font-medium text-[#0B2545]">{{ $program->categoryLabel() }}</dd>
                        </div>
                        <div class="border-b border-[#D6D3CB] pb-2.5">
                            <dt class="text-xs font-semibold text-[#4B5563]">Metode Belajar</dt>
                            <dd class="mt-0.5 font-medium text-[#0B2545]">{{ $program->deliveryModeLabel() }}</dd>
                        </div>
                        <div class="border-b border-[#D6D3CB] pb-2.5">
                            <dt class="text-xs font-semibold text-[#4B5563]">Sasaran Peserta</dt>
                            <dd class="mt-0.5 font-medium text-[#0B2545]">{{ $program->target_audience }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold text-[#4B5563]">Keterangan Jadwal</dt>
                            <dd class="mt-0.5 font-medium text-[#0B2545]">{{ $program->schedule_label }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6 flex flex-col gap-3">
                        @if ($program->lms_url)
                            <a
                                href="{{ $program->lms_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="min-h-11 inline-flex items-center justify-center gap-2 rounded-md bg-[#0B2545] px-4 py-3 text-sm font-semibold text-white hover:bg-[#133C6D]"
                            >
                                <span>Buka Kelas di LMS</span>
                                <span aria-hidden="true">&#8599;</span>
                            </a>
                        @endif
                        <a
                            href="{{ route('kontak.index') }}"
                            class="min-h-11 inline-flex items-center justify-center rounded-md border border-[#6E737D] bg-[#FFFFFF] px-4 py-3 text-sm font-semibold text-[#0B2545] hover:bg-[#EAF0F6]"
                        >
                            Konsultasi Pengusulan Peserta
                        </a>
                    </div>
                </div>
            </aside>
        </div>

        @if ($relatedPrograms->isNotEmpty())
            <section class="mt-14 border-t border-[#D6D3CB] pt-10">
                <h2 class="type-h2 text-[#0B2545]">Program Serumpun Lainnya</h2>
                <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($relatedPrograms as $related)
                        <x-program-card :program="$related" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-layouts.app>
