@extends('layouts.app')
@section('title', 'Dashboard Admin — PSIK FILKOM')

@section('content')

<div class="mb-7">
    <p class="text-[11px] font-medium tracking-[0.1em] uppercase text-gold mb-1">Dashboard Admin</p>
    <h1 class="text-[1.6rem] font-normal text-ink"
        style="font-family:'DM Serif Display',serif;">
        Panel Pengelolaan
    </h1>
    <p class="text-sm text-ink-muted mt-1">Ringkasan seluruh pengajuan konten publikasi FILKOM.</p>
</div>

{{-- Stat cards --}}
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
    @foreach([
        ['label' => 'Total',          'value' => $stats['total'],           'badge' => 'badge-diajukan'],
        ['label' => 'Menunggu',       'value' => $stats['menunggu'],        'badge' => 'badge-menunggu'],
        ['label' => 'Disetujui',      'value' => $stats['disetujui'],       'badge' => 'badge-disetujui'],
        ['label' => 'Ditolak',        'value' => $stats['ditolak'],         'badge' => 'badge-ditolak'],
        ['label' => 'Dijadwalkan',    'value' => $stats['dijadwalkan'],     'badge' => 'badge-dijadwalkan'],
        ['label' => 'Dipublikasikan', 'value' => $stats['dipublikasikan'],  'badge' => 'badge-dipublikasikan'],
    ] as $card)
    <div class="bg-white rounded-xl border border-line p-5">
        <div class="text-[11px] text-ink-faint mb-2">{{ $card['label'] }}</div>
        <div class="text-[1.8rem] font-light text-ink"
             style="font-family:'DM Serif Display',serif;">
            {{ $card['value'] }}
        </div>
    </div>
    @endforeach
</div>

{{-- Tabel pengajuan terbaru --}}
<div class="bg-white rounded-xl border border-line">
    <div class="flex items-center justify-between px-6 py-4 border-b border-line">
        <h2 class="text-[14px] font-medium text-ink">Pengajuan Terbaru</h2>
        <a href="{{ route('admin.publications.index') }}"
           class="text-[12px] text-navy hover:text-gold transition no-underline">
            Lihat semua →
        </a>
    </div>

    @if($recentPublications->isEmpty())
    <div class="px-6 py-12 text-center">
        <p class="text-sm text-ink-faint">Belum ada pengajuan masuk.</p>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="w-full text-[13px]">
            <thead>
                <tr class="border-b border-line bg-surface">
                    <th class="text-left px-6 py-3 text-[11px] font-medium text-ink-faint uppercase tracking-wide">Judul</th>
                    <th class="text-left px-4 py-3 text-[11px] font-medium text-ink-faint uppercase tracking-wide">Pengaju</th>
                    <th class="text-left px-4 py-3 text-[11px] font-medium text-ink-faint uppercase tracking-wide">Jenis</th>
                    <th class="text-left px-4 py-3 text-[11px] font-medium text-ink-faint uppercase tracking-wide">Status</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-line">
                @foreach($recentPublications as $pub)
                <tr class="hover:bg-surface/60 transition">
                    <td class="px-6 py-4 font-medium text-ink max-w-[200px] truncate">
                        {{ $pub->judul }}
                    </td>
                    <td class="px-4 py-4 text-ink-muted">{{ $pub->user->name }}</td>
                    <td class="px-4 py-4 text-ink-muted">{{ $pub->jenis_konten }}</td>
                    <td class="px-4 py-4">
                        <span class="px-2 py-[3px] rounded-md text-[11px] font-medium
                                     badge-{{ strtolower(str_replace(' ', '', $pub->status)) }}">
                            {{ $pub->status }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-right">
                        <a href="{{ route('admin.publications.show', $pub->id) }}"
                           class="text-[12px] text-navy hover:text-gold transition no-underline">
                            Tinjau →
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@endsection