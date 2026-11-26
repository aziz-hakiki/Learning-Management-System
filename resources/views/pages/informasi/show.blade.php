<x-layouts.app
    :title="$article->title . ' - PPSDMAP Kemenhub'"
    :description="$article->excerpt"
>
    <div class="mx-auto max-w-[1240px] px-4 py-10 sm:px-6 lg:py-14">
        <x-breadcrumb :items="[
            ['label' => 'Publikasi', 'url' => route('informasi.index')],
            ['label' => 'Berita', 'url' => route('informasi.index')],
            ['label' => $article->typeLabel()],
        ]" />

        <div class="grid grid-cols-1 gap-10 lg:grid-cols-12 lg:items-start">
            <article class="lg:col-span-8">
                <div class="flex flex-wrap items-center gap-3 text-xs text-[#4B5563]">
                    <x-status-badge status="mandiri" :label="$article->typeLabel()" />
                    <time datetime="{{ $article->published_at?->toDateString() }}" class="tabular-code">
                        Diterbitkan {{ $article->published_at?->translatedFormat('d F Y') }}
                    </time>
                    @if ($article->is_dummy)
                        <x-status-badge status="dummy" label="Konten Contoh (Dummy)" />
                    @endif
                </div>

                <h1 class="type-h1 mt-4 text-[#0B2545]">{{ $article->title }}</h1>

                @if ($article->event_date)
                    <p class="mt-3 text-sm font-semibold text-[#8A5A00]">
                        Jadwal Pelaksanaan (Contoh): {{ $article->event_date->translatedFormat('d F Y') }}
                    </p>
                @endif

                @if ($article->cover_image_path)
                    <figure class="mt-6 overflow-hidden rounded-md border border-[#D6D3CB] bg-[#FFFFFF]">
                        <img
                            src="{{ asset(ltrim($article->cover_image_path, '/')) }}"
                            alt="Ilustrasi sampul {{ $article->title }}"
                            width="1200"
                            height="675"
                            class="h-auto w-full object-cover aspect-video"
                        >
                    </figure>
                @endif

                <div class="mt-7 max-w-[68ch] space-y-4 text-base leading-relaxed text-[#1B2430]">
                    @foreach (preg_split("/\r\n|\n|\r/", trim($article->body)) as $paragraph)
                        @if (filled($paragraph))
                            <p>{{ $paragraph }}</p>
                        @endif
                    @endforeach
                </div>

                @if ($article->attachment_path)
                    <div class="mt-8 rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-5">
                        <p class="text-sm font-semibold text-[#0B2545]">Lampiran Dokumen</p>
                        <a
                            href="{{ asset(ltrim($article->attachment_path, '/')) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="mt-3 min-h-11 inline-flex items-center gap-2 rounded-md bg-[#0B2545] px-4 py-2.5 text-sm font-semibold text-white hover:bg-[#133C6D]"
                        >
                            <span>Unduh Lampiran PDF</span>
                            <span aria-hidden="true">&#8599;</span>
                        </a>
                    </div>
                @endif
            </article>

            <aside class="rounded-md border border-[#D6D3CB] bg-[#FFFFFF] p-6 lg:col-span-4">
                <h2 class="type-h3 text-[#0B2545]">Informasi Lainnya</h2>
                @if ($recentArticles->isEmpty())
                    <p class="mt-3 text-sm text-[#4B5563]">Belum ada artikel lainnya.</p>
                @else
                    <ul class="mt-4 divide-y divide-[#D6D3CB]">
                        @foreach ($recentArticles as $recent)
                            <li class="py-3.5 first:pt-0 last:pb-0">
                                <span class="text-xs font-semibold text-[#1E4E79]">{{ $recent->typeLabel() }}</span>
                                <a
                                    href="{{ route('informasi.show', $recent->slug) }}"
                                    class="mt-1 block text-sm font-semibold leading-snug text-[#0B2545] hover:text-[#133C6D] hover:underline"
                                >
                                    {{ $recent->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="mt-5 border-t border-[#D6D3CB] pt-4">
                    <a href="{{ route('informasi.index') }}" class="min-h-11 inline-flex items-center text-sm font-semibold text-[#133C6D] hover:underline">
                        Kembali ke Arsip Informasi
                    </a>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.app>
