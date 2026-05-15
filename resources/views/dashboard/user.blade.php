@extends('layouts.app')
@section('title', 'Dashboard — PSIK FILKOM')

@section('content')

{{-- Page header --}}
<div class="mb-7">
    <p class="text-[11px] font-medium tracking-[0.1em] uppercase text-gold mb-1">Dashboard</p>
    <h1 class="text-[1.6rem] font-normal text-ink leading-tight"
        style="font-family:'DM Serif Display',serif;">
        Selamat datang, {{ auth()->user()->name }}
    </h1>
    <p class="text-sm text-ink-muted mt-1">Pantau perkembangan pengajuan konten publikasi kamu.</p>
</div>

{{-- Stat cards --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    @foreach([
        ['label' => 'Total Pengajuan',    'value' => $stats['total'],     'color' => 'navy',   'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
        ['label' => 'Menunggu Validasi',  'value' => $stats['menunggu'],  'color' => 'yellow', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
        ['label' => 'Disetujui',          'value' => $stats['disetujui'], 'color' => 'green',  'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
        ['label' => 'Perlu Revisi',       'value' => $stats['revisi'],    'color' => 'orange', 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
    ] as $card)
    <div class="bg-white rounded-xl border border-line p-5">
        <div class="flex items-start justify-between mb-3">
            <span class="text-[12px] text-ink-muted font-medium">{{ $card['label'] }}</span>
            <svg class="w-4 h-4 text-ink-faint" fill="none" stroke="currentColor"
                 stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}"/>
            </svg>
        </div>
        <div class="text-[1.8rem] font-light text-ink"
             style="font-family:'DM Serif Display',serif;">
            {{ $card['value'] }}
        </div>
    </div>
    @endforeach
</div>

{{-- Pengajuan terbaru --}}
<div class="bg-white rounded-xl border border-line">
    <div class="flex items-center justify-between px-6 py-4 border-b border-line">
        <h2 class="text-[14px] font-medium text-ink">Pengajuan Terbaru</h2>
        <a href="{{ route('publications.index') }}"
           class="text-[12px] text-navy hover:text-gold transition no-underline">
            Lihat semua →
        </a>
    </div>

    @if($recentPublications->isEmpty())
    <div class="px-6 py-12 text-center">
        <p class="text-sm text-ink-faint mb-3">Belum ada pengajuan.</p>
        <a href="{{ route('publications.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-navy text-white
                  text-[13px] font-medium hover:bg-navy-dark transition no-underline">
            Buat Pengajuan Baru
        </a>
    </div>
    @else
    <div class="divide-y divide-line">
        @foreach($recentPublications as $pub)
        <div class="flex items-center justify-between px-6 py-4">
            <div class="min-w-0 flex-1">
                <p class="text-[13px] font-medium text-ink truncate">{{ $pub->judul }}</p>
                <p class="text-[11px] text-ink-faint mt-[2px]">
                    {{ $pub->jenis_konten }} ·
                    {{ $pub->created_at->diffForHumans() }}
                </p>
            </div>
            <div class="flex items-center gap-3 ml-4">
                <span class="px-2 py-[3px] rounded-md text-[11px] font-medium
                             badge-{{ strtolower(str_replace(' ', '', $pub->status)) }}">
                    {{ $pub->status }}
                </span>
                <a href="{{ route('publications.show', $pub->id) }}"
                   class="text-[12px] text-navy hover:text-gold transition no-underline shrink-0">
                    Detail →
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

@endsection