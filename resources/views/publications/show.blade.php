@extends('layouts.app')
@section('title', 'Detail Pengajuan — PSIK FILKOM')

@section('content')

{{-- Breadcrumb --}}
<div class="flex items-center gap-2 text-[12px] text-ink-faint mb-6">
    <a href="{{ route('dashboard') }}" class="hover:text-navy transition no-underline">Dashboard</a>
    <span>/</span>
    <a href="{{ route('publications.index') }}" class="hover:text-navy transition no-underline">Riwayat</a>
    <span>/</span>
    <span class="text-ink truncate">{{ Str::limit($publication->judul, 40) }}</span>
</div>

<div class="max-w-2xl">

    {{-- Header --}}
    <div class="flex items-start justify-between mb-6">
        <div>
            <p class="text-[11px] font-medium tracking-[0.1em] uppercase text-gold mb-1">Detail</p>
            <h1 class="text-[1.5rem] font-normal text-ink leading-tight"
                style="font-family:'DM Serif Display',serif;">
                {{ $publication->judul }}
            </h1>
        </div>
        <span class="mt-1 px-3 py-1 rounded-lg text-[12px] font-medium shrink-0
                     badge-{{ strtolower(str_replace(' ', '', $publication->status)) }}">
            {{ $publication->status }}
        </span>
    </div>

    {{-- Catatan Revisi --}}
    @if($publication->status === 'Revisi' && $publication->catatan_revisi)
    <div class="flex gap-3 bg-[#fff8ec] border border-[#fde68a] rounded-xl px-5 py-4 mb-5">
        <svg class="w-5 h-5 text-[#b45309] shrink-0 mt-[1px]" fill="none" stroke="currentColor"
             stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
        <div>
            <p class="text-[12px] font-medium text-[#b45309] mb-1">Catatan Revisi dari Admin</p>
            <p class="text-[13px] text-[#92400e]">{{ $publication->catatan_revisi }}</p>
        </div>
    </div>
    @endif

    {{-- Ditolak --}}
    @if($publication->status === 'Ditolak' && $publication->catatan_revisi)
    <div class="flex gap-3 bg-[#fef2f2] border border-[#fecaca] rounded-xl px-5 py-4 mb-5">
        <svg class="w-5 h-5 text-red-500 shrink-0 mt-[1px]" fill="none" stroke="currentColor"
             stroke-width="1.5" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/>
            <path stroke-linecap="round" d="M15 9l-6 6M9 9l6 6"/>
        </svg>
        <div>
            <p class="text-[12px] font-medium text-red-600 mb-1">Alasan Penolakan</p>
            <p class="text-[13px] text-red-700">{{ $publication->catatan_revisi }}</p>
        </div>
    </div>
    @endif

    {{-- Detail konten --}}
    <div class="bg-white rounded-xl border border-line divide-y divide-line mb-5">
        <div class="px-6 py-5">
            <h2 class="text-[13px] font-medium text-ink mb-4">Informasi Konten</h2>
            <dl class="grid grid-cols-2 gap-x-6 gap-y-4 text-[13px]">
                <div>
                    <dt class="text-[11px] text-ink-faint uppercase tracking-wide mb-1">Jenis Konten</dt>
                    <dd class="text-ink">{{ $publication->jenis_konten }}</dd>
                </div>
                <div>
                    <dt class="text-[11px] text-ink-faint uppercase tracking-wide mb-1">Target Media</dt>
                    <dd class="text-ink">{{ implode(', ', $publication->media_target) }}</dd>
                </div>
                <div>
                    <dt class="text-[11px] text-ink-faint uppercase tracking-wide mb-1">Tanggal Pengajuan</dt>
                    <dd class="text-ink">{{ $publication->created_at->format('d M Y, H:i') }}</dd>
                </div>
                @if($publication->tanggal_kegiatan)
                <div>
                    <dt class="text-[11px] text-ink-faint uppercase tracking-wide mb-1">Tanggal Kegiatan</dt>
                    <dd class="text-ink">{{ $publication->tanggal_kegiatan->format('d M Y') }}</dd>
                </div>
                @endif
                @if($publication->jadwal_publikasi)
                <div>
                    <dt class="text-[11px] text-ink-faint uppercase tracking-wide mb-1">Jadwal Publikasi</dt>
                    <dd class="text-ink">{{ $publication->jadwal_publikasi->format('d M Y, H:i') }}</dd>
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
    <div class="bg-white rounded-xl border border-line px-6 py-5 mb-5">
        <h2 class="text-[13px] font-medium text-ink mb-3">Lampiran</h2>
        <div class="flex flex-col gap-2">
            @foreach($publication->attachments as $att)
            <a href="{{ route('publications.attachment.download', $att->id) }}"
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

    <a href="{{ route('publications.index') }}"
       class="text-[13px] text-ink-muted hover:text-ink transition no-underline">
        ← Kembali ke riwayat
    </a>
</div>

@endsection