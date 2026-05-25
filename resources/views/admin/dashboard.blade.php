{{-- resources/views/admin/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel – FILKOM UB</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F0F4F8] min-h-screen text-slate-800">

    {{-- ═════════════════ NAVBAR ═════════════════ --}}
    <nav class="bg-[#006A97] shadow-lg sticky top-0 z-40">
        <div class="max-w-7xl mx-auto h-16 px-6 lg:px-8 flex items-center justify-between">

            <div class="flex items-center gap-3">
                <img src="{{ asset('img/logo.png') }}"
                     alt="Logo FILKOM"
                     class="w-10 h-10 object-contain">

                <div>
                    <h1 class="text-white text-base font-bold leading-tight">
                        FILKOM UB
                    </h1>

                    <p class="text-white/80 text-xs">
                        Sistem Pengajuan Konten
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4">

                <div class="text-right hidden sm:block">
                    <p class="text-white/70 text-xs">
                        Selamat datang,
                    </p>

                    <p class="text-white font-semibold text-sm">
                        {{ Auth::user()->name ?? 'Admin' }}
                    </p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            title="Keluar"
                            class="w-9 h-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition text-white">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
                        </svg>

                    </button>
                </form>

            </div>
        </div>
    </nav>

    {{-- ═════════════════ CONTENT ═════════════════ --}}
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-6">

        {{-- FLASH MESSAGE --}}
        @if (session('success'))
            <div class="flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm mb-5">

                <svg class="w-4 h-4 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>

                {{ session('success') }}

            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-5">
                {{ session('error') }}
            </div>
        @endif

        {{-- ═════════════════ STAT CARDS ═════════════════ --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-5">

            <div class="bg-white rounded-xl border border-slate-200 px-4 py-4 relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-slate-400 rounded-l-xl"></div>

                <p class="text-slate-500 text-xs font-medium mb-1">
                    Total Pengajuan
                </p>

                <p class="text-3xl font-bold text-slate-800">
                    {{ $stats['total'] ?? 0 }}
                </p>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 px-4 py-4 relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-green-500 rounded-l-xl"></div>

                <p class="text-green-600 text-xs font-medium mb-1">
                    Disetujui
                </p>

                <p class="text-3xl font-bold text-green-600">
                    {{ $stats['disetujui'] ?? 0 }}
                </p>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 px-4 py-4 relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-amber-400 rounded-l-xl"></div>

                <p class="text-amber-600 text-xs font-medium mb-1">
                    Menunggu Review
                </p>

                <p class="text-3xl font-bold text-amber-500">
                    {{ $stats['menunggu'] ?? 0 }}
                </p>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 px-4 py-4 relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-red-500 rounded-l-xl"></div>

                <p class="text-red-600 text-xs font-medium mb-1">
                    Ditolak
                </p>

                <p class="text-3xl font-bold text-red-600">
                    {{ $stats['ditolak'] ?? 0 }}
                </p>
            </div>

        </div>

        {{-- SEARCH --}}
        <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-4">

            <div class="relative">

                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
                </svg>

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari berdasarkan judul atau pengaju..."
                       class="w-full bg-white border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 outline-none focus:border-[#006A97] focus:ring-2 focus:ring-[#006A97]/10 transition">

            </div>

        </form>

        {{-- HEADER --}}
        <div class="bg-[#006A97] rounded-t-xl px-5 py-3">
            <h2 class="text-white font-bold text-[15px]">
                Daftar Pengajuan
            </h2>
        </div>

        {{-- LIST --}}
        <div class="bg-white rounded-b-xl border border-t-0 border-slate-200 divide-y divide-slate-100 overflow-hidden">

            @forelse ($recentPublications ?? [] as $item)

                <div class="px-5 py-4">

                    {{-- TITLE --}}
                    <div class="flex items-start justify-between gap-3 mb-1">

                        <div class="flex-1 min-w-0">

                            <h3 class="font-semibold text-[#006A97] text-sm leading-snug truncate">
                                {{ $item->judul }}
                            </h3>

                            <p class="text-slate-500 text-xs mt-0.5 leading-relaxed">
                                {{ $item->deskripsi }}
                            </p>

                        </div>

                        {{-- STATUS --}}
                        <div class="flex-shrink-0 mt-0.5">

                            @if ($item->status === 'Menunggu Validasi')

                                <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 border border-amber-200 text-xs font-medium px-3 py-1 rounded-full">
                                    Menunggu Review
                                </span>

                            @elseif ($item->status === 'Disetujui')

                                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 border border-green-200 text-xs font-medium px-3 py-1 rounded-full">
                                    Disetujui
                                </span>

                            @elseif ($item->status === 'Revisi')

                                <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 border border-amber-200 text-xs font-medium px-3 py-1 rounded-full">
                                    Perlu Revisi
                                </span>

                            @elseif ($item->status === 'Ditolak')

                                <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-700 border border-red-200 text-xs font-medium px-3 py-1 rounded-full">
                                    Ditolak
                                </span>

                            @endif

                        </div>
                    </div>

                    {{-- META --}}
                    <div class="flex items-center gap-3 text-xs text-slate-400 mb-3">

                        <span>
                            Kategori :
                            <span class="text-slate-500">
                                {{ $item->jenis_konten }}
                            </span>
                        </span>

                        <span>
                            Tanggal:
                            <span class="text-slate-500">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d/n/Y') }}
                            </span>
                        </span>

                        <span>
                            ID:
                            <span class="text-slate-500">
                                #{{ $item->id }}
                            </span>
                        </span>

                    </div>

                    {{-- ACTION --}}
                    <div class="flex items-center gap-2 flex-wrap">

                        @if ($item->status === 'Menunggu Validasi')

                            {{-- SETUJU --}}
                            <form method="POST"
                                  action="{{ route('admin.publications.status', $item->id) }}"
                                  class="inline">

                                @csrf

                                <input type="hidden" name="status" value="Disetujui">

                                <button type="submit"
                                        class="bg-green-500 hover:bg-green-600 text-white text-xs font-semibold px-4 py-2 rounded-lg transition">

                                    Setuju

                                </button>

                            </form>

                            {{-- REVISI --}}
                            <a href="{{ route('admin.publications.revisi.form', $item->id) }}"
                               class="bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold px-4 py-2 rounded-lg transition">

                                Minta Revisi

                            </a>

                            {{-- TOLAK --}}
                            <form method="POST"
                                  action="{{ route('admin.publications.status', $item->id) }}"
                                  class="inline"
                                  onsubmit="return confirm('Yakin ingin menolak pengajuan ini?')">

                                @csrf

                                <input type="hidden" name="status" value="Ditolak">

                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-4 py-2 rounded-lg transition">

                                    Tolak

                                </button>

                            </form>

                        @else

                            <button onclick="openModal('modal-{{ $item->id }}')"
                                    class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold px-4 py-2 rounded-lg transition">

                                {{ $item->status === 'Disetujui' ? 'Jadwalkan' : 'Lihat Detail' }}

                            </button>

                        @endif

                    </div>

                </div>

                {{-- ═════════════════ MODAL ═════════════════ --}}
                <div id="modal-{{ $item->id }}"
                     class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center px-4">

                    <div class="bg-white rounded-2xl w-full max-w-2xl shadow-2xl overflow-hidden">

                        {{-- HEADER --}}
                        <div class="bg-[#006A97] px-6 py-4 flex items-center justify-between">

                            <h2 class="text-white font-bold text-lg">
                                Detail Pengajuan
                            </h2>

                            <button onclick="closeModal('modal-{{ $item->id }}')"
                                    class="text-white text-2xl hover:text-red-200">
                                &times;
                            </button>

                        </div>

                        {{-- BODY --}}
                        <div class="p-6 space-y-5 max-h-[80vh] overflow-y-auto">

                            <div>
                                <p class="text-xs text-slate-400 mb-1">Judul</p>

                                <h3 class="font-semibold text-[#006A97]">
                                    {{ $item->judul }}
                                </h3>
                            </div>

                            <div>
                                <p class="text-xs text-slate-400 mb-1">Deskripsi</p>

                                <p class="text-sm text-slate-600 leading-relaxed">
                                    {{ $item->deskripsi }}
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">

                                <div>
                                    <p class="text-xs text-slate-400 mb-1">Kategori</p>

                                    <p class="text-sm font-medium text-slate-700">
                                        {{ $item->jenis_konten }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs text-slate-400 mb-1">Status</p>

                                    <p class="text-sm font-medium text-slate-700">
                                        {{ $item->status }}
                                    </p>
                                </div>

                            </div>

                            {{-- REVISI --}}
                            @if ($item->catatan_revisi)

                                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">

                                    <p class="text-xs font-semibold text-amber-700 mb-1">
                                        Catatan Revisi
                                    </p>

                                    <p class="text-sm text-amber-800">
                                        {{ $item->catatan_revisi }}
                                    </p>

                                </div>

                            @endif

                            {{-- JADWAL --}}
                            @if ($item->status === 'Disetujui')

                                <form method="POST"
                                      action="{{ route('admin.publications.jadwalkan', $item->id) }}"
                                      class="space-y-3">

                                    @csrf

                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">
                                            Jadwal Publikasi
                                        </label>

                                        <input type="date"
                                               name="jadwal_publikasi"
                                               required
                                               class="w-full border border-slate-300 rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-[#006A97]/20 focus:border-[#006A97]">
                                    </div>

                                    <button type="submit"
                                            class="w-full bg-[#006A97] hover:bg-[#00557A] text-white py-3 rounded-xl font-semibold text-sm transition">

                                        Simpan Jadwal

                                    </button>

                                </form>

                            @endif

                        </div>
                    </div>
                </div>

            @empty

                <div class="py-16 text-center">

                    <svg class="w-10 h-10 text-slate-300 mx-auto mb-3"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.5"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>

                    <p class="text-slate-400 text-sm">
                        Tidak ada pengajuan yang ditemukan.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

    {{-- ═════════════════ SCRIPT ═════════════════ --}}
    <script>

        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

    </script>

</body>
</html>