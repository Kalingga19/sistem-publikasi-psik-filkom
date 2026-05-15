@extends('layouts.app')
@section('title', 'Buat Pengajuan — PSIK FILKOM')

@section('content')

{{-- Breadcrumb --}}
<div class="flex items-center gap-2 text-[12px] text-ink-faint mb-6">
    <a href="{{ route('dashboard') }}" class="hover:text-navy transition no-underline">Dashboard</a>
    <span>/</span>
    <a href="{{ route('publications.index') }}" class="hover:text-navy transition no-underline">Riwayat</a>
    <span>/</span>
    <span class="text-ink">Buat Pengajuan</span>
</div>

<div class="mb-6">
    <p class="text-[11px] font-medium tracking-[0.1em] uppercase text-gold mb-1">Pengajuan Baru</p>
    <h1 class="text-[1.6rem] font-normal text-ink"
        style="font-family:'DM Serif Display',serif;">
        Form Pengajuan Konten
    </h1>
</div>

<form method="POST" action="{{ route('publications.store') }}"
      enctype="multipart/form-data"
      class="max-w-2xl">
    @csrf

    <div class="bg-white rounded-xl border border-line divide-y divide-line">

        {{-- Informasi Konten --}}
        <div class="px-6 py-5">
            <h2 class="text-[13px] font-medium text-ink mb-4">Informasi Konten</h2>

            {{-- Judul --}}
            <div class="mb-4">
                <label class="block text-[12px] font-medium text-ink-muted mb-[5px]">
                    Judul Konten <span class="text-red-500">*</span>
                </label>
                <input type="text" name="judul" value="{{ old('judul') }}"
                       placeholder="Masukkan judul konten"
                       maxlength="255"
                       class="w-full h-11 px-3 rounded-lg border text-sm text-ink
                              placeholder-ink-faint outline-none transition duration-150
                              focus:border-navy focus:shadow-[0_0_0_3px_rgba(37,52,101,0.08)]
                              {{ $errors->has('judul') ? 'border-red-400 bg-red-50' : 'border-line bg-white' }}">
                @error('judul')
                <p class="text-[12px] text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jenis Konten --}}
            <div class="mb-4">
                <label class="block text-[12px] font-medium text-ink-muted mb-[5px]">
                    Jenis Konten <span class="text-red-500">*</span>
                </label>
                <select name="jenis_konten"
                        class="w-full h-11 px-3 rounded-lg border text-sm text-ink
                               outline-none transition duration-150 bg-white
                               focus:border-navy focus:shadow-[0_0_0_3px_rgba(37,52,101,0.08)]
                               {{ $errors->has('jenis_konten') ? 'border-red-400' : 'border-line' }}">
                    <option value="" disabled {{ old('jenis_konten') ? '' : 'selected' }}>Pilih jenis konten</option>
                    @foreach(['Prestasi Mahasiswa','Kegiatan Organisasi','Berita Akademik','Lainnya'] as $j)
                    <option value="{{ $j }}" {{ old('jenis_konten') === $j ? 'selected' : '' }}>{{ $j }}</option>
                    @endforeach
                </select>
                @error('jenis_konten')
                <p class="text-[12px] text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label class="block text-[12px] font-medium text-ink-muted mb-[5px]">
                    Deskripsi / Caption <span class="text-red-500">*</span>
                </label>
                <textarea name="deskripsi" rows="4"
                          placeholder="Tuliskan deskripsi konten (min. 20 karakter)"
                          class="w-full px-3 py-2 rounded-lg border text-sm text-ink
                                 placeholder-ink-faint outline-none transition duration-150 resize-none
                                 focus:border-navy focus:shadow-[0_0_0_3px_rgba(37,52,101,0.08)]
                                 {{ $errors->has('deskripsi') ? 'border-red-400 bg-red-50' : 'border-line bg-white' }}">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                <p class="text-[12px] text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Objektif --}}
            <div class="mb-4">
                <label class="block text-[12px] font-medium text-ink-muted mb-[5px]">
                    Objektif Kegiatan <span class="text-red-500">*</span>
                </label>
                <textarea name="objektif" rows="3"
                          placeholder="Tuliskan tujuan dan manfaat kegiatan"
                          class="w-full px-3 py-2 rounded-lg border text-sm text-ink
                                 placeholder-ink-faint outline-none transition duration-150 resize-none
                                 focus:border-navy focus:shadow-[0_0_0_3px_rgba(37,52,101,0.08)]
                                 {{ $errors->has('objektif') ? 'border-red-400 bg-red-50' : 'border-line bg-white' }}">{{ old('objektif') }}</textarea>
                @error('objektif')
                <p class="text-[12px] text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Kegiatan --}}
            <div>
                <label class="block text-[12px] font-medium text-ink-muted mb-[5px]">
                    Tanggal Kegiatan <span class="text-ink-faint">(opsional)</span>
                </label>
                <input type="date" name="tanggal_kegiatan"
                       value="{{ old('tanggal_kegiatan') }}"
                       class="w-full h-11 px-3 rounded-lg border border-line bg-white text-sm text-ink
                              outline-none transition duration-150
                              focus:border-navy focus:shadow-[0_0_0_3px_rgba(37,52,101,0.08)]">
            </div>
        </div>

        {{-- Target Media --}}
        <div class="px-6 py-5">
            <h2 class="text-[13px] font-medium text-ink mb-1">Target Media Publikasi
                <span class="text-red-500">*</span>
            </h2>
            <p class="text-[12px] text-ink-faint mb-4">Pilih minimal satu platform.</p>

            <div class="flex flex-wrap gap-3">
                @foreach(['Instagram', 'Website FILKOM'] as $media)
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" name="media_target[]" value="{{ $media }}"
                           {{ is_array(old('media_target')) && in_array($media, old('media_target')) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-line text-navy cursor-pointer">
                    <span class="text-[13px] text-ink">{{ $media }}</span>
                </label>
                @endforeach
            </div>
            @error('media_target')
            <p class="text-[12px] text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Lampiran --}}
        <div class="px-6 py-5">
            <h2 class="text-[13px] font-medium text-ink mb-1">Lampiran</h2>
            <p class="text-[12px] text-ink-faint mb-4">
                Format: PDF, JPG, PNG · Maks. 10MB per file
            </p>

            <div id="drop-area"
                 class="border-2 border-dashed border-line rounded-xl p-8 text-center
                         hover:border-navy/40 transition duration-150 cursor-pointer"
                 onclick="document.getElementById('lampiran-input').click()">
                <svg class="w-8 h-8 text-ink-faint mx-auto mb-3" fill="none"
                     stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>
                <p class="text-[13px] text-ink-muted">
                    Seret file ke sini atau <span class="text-navy font-medium">pilih file</span>
                </p>
                <p class="text-[11px] text-ink-faint mt-1">PDF, JPG, PNG hingga 10MB</p>
            </div>

            <input type="file" id="lampiran-input" name="lampiran[]"
                   multiple accept=".pdf,.jpg,.jpeg,.png" class="hidden"
                   onchange="updateFileList(this)">

            <div id="file-list" class="mt-3 flex flex-col gap-2"></div>

            @error('lampiran.*')
            <p class="text-[12px] text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Actions --}}
        <div class="px-6 py-4 flex items-center justify-between bg-surface rounded-b-xl">
            <a href="{{ route('publications.index') }}"
               class="text-[13px] text-ink-muted hover:text-ink transition no-underline">
                ← Batal
            </a>
            <button type="submit"
                    class="relative px-6 h-10 overflow-hidden rounded-lg bg-navy text-white
                           text-[13px] font-medium hover:bg-navy-dark transition cursor-pointer border-0">
                Kirim Pengajuan
                <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-gold"></span>
            </button>
        </div>

    </div>
</form>

@endsection

@push('scripts')
<script>
function updateFileList(input) {
    const container = document.getElementById('file-list');
    container.innerHTML = '';
    Array.from(input.files).forEach(file => {
        const sizeKB = (file.size / 1024).toFixed(0);
        container.innerHTML += `
            <div class="flex items-center gap-3 px-3 py-2 rounded-lg bg-surface border border-line text-[12px]">
                <svg class="w-4 h-4 text-ink-faint shrink-0" fill="none" stroke="currentColor"
                     stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                </svg>
                <span class="flex-1 truncate text-ink">${file.name}</span>
                <span class="text-ink-faint shrink-0">${sizeKB} KB</span>
            </div>`;
    });
}
</script>
@endpush