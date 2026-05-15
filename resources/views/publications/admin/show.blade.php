@extends('layouts.app')
@section('title', 'Tinjau Pengajuan — Admin PSIK')

@section('content')

{{-- Breadcrumb --}}
<div class="flex items-center gap-2 text-[12px] text-ink-faint mb-6">
    <a href="{{ route('dashboard') }}" class="hover:text-navy transition no-underline">Dashboard</a>
    <span>/</span>
    <a href="{{ route('admin.publications.index') }}" class="hover:text-navy transition no-underline">Pengajuan Masuk</a>
    <span>/</span>
    <span class="text-ink truncate">{{ Str::limit($publication->judul, 40) }}</span>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Kolom kiri: detail konten --}}
    <div class="lg:col-span-2 flex flex-col gap-5">

        {{-- Header --}}
        <div class="flex items-start justify-between">
            <div>
                <p class="text-[11px] font-medium tracking-[0.1em] uppercase text-gold mb-1">Tinjau Pengajuan</p>
                <h1 class="text-[1.5rem] font-normal text-ink leading-tight"
                    style="font-family:'DM Serif Display',serif;">
                    {{ $publication->judul }}
                </h1>
                <p class="text-[12px] text-ink-faint mt-1">
                    Diajukan oleh <span class="text-ink font-medium">{{ $publication->user->name }}</span>
                    ({{ $publication->user->nim }}) ·
                    {{ $publication->created_at->format('d M Y, H:i') }}
                </p>
            </div>
            <span class="mt-1 px-3 py-1 rounded-lg text-[12px] font-medium shrink-0
                         badge-{{ strtolower(str_replace(' ', '', $publication->status)) }}">
                {{ $publication->status }}
            </span>
        </div>

        {{-- Info --}}
        <div class="bg-white rounded-xl border border-line divide-y divide-line">
            <div class="px-6 py-5">
                <dl class="grid grid-cols-2 gap-x-6 gap-y-4 text-[13px]">
                    <div>
                        <dt class="text-[11px] text-ink-faint uppercase tracking-wide mb-1">Jenis Konten</dt>
                        <dd>{{ $publication->jenis_konten }}</dd>
                    </div>
                    <div>
                        <dt class="text-[11px] text-ink-faint uppercase tracking-wide mb-1">Target Media</dt>
                        <dd>{{ implode(', ', $publication->media_target) }}</dd>
                    </div>
                    @if($publication->tanggal_kegiatan)
                    <div>
                        <dt class="text-[11px] text-ink-faint uppercase tracking-wide mb-1">Tanggal Kegiatan</dt>
                        <dd>{{ $publication->tanggal_kegiatan->format('d M Y') }}</dd>
                    </div>
                    @endif
                    @if($publication->jadwal_publikasi)
                    <div>
                        <dt class="text-[11px] text-ink-faint uppercase tracking-wide mb-1">Jadwal Publikasi</dt>
                        <dd class="text-[#1d4ed8] font-medium">
                            {{ $publication->jadwal_publikasi->format('d M Y, H:i') }}
                        </dd>
                    </div>
                    @endif
                </dl>
            </div>

            <div class="px-6 py-5">
                <dt class="text-[11px] text-ink-faint uppercase tracking-wide mb-2">Deskripsi</dt>
                <dd class="text-[13px] text-ink leading-relaxed">{{ $publication->deskripsi }}</dd>
            </div>

            <div class="px-6 py-5">
                <dt class="text-[11px] text-ink-faint uppercase tracking-wide mb-2">Objektif</dt>
                <dd class="text-[13px] text-ink leading-relaxed">{{ $publication->objektif }}</dd>
            </div>
        </div>

        {{-- Lampiran --}}
        @if($publication->attachments->isNotEmpty())
        <div class="bg-white rounded-xl border border-line px-6 py-5">
            <h2 class="text-[13px] font-medium text-ink mb-3">Lampiran</h2>
            <div class="flex flex-col gap-2">
                @foreach($publication->attachments as $att)
                <a href="{{ route('admin.publications.attachment.download', $att->id) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg border border-line
                          hover:border-navy/30 hover:bg-surface transition no-underline group">
                    <svg class="w-4 h-4 text-ink-faint group-hover:text-navy transition shrink-0"
                         fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                    </svg>
                    <span class="flex-1 text-[13px] text-ink truncate">{{ $att->nama_file }}</span>
                    <span class="text-[11px] text-ink-faint uppercase">{{ $att->tipe_file }}</span>
                    <svg class="w-4 h-4 text-ink-faint group-hover:text-navy transition shrink-0"
                         fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>

    {{-- Kolom kanan: panel keputusan --}}
    <div class="flex flex-col gap-4">

        {{-- Panel: Update Status --}}
        @if(!in_array($publication->status, ['Ditolak', 'Dipublikasikan']))
        <div class="bg-white rounded-xl border border-line px-6 py-5">
            <h2 class="text-[13px] font-medium text-ink mb-4">Keputusan</h2>

            <form method="POST"
                  action="{{ route('admin.publications.status', $publication->id) }}"
                  id="form-status">
                @csrf

                {{-- Radio pilihan status --}}
                <div class="flex flex-col gap-2 mb-4">
                    @foreach([
                        ['value' => 'Disetujui', 'label' => 'Setujui',       'color' => 'text-[#166534]', 'bg' => 'bg-[#f0fdf4] border-[#bbf7d0]'],
                        ['value' => 'Revisi',    'label' => 'Butuh Revisi',  'color' => 'text-[#b45309]', 'bg' => 'bg-[#fff8ec] border-[#fde68a]'],
                        ['value' => 'Ditolak',   'label' => 'Tolak',         'color' => 'text-[#991b1b]', 'bg' => 'bg-[#fef2f2] border-[#fecaca]'],
                    ] as $opt)
                    <label class="flex items-center gap-3 px-4 py-3 rounded-lg border cursor-pointer
                                  {{ $opt['bg'] }} transition hover:opacity-90 select-none">
                        <input type="radio" name="status" value="{{ $opt['value'] }}"
                               onchange="toggleCatatan(this.value)"
                               class="w-4 h-4 cursor-pointer"
                               {{ old('status') === $opt['value'] ? 'checked' : '' }}>
                        <span class="text-[13px] font-medium {{ $opt['color'] }}">
                            {{ $opt['label'] }}
                        </span>
                    </label>
                    @endforeach
                </div>

                {{-- Catatan revisi / alasan tolak --}}
                <div id="catatan-box" class="hidden mb-4">
                    <label class="block text-[12px] font-medium text-ink-muted mb-[5px]">
                        Catatan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="catatan_revisi" rows="4"
                              placeholder="Tuliskan catatan revisi atau alasan penolakan..."
                              class="w-full px-3 py-2 rounded-lg border border-line bg-white
                                     text-[13px] text-ink placeholder-ink-faint outline-none
                                     focus:border-navy transition resize-none">{{ old('catatan_revisi') }}</textarea>
                    @error('catatan_revisi')
                    <p class="text-[12px] text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi modal trigger --}}
                <button type="button"
                        onclick="showConfirm()"
                        class="relative w-full h-10 overflow-hidden rounded-lg bg-navy text-white
                               text-[13px] font-medium hover:bg-navy-dark transition cursor-pointer border-0">
                    Konfirmasi Keputusan
                    <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-gold"></span>
                </button>
            </form>
        </div>
        @endif

        {{-- Panel: Jadwalkan Publikasi --}}
        @if($publication->status === 'Disetujui')
        <div class="bg-white rounded-xl border border-line px-6 py-5">
            <h2 class="text-[13px] font-medium text-ink mb-1">Jadwalkan Publikasi</h2>
            <p class="text-[12px] text-ink-faint mb-4">Maks. 3 konten per hari.</p>

            <form method="POST"
                  action="{{ route('admin.publications.jadwalkan', $publication->id) }}">
                @csrf

                <div class="mb-3">
                    <label class="block text-[12px] font-medium text-ink-muted mb-[5px]">
                        Tanggal & Waktu <span class="text-red-500">*</span>
                    </label>
                    <input type="datetime-local" name="jadwal_publikasi"
                           min="{{ date('Y-m-d\TH:i') }}"
                           class="w-full h-10 px-3 rounded-lg border border-line bg-white
                                  text-[13px] text-ink outline-none focus:border-navy transition">
                    @error('jadwal_publikasi')
                    <p class="text-[12px] text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="relative w-full h-10 overflow-hidden rounded-lg
                               bg-[#1d4ed8] text-white text-[13px] font-medium
                               hover:bg-[#1e40af] transition cursor-pointer border-0">
                    Simpan Jadwal
                    <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-gold"></span>
                </button>
            </form>
        </div>
        @endif

        {{-- Riwayat status --}}
        <div class="bg-white rounded-xl border border-line px-6 py-5">
            <h2 class="text-[13px] font-medium text-ink mb-3">Info Pengajuan</h2>
            <dl class="flex flex-col gap-3 text-[13px]">
                <div>
                    <dt class="text-[11px] text-ink-faint uppercase tracking-wide mb-[2px]">Dikirim</dt>
                    <dd>{{ $publication->created_at->format('d M Y, H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-[11px] text-ink-faint uppercase tracking-wide mb-[2px]">Terakhir diperbarui</dt>
                    <dd>{{ $publication->updated_at->format('d M Y, H:i') }}</dd>
                </div>
                @if($publication->reviewer)
                <div>
                    <dt class="text-[11px] text-ink-faint uppercase tracking-wide mb-[2px]">Direview oleh</dt>
                    <dd>{{ $publication->reviewer->name }}</dd>
                </div>
                @endif
                @if($publication->catatan_revisi)
                <div>
                    <dt class="text-[11px] text-ink-faint uppercase tracking-wide mb-[2px]">Catatan</dt>
                    <dd class="text-ink">{{ $publication->catatan_revisi }}</dd>
                </div>
                @endif
            </dl>
        </div>

    </div>
</div>

{{-- Modal konfirmasi --}}
<div id="confirm-modal"
     class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40">
    <div class="bg-white rounded-2xl shadow-xl w-[340px] mx-4 p-6">
        <h3 class="text-[15px] font-medium text-ink mb-2">Konfirmasi Keputusan</h3>
        <p class="text-[13px] text-ink-muted mb-6">
            Apakah Anda yakin ingin mengubah status pengajuan ini?
            Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="flex gap-3">
            <button onclick="hideConfirm()"
                    class="flex-1 h-10 rounded-lg border border-line text-[13px] text-ink-muted
                           hover:text-ink transition cursor-pointer bg-white">
                Batal
            </button>
            <button onclick="document.getElementById('form-status').submit()"
                    class="flex-1 h-10 rounded-lg bg-navy text-white text-[13px] font-medium
                           hover:bg-navy-dark transition cursor-pointer border-0">
                Ya, Konfirmasi
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function toggleCatatan(val) {
    const box = document.getElementById('catatan-box');
    box.classList.toggle('hidden', !['Revisi', 'Ditolak'].includes(val));
}

function showConfirm() {
    const status = document.querySelector('input[name="status"]:checked');
    if (!status) {
        alert('Pilih salah satu keputusan terlebih dahulu.');
        return;
    }
    document.getElementById('confirm-modal').classList.remove('hidden');
}

function hideConfirm() {
    document.getElementById('confirm-modal').classList.add('hidden');
}

// Tampilkan catatan box jika ada old input
const oldStatus = '{{ old("status") }}';
if (['Revisi', 'Ditolak'].includes(oldStatus)) {
    document.getElementById('catatan-box').classList.remove('hidden');
}
</script>
@endpush