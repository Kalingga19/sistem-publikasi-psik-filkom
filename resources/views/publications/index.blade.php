@extends('layouts.app')
@section('title', 'Riwayat Pengajuan — PSIK FILKOM')

@section('content')

<div class="flex items-start justify-between mb-7">
    <div>
        <p class="text-[11px] font-medium tracking-[0.1em] uppercase text-gold mb-1">Pengajuan Saya</p>
        <h1 class="text-[1.6rem] font-normal text-ink"
            style="font-family:'DM Serif Display',serif;">
            Riwayat Pengajuan
        </h1>
    </div>
    <a href="{{ route('publications.create') }}"
       class="relative flex items-center gap-2 px-4 h-10 overflow-hidden rounded-lg
              bg-navy text-white text-[13px] font-medium hover:bg-navy-dark transition no-underline">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Buat Pengajuan
        <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-gold"></span>
    </a>
</div>

<div class="bg-white rounded-xl border border-line">

    @if($publications->isEmpty())
    <div class="py-16 text-center">
        <svg class="w-10 h-10 text-ink-faint mx-auto mb-3" fill="none" stroke="currentColor"
             stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <p class="text-sm text-ink-faint">Belum ada riwayat pengajuan.</p>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="w-full text-[13px]">
            <thead>
                <tr class="border-b border-line bg-surface">
                    <th class="text-left px-6 py-3 text-[11px] font-medium text-ink-faint uppercase tracking-wide">Judul</th>
                    <th class="text-left px-4 py-3 text-[11px] font-medium text-ink-faint uppercase tracking-wide">Jenis</th>
                    <th class="text-left px-4 py-3 text-[11px] font-medium text-ink-faint uppercase tracking-wide">Tanggal</th>
                    <th class="text-left px-4 py-3 text-[11px] font-medium text-ink-faint uppercase tracking-wide">Status</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-line">
                @foreach($publications as $pub)
                <tr class="hover:bg-surface/50 transition">
                    <td class="px-6 py-4">
                        <span class="font-medium text-ink">{{ $pub->judul }}</span>
                        <div class="text-[11px] text-ink-faint mt-[2px]">
                            {{ implode(', ', $pub->media_target) }}
                        </div>
                    </td>
                    <td class="px-4 py-4 text-ink-muted">{{ $pub->jenis_konten }}</td>
                    <td class="px-4 py-4 text-ink-muted">
                        {{ $pub->created_at->format('d M Y') }}
                    </td>
                    <td class="px-4 py-4">
                        <span class="px-2 py-[3px] rounded-md text-[11px] font-medium
                                     badge-{{ strtolower(str_replace(' ', '', $pub->status)) }}">
                            {{ $pub->status }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-right">
                        <a href="{{ route('publications.show', $pub->id) }}"
                           class="text-[12px] text-navy hover:text-gold transition no-underline">
                            Detail →
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($publications->hasPages())
    <div class="px-6 py-4 border-t border-line">
        {{ $publications->links() }}
    </div>
    @endif
    @endif

</div>

@endsection