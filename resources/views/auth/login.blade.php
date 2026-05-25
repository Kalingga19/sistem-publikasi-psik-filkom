{{-- resources/views/auth/login.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pengajuan Konten</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background:
                radial-gradient(circle at bottom, rgba(0,255,255,0.25), transparent 35%),
                linear-gradient(135deg, #003B5C 0%, #0077A2 60%, #00A9C5 100%);
        }
    </style>
</head>

<body class="min-h-screen font-sans text-white">

    {{-- Navbar --}}
    <nav class="bg-[#006A97] shadow-lg">
        <div class="max-w-7xl mx-auto h-16 px-6 lg:px-8 flex items-center justify-between">

            <div class="flex items-center gap-3">
                <img
                    src="{{ asset('img/logo.png') }}"
                    alt="Logo FILKOM"
                    class="w-10 h-10 object-contain"
                >

                <div>
                    <h1 class="text-white text-base font-bold leading-tight">
                        FILKOM UB
                    </h1>

                    <p class="text-white/80 text-sm">
                        Sistem Pengajuan Konten
                    </p>
                </div>
            </div>

        </div>
    </nav>

    {{-- Content --}}
    <div class="max-w-4xl mx-auto px-8 pt-6">

        {{-- Back --}}
        <a
            href="{{ url('/') }}"
            class="inline-flex items-center gap-2 text-white text-sm mb-8 hover:opacity-80 transition"
        >
            ← Kembali
        </a>

        {{-- Card --}}
        <div class="bg-white/10 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden">

            <div class="bg-[#F0F4F8] rounded-2xl">

                <form method="POST" action="{{ url('/login') }}" class="p-10">
                    @csrf

                    {{-- Title --}}
                    <div class="mb-8 text-center">
                        <h2 class="text-2xl font-bold text-[#003B5C] mb-2">
                            Selamat Datang
                        </h2>

                        <p class="text-sm text-gray-600">
                            Masuk ke sistem pengajuan konten digital FILKOM UB
                        </p>
                    </div>

                    {{-- Email --}}
                    <div class="mb-6">
                        <label class="block text-[#0A88C2] text-sm font-semibold mb-2">
                            Email atau NIM
                        </label>

                        <input
                            type="text"
                            name="email"
                            placeholder="Email atau NIM"
                            class="w-full h-12 rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400"
                        >
                    </div>

                    {{-- Password --}}
                    <div class="mb-10">
                        <label class="block text-[#0A88C2] text-sm font-semibold mb-2">
                            Kata Sandi
                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Kata Sandi"
                            class="w-full h-12 rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400"
                        >
                    </div>

                    {{-- Button --}}
                    <button
                        type="submit"
                        class="w-full h-12 rounded-xl bg-[#0A88C2] hover:bg-[#0875a6] transition text-white text-base font-semibold shadow"
                    >
                        Masuk
                    </button>

                    {{-- Register --}}
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Belum memiliki akun?

                            <a
                                href="{{ url('/register') }}"
                                class="text-[#0A88C2] font-semibold hover:underline"
                            >
                                Daftar sekarang
                            </a>
                        </p>
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>
</html>