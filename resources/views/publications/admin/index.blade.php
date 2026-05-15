@extends('layouts.app')
@section('title', 'Pengajuan Masuk — Admin PSIK')

@section('content')

<div class="mb-6">
    <p class="text-[11px] font-medium tracking-[0.1em] uppercase text-gold mb-1">Admin</p>
    <h1 class="text-[1.6rem] font-normal text-ink"
        style="font-family:'DM Serif Display',serif;">
        Pengajuan Masuk
    </h1>
</div>

{{-- Filter bar --}}
<form method="GET" class="bg-white rounded-xl border border-line px-5 py-4 mb-5
                           flex flex-wrap gap-3 items-end">
    <div class="flex-1 min-w-[160px]">
        <label class="block text-[11px] text-ink-faint mb-1 uppercase tracking-wide">Cari judul</label>
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Ketik judul..."
               class="w-full h-9 px-3 rounded-lg border border-line bg-surface text-[13px]
                      outline-none focus:border-navy transition">
    </div>
    <div class="min-w-[140px]">
        <label class="block text-[11px] text-ink-faint mb-1 uppercase tracking-wide">Status</label>
        <select name="status"
                class="w-full h-9 px-3 rounded-lg border border-line bg-surface text-[13px]
                       outline-none focus:border-navy transition">
            <option value="">Semua Status</option>
            @foreach(['Menunggu Validasi','Revisi','Disetujui','Ditolak','Dijadwalkan','Dipublikasikan'] as $s)
            <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>
    </div>
    <div class="min-w-[160px]">
        <label class="block text-[11px] text-ink-faint mb-1 uppercase tracking-wide">Jenis Konten</label>
        <select name="jenis_konten"
                class="w-full h-9 px-3 rounded-lg border border-line bg-surface text-[13px]
                       outline-none focus:border-navy transition">
            <option value="">Semua Jenis</option>
            @foreach(['Prestasi Mahasiswa','Kegiatan Organisasi','Berita Akademik','Lainnya'] as $j)
            <option value="{{ $j }}" {{ request('jenis_konten') === $j ? 'selected' : '' }}>{{ $j }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex gap-2">
        <button type="submit"
                class="h-9 px-4 rounded-lg bg-navy text-white text-[13px] font-medium
                       hover:bg-navy-dark transition cursor-pointer border-0">
            Filter
        </button>
        <a href="{{ route('admin.publications.index') }}"
           class="h-9 px-4 rounded-lg border border-line bg-white text-[13px] text-ink-muted
                  hover:text-ink transition no-underline flex items-center">
            Reset
        </a>
    </div>
</form>

{{-- Tabel --}}
<div class="bg-white rounded-xl border border-line">
    @if($publications->isEmpty())
    <div class="py-16 text-center">
        <p class="text-sm text-ink-faint">Tidak ada pengajuan yang ditemukan.</p>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="w-full text-[13px]">
            <thead>
                <tr class="border-b border-line bg-surface">
                    <th class="text-left px-6 py-3 text-[11px] font-medium text-ink-faint uppercase tracking-wide">Judul</th>
                    <th class="text-left px-4 py-3 text-[11px] font-medium text-ink-faint uppercase tracking-wide">Pengaju</th>
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
                        <p class="font-medium text-ink">{{ $pub->judul }}</p>
                        <p class="text-[11px] text-ink-faint mt-[2px]">
                            {{ implode(', ', $pub->media_target) }}
                        </p>
                    </td>
                    <td class="px-4 py-4">
                        <p class="text-ink">{{ $pub->user->name }}</p>
                        <p class="text-[11px] text-ink-faint">{{ $pub->user->nim }}</p>
                    </td>
                    <td class="px-4 py-4 text-ink-muted">{{ $pub->jenis_konten }}</td>
                    <td class="px-4 py-4 text-ink-muted">{{ $pub->created_at->format('d M Y') }}</td>
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
    @if($publications->hasPages())
    <div class="px-6 py-4 border-t border-line">
        {{ $publications->links() }}
    </div>
    @endif
    @endif
</div>

@endsection