{{-- resources/views/admin/dashboard.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - FILKOM UB</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="m-0 font-sans bg-[#F0F4F8] text-gray-800 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-[#006A97] shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto h-16 px-6 lg:px-8 flex items-center justify-between">

            <div class="flex items-center gap-3">
                <img
                    src="{{ asset('img/logo.png') }}"
                    alt="Logo FILKOM"
                    class="w-10 h-10 object-contain"
                >
                <div>
                    <h1 class="text-white text-base font-bold leading-tight">
                        FILKOM UB – Admin Panel
                    </h1>
                    <p class="text-white/80 text-xs">
                        Sistem Pengajuan Konten
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-white/70 text-xs">Selamat datang,</p>
                    <p class="text-white font-semibold text-sm">{{ Auth::user()->name ?? 'Admin' }}</p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        title="Keluar"
                        class="w-9 h-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition text-white"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
                        </svg>
                    </button>
                </form>
            </div>

        </div>
    </nav>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-6 lg:px-8 py-8">

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 rounded-xl px-5 py-4 text-sm">
                <svg class="w-5 h-5 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-xl px-5 py-4 text-sm">
                <svg class="w-5 h-5 flex-shrink-0 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Stat Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

            {{-- Total --}}
            <div class="bg-white border-l-4 border-[#006A97] rounded-2xl p-5 shadow-sm">
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide mb-1">Total Pengajuan</p>
                <p class="text-[#003B5C] text-4xl font-extrabold">{{ $totalPengajuan ?? 0 }}</p>
            </div>

            {{-- Disetujui --}}
            <div class="bg-white border-l-4 border-green-500 rounded-2xl p-5 shadow-sm">
                <p class="text-green-600 text-xs font-medium uppercase tracking-wide mb-1">Disetujui</p>
                <p class="text-green-600 text-4xl font-extrabold">{{ $totalDisetujui ?? 0 }}</p>
            </div>

            {{-- Menunggu Review --}}
            <div class="bg-white border-l-4 border-yellow-500 rounded-2xl p-5 shadow-sm">
                <p class="text-yellow-600 text-xs font-medium uppercase tracking-wide mb-1">Menunggu Review</p>
                <p class="text-yellow-600 text-4xl font-extrabold">{{ $totalMenunggu ?? 0 }}</p>
            </div>

            {{-- Ditolak --}}
            <div class="bg-white border-l-4 border-red-500 rounded-2xl p-5 shadow-sm">
                <p class="text-red-600 text-xs font-medium uppercase tracking-wide mb-1">Ditolak</p>
                <p class="text-red-600 text-4xl font-extrabold">{{ $totalDitolak ?? 0 }}</p>
            </div>

        </div>

        {{-- Search Bar --}}
        <div class="relative mb-6">
            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                </svg>
            </div>
            <form method="GET" action="{{ route('admin.dashboard') }}">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari berdasarkan judul atau pengaju..."
                    class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#006A97]/30 focus:border-[#006A97] shadow-sm transition"
                >
            </form>
        </div>

        {{-- Daftar Pengajuan --}}
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">

            {{-- Table Header --}}
            <div class="bg-[#006A97] px-6 py-4">
                <h2 class="text-white font-bold text-base">Daftar Pengajuan</h2>
            </div>

            {{-- List --}}
            <div class="divide-y divide-gray-100">

                @forelse ($pengajuans ?? [] as $item)

                    <div class="px-6 py-5 hover:bg-gray-50 transition">

                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">

                            {{-- Info Kiri --}}
                            <div class="flex-1 min-w-0">

                                <h3 class="text-[#006A97] font-bold text-sm mb-1 truncate">
                                    {{ $item->judul }}
                                </h3>

                                <p class="text-gray-600 text-sm mb-2 line-clamp-1">
                                    {{ $item->deskripsi }}
                                </p>

                                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-500">
                                    <span>Kategori : {{ $item->kategori }}</span>
                                    <span>Tanggal: {{ \Carbon\Carbon::parse($item->created_at)->format('j/n/Y') }}</span>
                                    <span>ID: #{{ $item->id }}</span>
                                    @if ($item->pengaju)
                                        <span>Pengaju: {{ $item->pengaju->name }}</span>
                                    @endif
                                </div>

                                @if ($item->status === 'perlu_revisi' && $item->catatan)
                                    <p class="mt-2 text-xs text-yellow-700 bg-yellow-50 border border-yellow-200 rounded-lg px-3 py-1.5 inline-block">
                                        Catatan : {{ $item->catatan }}
                                    </p>
                                @endif

                            </div>

                            {{-- Status & Actions Kanan --}}
                            <div class="flex flex-col items-start sm:items-end gap-3 flex-shrink-0">

                                {{-- Status Badge --}}
                                @if ($item->status === 'menunggu')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                        Menunggu Review
                                    </span>
                                @elseif ($item->status === 'disetujui')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Disetujui
                                    </span>
                                @elseif ($item->status === 'ditolak')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700 border border-red-200">
                                        Ditolak
                                    </span>
                                @elseif ($item->status === 'perlu_revisi')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-700 border border-orange-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Perlu Revisi
                                    </span>
                                @endif

                                {{-- Action Buttons (only for menunggu) --}}
                                @if ($item->status === 'menunggu')
                                    <div class="flex items-center gap-2 flex-wrap">

                                        {{-- Setuju --}}
                                        <form method="POST" action="{{ route('admin.pengajuan.setuju', $item->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button
                                                type="submit"
                                                class="px-4 py-2 rounded-lg bg-green-500 hover:bg-green-600 text-white text-xs font-semibold transition"
                                            >
                                                Setuju
                                            </button>
                                        </form>

                                        {{-- Minta Revisi --}}
                                        <button
                                            type="button"
                                            onclick="openRevisiModal({{ $item->id }})"
                                            class="px-4 py-2 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold transition"
                                        >
                                            Minta Revisi
                                        </button>

                                        {{-- Tolak --}}
                                        <form
                                            method="POST"
                                            action="{{ route('admin.pengajuan.tolak', $item->id) }}"
                                            onsubmit="return confirm('Yakin ingin menolak pengajuan ini?')"
                                        >
                                            @csrf
                                            @method('PATCH')
                                            <button
                                                type="submit"
                                                class="px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white text-xs font-semibold transition"
                                            >
                                                Tolak
                                            </button>
                                        </form>

                                    </div>
                                @endif

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-16 text-center">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-gray-400 text-sm">Belum ada pengajuan konten.</p>
                    </div>

                @endforelse

            </div>

            {{-- Pagination --}}
            @if (isset($pengajuans) && $pengajuans->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $pengajuans->withQueryString()->links() }}
                </div>
            @endif

        </div>

    </main>

    {{-- Modal Minta Revisi --}}
    <div
        id="revisiModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm px-4"
    >
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">

            <h3 class="text-[#003B5C] font-bold text-lg mb-1">Minta Revisi</h3>
            <p class="text-gray-500 text-sm mb-5">Tuliskan catatan revisi untuk pengaju.</p>

            <form id="revisiForm" method="POST" action="">
                @csrf
                @method('PATCH')

                <textarea
                    name="catatan"
                    rows="4"
                    required
                    placeholder="Contoh: Ubah judul sesuai dengan kategori yang ada..."
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#006A97]/30 focus:border-[#006A97] resize-none transition mb-5"
                ></textarea>

                <div class="flex justify-end gap-3">
                    <button
                        type="button"
                        onclick="closeRevisiModal()"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 text-sm text-gray-600 hover:bg-gray-50 transition font-medium"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold transition"
                    >
                        Kirim Revisi
                    </button>
                </div>

            </form>

        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-[#006A97] text-white py-6 mt-10">
        <div class="text-center px-4">
            <p class="text-sm opacity-90 mb-1">
                © 2026 Fakultas Ilmu Komputer Universitas Brawijaya
            </p>
            <span class="text-xs opacity-70">Sistem Pengajuan Konten Digital</span>
        </div>
    </footer>

    {{-- Script Modal --}}
    <script>
        const revisiModal = document.getElementById('revisiModal');
        const revisiForm  = document.getElementById('revisiForm');

        function openRevisiModal(id) {
            revisiForm.action = `/admin/pengajuan/${id}/revisi`;
            revisiModal.classList.remove('hidden');
            revisiModal.classList.add('flex');
        }

        function closeRevisiModal() {
            revisiModal.classList.add('hidden');
            revisiModal.classList.remove('flex');
            revisiForm.reset();
        }

        // Tutup modal saat klik backdrop
        revisiModal.addEventListener('click', function (e) {
            if (e.target === revisiModal) closeRevisiModal();
        });
    </script>

</body>
</html>