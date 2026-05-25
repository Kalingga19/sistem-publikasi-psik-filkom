I{{-- resources/views/admin/form-revisi.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Revisi - FILKOM UB</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#DCEAF2] text-slate-900 min-h-screen">

    {{-- NAVBAR --}}
    <nav class="bg-[#006699] h-[72px] flex items-center justify-between px-8">

        <div class="flex items-center gap-4">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-[52px]">

            <div>
                <h1 class="text-white text-[22px] font-bold leading-tight">FILKOM UB – Admin Panel</h1>
                <p class="text-white/90 text-[15px]">Sistem Pengajuan Konten</p>
            </div>
        </div>

        <div class="flex items-center gap-4 text-white">
            <div class="text-right">
                <p class="text-sm text-white/80">Selamat datang,</p>
                <p class="text-base font-bold">{{ Auth::user()->name }}</p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-white hover:text-white/70 transition text-xl">
                    &#x2192;
                </button>
            </form>
        </div>

    </nav>

    {{-- CONTENT --}}
    <div class="max-w-[900px] mx-auto mt-10 px-6 pb-16">

        {{-- Back Link --}}
        <a href="{{ route('admin.dashboard') }}"
           class="inline-flex items-center gap-2 text-[#006699] font-semibold mb-6 hover:underline text-sm">
            &#x2190; Kembali ke Dashboard
        </a>

        {{-- Card --}}
        <div class="bg-white rounded-3xl overflow-hidden shadow-sm">

            {{-- Card Header --}}
            <div class="bg-[#006699] text-white px-8 py-7">
                <h2 class="text-2xl font-bold mb-1">Form Permintaan Revisi</h2>
                <p class="text-white/90 text-sm">Berikan feedback detail kepada mahasiswa</p>
            </div>

            {{-- Card Body --}}
            <div class="px-8 py-8">

                {{-- Publication Info --}}
                <div class="mb-7">
                    <p class="text-slate-500 text-sm mb-2">
                        ID Pengajuan:
                        <span class="bg-[#003B6B] text-white text-xs font-bold px-2.5 py-0.5 rounded-lg ml-1">
                            #{{ $publication->id }}
                        </span>
                    </p>

                    <h3 class="text-[#003B6B] text-2xl font-bold mt-2 mb-1">
                        {{ $publication->judul }}
                    </h3>

                    <p class="text-slate-500 text-sm mb-3">
                        {{ $publication->deskripsi }}
                    </p>

                    <div class="flex gap-4 text-slate-600 text-sm">
                        <span>Tipe: <strong>{{ $publication->jenis_konten }}</strong></span>
                        <span>Pengaju: <strong>{{ $publication->user->name }}</strong></span>
                    </div>
                </div>

                <hr class="border-slate-200 mb-7">

                {{-- Form --}}
                <form method="POST"
                      action="{{ route('admin.publications.revisi.submit', $publication->id) }}">
                    @csrf

                    {{-- Alasan Revisi --}}
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-[#003B6B] mb-2">
                            Alasan Revisi <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            name="catatan_revisi"
                            rows="4"
                            placeholder="Jelaskan secara umum mengapa konten ini perlu direvisi. Berikan penjelasan yang jelas dan konstruktif..."
                            required
                            class="w-full border-2 border-slate-200 rounded-xl px-4 py-3 text-sm font-[inherit] outline-none resize-none focus:border-[#006699] transition placeholder-slate-400">{{ old('catatan_revisi') }}</textarea>
                    </div>

                    {{-- Saran Perbaikan --}}
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-[#003B6B] mb-2">
                            Saran Perbaikan <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            name="saran_perbaikan"
                            rows="4"
                            placeholder="Berikan saran spesifik yang dapat ditindaklanjuti oleh mahasiswa. Minimal 1 saran perbaikan."
                            required
                            class="w-full border-2 border-slate-200 rounded-xl px-4 py-3 text-sm font-[inherit] outline-none resize-none focus:border-[#006699] transition placeholder-slate-400">{{ old('saran_perbaikan') }}</textarea>
                    </div>

                    {{-- Tenggat Waktu Revisi --}}
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-[#003B6B] mb-2">
                            Tenggat Waktu Revisi <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="date"
                            name="deadline_revisi"
                            required
                            class="w-full border-2 border-slate-200 rounded-xl px-4 py-3 text-sm font-[inherit] outline-none focus:border-[#006699] transition text-slate-500">
                    </div>

                    {{-- Buttons --}}
                    <div class="grid grid-cols-2 gap-4 mt-2">

                        <a href="{{ route('admin.dashboard') }}" class="block">
                            <button type="button"
                                    class="w-full h-12 rounded-xl text-sm font-bold border-2 border-[#0EA5E9] text-[#0284C7] bg-white hover:bg-sky-50 transition cursor-pointer">
                                Batal
                            </button>
                        </a>

                        <button type="submit"
                                class="h-12 rounded-xl text-sm font-bold bg-[#0284C7] text-white hover:bg-[#0369A1] transition cursor-pointer">
                            Simpan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</body>
</html>