@if ($programs->isEmpty())
    <x-state-empty
        title="Program diklat tidak ditemukan"
        description="Belum ada program pelatihan yang sesuai dengan kata kunci atau rumpun yang Anda pilih. Silakan bersihkan filter untuk melihat seluruh katalog."
        :resetUrl="route('diklat.index')"
        resetLabel="Tampilkan Semua Program"
        resetAttr="data-reset-program-filter"
    />
@else
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($programs as $program)
            <x-program-card :program="$program" />
        @endforeach
    </div>
@endif
