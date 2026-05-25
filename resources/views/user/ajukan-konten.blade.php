<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Konten - FILKOM UB</title>
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

        {{-- Header Card --}}
        <div class="bg-[#006A97] rounded-t-2xl px-6 py-5">
            <h1 class="text-white text-xl font-bold">Buat Pengajuan Konten Baru</h1>
            <p class="text-white/70 text-sm mt-1">Lengkapi formulir di bawah untuk mengajukan konten digital</p>
        </div>

        <div class="bg-white rounded-b-2xl shadow-sm border border-gray-100 border-t-0 px-6 py-6">

            @if($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-xl px-5 py-4 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('publications.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Judul --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-[#006A97] mb-1.5">
                        Judul Konten <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" value="{{ old('judul') }}"
                        placeholder="Contoh: Poster Event Webinar AI 2026"
                        class="w-full h-12 rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#006A97]/30 focus:border-[#006A97] transition
                        {{ $errors->has('judul') ? 'border-red-400 bg-red-50' : '' }}">
                </div>

                {{-- Kategori + Tanggal --}}
                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block text-sm font-semibold text-[#006A97] mb-1.5">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis_konten"
                            class="w-full h-12 rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#006A97]/30 focus:border-[#006A97] transition
                            {{ $errors->has('jenis_konten') ? 'border-red-400' : '' }}">
                            <option value="" disabled {{ old('jenis_konten') ? '' : 'selected' }}>Pilih kategori</option>
                            @foreach(['Prestasi Mahasiswa', 'Kegiatan Organisasi', 'Berita Akademik', 'Lainnya'] as $k)
                            <option value="{{ $k }}" {{ old('jenis_konten') === $k ? 'selected' : '' }}>{{ $k }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-[#006A97] mb-1.5">
                            Tanggal Acara <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}"
                            class="w-full h-12 rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#006A97]/30 focus:border-[#006A97] transition
                            {{ $errors->has('tanggal_kegiatan') ? 'border-red-400' : '' }}">
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-[#006A97] mb-1.5">
                        Deskripsi Konten <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi" rows="4"
                        placeholder="Jelaskan secara detail mengenai konten yang akan dibuat, tujuan, dan pesan yang ingin disampaikan..."
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#006A97]/30 focus:border-[#006A97] transition resize-none
                        {{ $errors->has('deskripsi') ? 'border-red-400 bg-red-50' : '' }}">{{ old('deskripsi') }}</textarea>
                </div>

                {{-- Upload File --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-[#006A97] mb-1.5">Upload File Pendukung</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-[#006A97]/50 transition cursor-pointer"
                         onclick="document.getElementById('file-input').click()">
                        <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="text-sm text-gray-500">Drag & drop file atau klik untuk upload</p>
                        <p class="text-xs text-gray-400 mt-1">Dokumen, gambar, atau referensi (Max 10MB)</p>
                        <button type="button"
                            class="mt-3 px-4 py-2 rounded-lg bg-[#006A97] text-white text-xs font-semibold hover:bg-[#005580] transition">
                            Pilih File
                        </button>
                    </div>
                    <input type="file" id="file-input" name="lampiran[]"
                           multiple accept=".pdf,.jpg,.jpeg,.png" class="hidden"
                           onchange="updateFileList(this)">
                    <div id="file-list" class="mt-2 flex flex-col gap-2"></div>
                </div>

                {{-- Catatan Tambahan --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-[#006A97] mb-1.5">Catatan Tambahan</label>
                    <textarea name="catatan_tambahan" rows="3"
                        placeholder="Ada pesan khusus untuk kurator? Tuliskan di sini."
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#006A97]/30 focus:border-[#006A97] transition resize-none">{{ old('catatan_tambahan') }}</textarea>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('user.dashboard') }}"
                       class="flex-1 h-12 flex items-center justify-center rounded-xl border border-gray-300 text-sm font-semibold text-gray-600 hover:bg-gray-50 transition no-underline">
                        Urungkan
                    </a>
                    <button type="submit"
                        class="flex-1 h-12 rounded-xl bg-[#006A97] hover:bg-[#005580] text-white text-sm font-semibold transition shadow">
                        Kirim Pengajuan
                    </button>
                </div>

            </form>
        </div>

    </main>

    <footer class="bg-[#006A97] text-white py-6 mt-10">
        <div class="text-center px-4">
            <p class="text-sm opacity-90 mb-1">© 2026 Fakultas Ilmu Komputer Universitas Brawijaya</p>
            <span class="text-xs opacity-70">Sistem Pengajuan Konten Digital</span>
        </div>
    </footer>

    <script>
    function updateFileList(input) {
        const container = document.getElementById('file-list');
        container.innerHTML = '';
        Array.from(input.files).forEach(file => {
            const sizeKB = (file.size / 1024).toFixed(0);
            container.innerHTML += `
                <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-sm">
                    <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                    </svg>
                    <span class="flex-1 truncate text-gray-700">${file.name}</span>
                    <span class="text-gray-400 text-xs">${sizeKB} KB</span>
                </div>`;
        });
    }
    </script>

</body>
</html>