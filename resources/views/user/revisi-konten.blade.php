<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Revisi - FILKOM UB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="m-0 font-sans bg-[#F0F4F8] text-gray-800 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-[#006A97] shadow-lg sticky top-0 z-50">
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
                    <p class="text-white font-semibold text-sm">{{ Auth::user()->name }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Keluar"
                        class="w-9 h-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-6 lg:px-8 py-8">

        <a href="{{ route('user.dashboard') }}"
           class="inline-flex items-center gap-2 text-[#006A97] text-sm mb-6 hover:opacity-80 transition no-underline">
            ← Kembali ke Dashboard
        </a>

        {{-- Alert Banner --}}
        <div class="flex items-start gap-3 bg-yellow-50 border border-yellow-200 rounded-2xl px-5 py-4 mb-5">
            <svg class="w-5 h-5 text-yellow-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4m0 4h.01"/>
            </svg>
            <div>
                <p class="text-sm font-bold text-yellow-700">Pengajuan Anda Perlu Direvisi</p>
                <p class="text-xs text-yellow-600 mt-0.5">Pengajuan konten Anda telah direview dan memerlukan beberapa perbaikan. Silakan baca feedback di bawah dan lakukan revisi sebelum deadline.</p>
            </div>
        </div>

        {{-- Detail Pengajuan --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-5 overflow-hidden">
            <div class="bg-[#006A97] px-6 py-4">
                <h2 class="text-white font-bold text-base">Detail Pengajuan</h2>
            </div>
            <div class="px-6 py-5">
                <p class="text-xs text-gray-400 mb-1">Judul Konten</p>
                <p class="text-[#006A97] font-bold text-base mb-4">{{ $publication->judul }}</p>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Kategori Konten</p>
                        <p class="text-sm text-gray-700">{{ $publication->jenis_konten }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Tanggal Pengajuan</p>
                        <p class="text-sm text-gray-700">{{ $publication->created_at->format('d F Y') }}</p>
                    </div>
                </div>
                @if($publication->deskripsi)
                <div class="mt-4">
                    <p class="text-xs text-gray-400 mb-1">Deskripsi</p>
                    <p class="text-sm text-gray-700">{{ $publication->deskripsi }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Feedback Revisi --}}
        @if($publication->feedback)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-5 overflow-hidden">
            <div class="bg-[#006A97] px-6 py-4">
                <h2 class="text-white font-bold text-base">Feedback Revisi</h2>
            </div>
            <div class="px-6 py-5">

                {{-- Alasan --}}
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="text-sm font-semibold text-gray-700">Alasan Revisi</span>
                </div>
                <div class="bg-yellow-50 border border-yellow-100 rounded-xl px-4 py-3 mb-5">
                    <p class="text-sm text-gray-700">{{ $publication->feedback->alasan }}</p>
                </div>

                {{-- Saran --}}
                @if($publication->feedback->items->isNotEmpty())
                <p class="text-sm font-semibold text-[#006A97] mb-3">Saran Perbaikan</p>
                <div class="flex flex-col gap-2 mb-5">
                    @foreach($publication->feedback->items as $i => $item)
                    <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                        <span class="w-6 h-6 rounded-full bg-[#006A97] text-white text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">
                            {{ $i + 1 }}
                        </span>
                        <p class="text-sm text-gray-700">{{ $item->saran }}</p>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Deadline --}}
                @if($publication->feedback->deadline_revisi)
                <div class="flex items-center gap-2 bg-red-50 border border-red-100 rounded-xl px-4 py-3">
                    <svg class="w-4 h-4 text-red-400 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4m0 4h.01"/>
                    </svg>
                    <span class="text-sm text-gray-500">Deadline Revisi:</span>
                    <span class="text-sm font-bold text-red-500">
                        {{ $publication->feedback->deadline_revisi->format('d F Y') }}
                    </span>
                </div>
                @endif

            </div>
        </div>
        @endif

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('user.dashboard') }}"
               class="flex-1 h-12 flex items-center justify-center rounded-xl border border-gray-300 text-sm font-semibold text-gray-600 hover:bg-gray-50 transition no-underline">
                Lihat Nanti
            </a>
            <a href="{{ route('publications.edit', $publication->id) }}"
               class="flex-1 h-12 flex items-center justify-center rounded-xl bg-[#006A97] hover:bg-[#005580] text-white text-sm font-semibold transition no-underline">
                Perbaiki Sekarang
            </a>
        </div>

    </main>

    <footer class="bg-[#006A97] text-white py-6 mt-10">
        <div class="text-center px-4">
            <p class="text-sm opacity-90 mb-1">© 2026 Fakultas Ilmu Komputer Universitas Brawijaya</p>
            <span class="text-xs opacity-70">Sistem Pengajuan Konten Digital</span>
        </div>
    </footer>

</body>
</html>