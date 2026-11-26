@props([
    'action',
    'formId' => 'inquiry-form',
    'successKey' => 'contact_success',
    'submitLabel' => 'Kirim Pesan',
    'subjectLabel' => 'Perihal / Topik',
    'subjectPlaceholder' => 'Contoh: Kendala akses akun LMS angkatan berjalan',
    'messageLabel' => 'Isi Pesan',
    'messagePlaceholder' => 'Tuliskan rincian pertanyaan, NIP/unit kerja bila terkait peserta diklat, atau informasi yang dibutuhkan...',
])

<div>
    @if (session($successKey))
        <div role="status" aria-live="polite" class="mb-6 rounded-md border border-[#166534]/40 bg-[#DCFCE7] p-4 text-sm text-[#166534]">
            <p class="font-semibold">Pengiriman Berhasil</p>
            <p class="mt-1">{{ session($successKey) }}</p>
        </div>
    @endif

    @if ($errors->hasAny(['sender_name', 'sender_email', 'sender_phone', 'sender_unit', 'subject', 'message']))
        <div id="{{ $formId }}-error-summary" tabindex="-1" role="alert" data-error-summary class="mb-6 rounded-md border border-[#991B1B]/40 bg-[#FEE2E2] p-4 text-sm text-[#991B1B]">
            <p class="font-semibold">Terdapat {{ $errors->count() }} kolom yang perlu diperbaiki sebelum dikirim:</p>
            <ul class="mt-2 list-disc space-y-1 pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="{{ $formId }}" method="POST" action="{{ $action }}" novalidate class="space-y-5">
        @csrf

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div>
                <label for="{{ $formId }}-name" class="block text-sm font-semibold text-[#0B2545]">
                    Nama Lengkap <span class="text-[#991B1B]" aria-hidden="true">*</span>
                </label>
                <input
                    id="{{ $formId }}-name"
                    name="sender_name"
                    type="text"
                    required
                    autocomplete="name"
                    value="{{ old('sender_name') }}"
                    placeholder="Nama Lengkap Anda"
                    @error('sender_name') aria-invalid="true" aria-describedby="{{ $formId }}-name-error" @enderror
                    class="mt-1.5 min-h-11 w-full rounded-md border {{ $errors->has('sender_name') ? 'border-[#991B1B]' : 'border-[#6E737D]' }} bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#1B2430]"
                >
                @error('sender_name')
                    <p id="{{ $formId }}-name-error" role="alert" class="mt-1.5 text-xs font-medium text-[#991B1B]">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="{{ $formId }}-email" class="block text-sm font-semibold text-[#0B2545]">
                    Alamat Email <span class="text-[#991B1B]" aria-hidden="true">*</span>
                </label>
                <input
                    id="{{ $formId }}-email"
                    name="sender_email"
                    type="email"
                    required
                    autocomplete="email"
                    value="{{ old('sender_email') }}"
                    placeholder="nama@instansi.go.id"
                    @error('sender_email') aria-invalid="true" aria-describedby="{{ $formId }}-email-error" @enderror
                    class="mt-1.5 min-h-11 w-full rounded-md border {{ $errors->has('sender_email') ? 'border-[#991B1B]' : 'border-[#6E737D]' }} bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#1B2430]"
                >
                @error('sender_email')
                    <p id="{{ $formId }}-email-error" role="alert" class="mt-1.5 text-xs font-medium text-[#991B1B]">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div>
                <label for="{{ $formId }}-phone" class="block text-sm font-semibold text-[#0B2545]">
                    Nomor Telepon / WhatsApp (Opsional)
                </label>
                <input
                    id="{{ $formId }}-phone"
                    name="sender_phone"
                    type="tel"
                    autocomplete="tel"
                    value="{{ old('sender_phone') }}"
                    placeholder="08xxxxxxxxxx"
                    class="mt-1.5 min-h-11 w-full rounded-md border border-[#6E737D] bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#1B2430]"
                >
            </div>

            <div>
                <label for="{{ $formId }}-unit" class="block text-sm font-semibold text-[#0B2545]">
                    Unit Kerja / Instansi (Opsional)
                </label>
                <input
                    id="{{ $formId }}-unit"
                    name="sender_unit"
                    type="text"
                    value="{{ old('sender_unit') }}"
                    placeholder="Contoh: BPSDMP / Unit Pelaksana Teknis"
                    class="mt-1.5 min-h-11 w-full rounded-md border border-[#6E737D] bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#1B2430]"
                >
            </div>
        </div>

        <div>
            <label for="{{ $formId }}-subject" class="block text-sm font-semibold text-[#0B2545]">
                {{ $subjectLabel }} <span class="text-[#991B1B]" aria-hidden="true">*</span>
            </label>
            <input
                id="{{ $formId }}-subject"
                name="subject"
                type="text"
                required
                value="{{ old('subject') }}"
                placeholder="{{ $subjectPlaceholder }}"
                @error('subject') aria-invalid="true" aria-describedby="{{ $formId }}-subject-error" @enderror
                class="mt-1.5 min-h-11 w-full rounded-md border {{ $errors->has('subject') ? 'border-[#991B1B]' : 'border-[#6E737D]' }} bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#1B2430]"
            >
            @error('subject')
                <p id="{{ $formId }}-subject-error" role="alert" class="mt-1.5 text-xs font-medium text-[#991B1B]">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="{{ $formId }}-message" class="block text-sm font-semibold text-[#0B2545]">
                {{ $messageLabel }} <span class="text-[#991B1B]" aria-hidden="true">*</span>
            </label>
            <textarea
                id="{{ $formId }}-message"
                name="message"
                rows="5"
                required
                placeholder="{{ $messagePlaceholder }}"
                @error('message') aria-invalid="true" aria-describedby="{{ $formId }}-message-error" @enderror
                class="mt-1.5 w-full rounded-md border {{ $errors->has('message') ? 'border-[#991B1B]' : 'border-[#6E737D]' }} bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#1B2430]"
            >{{ old('message') }}</textarea>
            @error('message')
                <p id="{{ $formId }}-message-error" role="alert" class="mt-1.5 text-xs font-medium text-[#991B1B]">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-1">
            <button
                type="submit"
                class="min-h-11 inline-flex items-center justify-center rounded-md bg-[#0B2545] px-6 py-3 text-sm font-semibold text-white hover:bg-[#133C6D]"
            >
                {{ $submitLabel }}
            </button>
        </div>
    </form>
</div>
