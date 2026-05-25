{{-- resources/views/admin/show-publikasi.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengajuan - FILKOM UB</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-[#F0F4F8] min-h-screen text-slate-800">

    {{-- ═══════════ NAVBAR ═══════════ --}}
    <nav class="bg-[#006A97] shadow-lg sticky top-0 z-40">
        <div class="max-w-7xl mx-auto h-16 px-6 lg:px-8 flex items-center justify-between">

            <div class="flex items-center gap-3">
                <img src="{{ asset('img/logo.png') }}" alt="Logo FILKOM" class="w-10 h-10 object-contain">
                <div>
                    <h1 class="text-white text-base font-bold leading-tight">FILKOM UB</h1>
                    <p class="text-white/80 text-xs">Sistem Pengajuan Konten</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-white/70 text-xs">Selamat datang,</p>
                    <p class="text-white font-semibold text-sm">{{ Auth::user()->name ?? 'Admin' }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Keluar"
                            class="w-9 h-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
                        </svg>
                    </button>
                </form>
            </div>

        </div>
    </nav>

    {{-- ═══════════ CONTENT ═══════════ --}}
    <div class="max-w-4xl mx-auto px-6 lg:px-8 py-6">

        {{-- FLASH --}}
        @if (session('success'))
            <div class="flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm mb-5">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-5">
                {{ session('error') }}
            </div>
        @endif

        {{-- BACK --}}
        <a href="{{ route('admin.dashboard') }}"
           class="inline-flex items-center gap-2 text-slate-500 hover:text-[#006A97] text-sm font-medium mb-5 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Dashboard
        </a>

        {{-- CARD UTAMA --}}
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">

            {{-- HEADER --}}
            <div class="bg-[#006A97] px-6 py-4 flex items-center justify-between">
                <div>
                    <h2 class="text-white font-bold text-lg">Detail Pengajuan</h2>
                    <p class="text-white/70 text-xs mt-0.5">ID #{{ $publication->id }}</p>
                </div>

                {{-- STATUS BADGE --}}
                @php
                    $badgeClass = match($publication->status) {
                        'Menunggu Validasi' => 'bg-amber-100 text-amber-700 border-amber-300',
                        'Disetujui'         => 'bg-green-100 text-green-700 border-green-300',
                        'Revisi'            => 'bg-orange-100 text-orange-700 border-orange-300',
                        'Ditolak'           => 'bg-red-100 text-red-700 border-red-300',
                        'Dijadwalkan'       => 'bg-blue-100 text-blue-700 border-blue-300',
                        default             => 'bg-slate-100 text-slate-700 border-slate-300',
                    };
                    $statusLabel = match($publication->status) {
                        'Menunggu Validasi' => 'Menunggu Review',
                        default             => $publication->status,
                    };
                @endphp
                <span class="inline-flex items-center border text-xs font-semibold px-3 py-1 rounded-full {{ $badgeClass }}">
                    {{ $statusLabel }}
                </span>
            </div>

            <div class="p-6 space-y-6">

                {{-- INFO PENGAJU --}}
                <div class="bg-slate-50 rounded-xl p-4 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-[#006A97]/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-[#006A97]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Diajukan oleh</p>
                        <p class="text-sm font-semibold text-slate-700">{{ $publication->user->name ?? '-' }}</p>
                        <p class="text-xs text-slate-400">{{ $publication->user->email ?? '' }}</p>
                    </div>
                    <div class="ml-auto text-right">
                        <p class="text-xs text-slate-400">Tanggal Pengajuan</p>
                        <p class="text-sm font-medium text-slate-600">
                            {{ \Carbon\Carbon::parse($publication->created_at)->format('d M Y') }}
                        </p>
                    </div>
                </div>

                {{-- JUDUL --}}
                <div>
                    <p class="text-xs text-slate-400 mb-1">Judul Konten</p>
                    <h3 class="text-lg font-bold text-[#006A97]">{{ $publication->judul }}</h3>
                </div>

                {{-- GRID INFO --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-xs text-slate-400 mb-1">Kategori</p>
                        <p class="text-sm font-semibold text-slate-700">{{ $publication->jenis_konten }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-xs text-slate-400 mb-1">Tanggal Kegiatan</p>
                        <p class="text-sm font-semibold text-slate-700">
                            {{ $publication->tanggal_kegiatan
                                ? \Carbon\Carbon::parse($publication->tanggal_kegiatan)->format('d M Y')
                                : '-' }}
                        </p>
                    </div>
                    @if ($publication->jadwal_publikasi)
                        <div class="bg-blue-50 rounded-xl p-3">
                            <p class="text-xs text-blue-400 mb-1">Jadwal Publikasi</p>
                            <p class="text-sm font-semibold text-blue-700">
                                {{ \Carbon\Carbon::parse($publication->jadwal_publikasi)->format('d M Y') }}
                            </p>
                        </div>
                    @endif
                </div>

                {{-- DESKRIPSI --}}
                <div>
                    <p class="text-xs text-slate-400 mb-2">Deskripsi</p>
                    <div class="bg-slate-50 rounded-xl p-4">
                        <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">{{ $publication->deskripsi }}</p>
                    </div>
                </div>

                {{-- CATATAN REVISI --}}
                @if ($publication->catatan_revisi)
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                            </svg>
                            <p class="text-xs font-bold text-amber-700">Catatan Revisi</p>
                        </div>
                        <p class="text-sm text-amber-800 leading-relaxed">{{ $publication->catatan_revisi }}</p>
                    </div>
                @endif

                {{-- LAMPIRAN --}}
                @if ($publication->attachments && $publication->attachments->count() > 0)
                    <div>
                        <p class="text-xs text-slate-400 mb-2">
                            Lampiran ({{ $publication->attachments->count() }} file)
                        </p>
                        <div class="space-y-2">
                            @foreach ($publication->attachments as $attachment)
                                <div class="flex items-center justify-between bg-slate-50 border border-slate-200 rounded-xl px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        {{-- ICON berdasarkan tipe file --}}
                                        @if (in_array($attachment->tipe_file, ['jpg', 'jpeg', 'png']))
                                            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @else
                                            <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                        @endif

                                        <div>
                                            <p class="text-sm font-medium text-slate-700 truncate max-w-xs">
                                                {{ $attachment->nama_file }}
                                            </p>
                                            <p class="text-xs text-slate-400 uppercase">{{ $attachment->tipe_file }}</p>
                                        </div>
                                    </div>

                                    <a href="{{ route('admin.publications.attachment.download', $attachment->id) }}"
                                       class="flex items-center gap-1.5 text-xs font-semibold text-[#006A97] hover:text-[#00557A] transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-slate-50 rounded-xl px-4 py-3 text-sm text-slate-400 text-center">
                        Tidak ada lampiran
                    </div>
                @endif

                {{-- ═══════════ ACTION BUTTONS ═══════════ --}}
                @if ($publication->status === 'Menunggu Validasi')
                    <div class="border-t border-slate-100 pt-5">
                        <p class="text-xs text-slate-400 mb-3 font-medium">Tindakan</p>
                        <div class="flex items-center gap-3 flex-wrap">

                            {{-- SETUJU --}}
                            <form method="POST"
                                  action="{{ route('admin.publications.status', $publication->id) }}"
                                  class="inline"
                                  onsubmit="return confirm('Setujui pengajuan ini?')">
                                @csrf
                                <input type="hidden" name="status" value="Disetujui">
                                <button type="submit"
                                        class="bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">
                                    Setujui
                                </button>
                            </form>

                            {{-- REVISI --}}
                            <a href="{{ route('admin.publications.revisi.form', $publication->id) }}"
                               class="bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">
                                Revisi Konten
                            </a>

                            {{-- TOLAK --}}
                            <form method="POST"
                                  action="{{ route('admin.publications.status', $publication->id) }}"
                                  class="inline"
                                  onsubmit="return confirm('Yakin ingin menolak pengajuan ini?')">
                                @csrf
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">
                                    Tolak
                                </button>
                            </form>

                        </div>
                    </div>

                @elseif ($publication->status === 'Disetujui')
                    <div class="border-t border-slate-100 pt-5">
                        <p class="text-xs text-slate-400 mb-3 font-medium">Jadwalkan Publikasi</p>
                        <form method="POST"
                              action="{{ route('admin.publications.jadwalkan', $publication->id) }}"
                              class="flex items-end gap-3 flex-wrap">
                            @csrf
                            <div class="flex-1 min-w-[200px]">
                                <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Publikasi</label>
                                <input type="date"
                                       name="jadwal_publikasi"
                                       required
                                       min="{{ date('Y-m-d') }}"
                                       class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-[#006A97]/20 focus:border-[#006A97] transition">
                            </div>
                            <button type="submit"
                                    class="bg-[#006A97] hover:bg-[#00557A] text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition">
                                Simpan Jadwal
                            </button>
                        </form>
                    </div>
                @endif

            </div>
        </div>

    </div>

</body>
</html>