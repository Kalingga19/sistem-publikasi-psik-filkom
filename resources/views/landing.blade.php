{{-- resources/views/landing.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengajuan Konten Digital - FILKOM UB</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="m-0 font-sans bg-white text-gray-800">

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

            <a
                href="{{ url('/login') }}"
                class="inline-flex items-center justify-center rounded-full bg-[#E8571A] hover:bg-[#cc4a12] transition px-7 py-2.5 text-sm font-semibold text-white"
            >
                Masuk
            </a>

        </div>
    </nav>

    {{-- Hero --}}
    <section
        class="relative overflow-hidden bg-gradient-to-br from-[#003B5C] via-[#0077A2] to-[#00A9C5]"
    >

        {{-- Glow Effect --}}
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-cyan-300/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-20 py-20 lg:py-24">

            <div class="max-w-2xl">
                <h1 class="text-white text-4xl lg:text-5xl font-extrabold leading-tight mb-6">
                    Sistem Pengajuan Konten Digital FILKOM UB
                </h1>

                <p class="text-white/90 text-base leading-7 mb-8 max-w-xl">
                    Platform terpadu untuk mengajukan, mengelola,
                    dan melacak konten digital di Fakultas Ilmu Komputer
                    Universitas Brawijaya.
                </p>

                <a
                    href="{{ url('/login') }}"
                    class="inline-flex items-center justify-center rounded-full bg-[#E8571A] hover:bg-[#cc4a12] transition px-8 py-3.5 text-sm font-semibold text-white shadow-lg"
                >
                    Ajukan Konten Sekarang
                </a>
            </div>

        </div>
    </section>

    {{-- Fitur Unggulan --}}
    <section class="bg-[#E8F0F5] py-16 lg:py-20">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <h2 class="text-center text-3xl font-bold text-[#003B5C] mb-12">
                Fitur Unggulan
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Card 1 --}}
                <div class="bg-white border border-[#C8DCE8] rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition">

                    <div class="w-14 h-14 rounded-full bg-[#1A7AAF] flex items-center justify-center mx-auto mb-5">

                        <svg class="w-6 h-6 fill-white" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM8 13h8v1.5H8V13zm0 3h8v1.5H8V16zm0-6h4v1.5H8V10z"/>
                        </svg>

                    </div>

                    <h3 class="text-[#003B5C] font-bold text-base mb-3">
                        Pengajuan Mudah
                    </h3>

                    <p class="text-sm text-gray-600 leading-6">
                        Form pengajuan yang simpel dan intuitif untuk berbagai jenis konten.
                    </p>

                </div>

                {{-- Card 2 --}}
                <div class="bg-white border border-[#C8DCE8] rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition">

                    <div class="w-14 h-14 rounded-full bg-[#E8571A] flex items-center justify-center mx-auto mb-5">

                        <svg class="w-6 h-6 fill-white" viewBox="0 0 24 24">
                            <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm.5 5v5.25l4.5 2.67-.75 1.23L11 13V7h1.5z"/>
                        </svg>

                    </div>

                    <h3 class="text-[#003B5C] font-bold text-base mb-3">
                        Tracking Real-time
                    </h3>

                    <p class="text-sm text-gray-600 leading-6">
                        Pantau status pengajuan Anda secara real-time.
                    </p>

                </div>

                {{-- Card 3 --}}
                <div class="bg-white border border-[#C8DCE8] rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition">

                    <div class="w-14 h-14 rounded-full bg-[#1A9AAF] flex items-center justify-center mx-auto mb-5">

                        <svg class="w-6 h-6 fill-white" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                        </svg>

                    </div>

                    <h3 class="text-[#003B5C] font-bold text-base mb-3">
                        Approval Cepat
                    </h3>

                    <p class="text-sm text-gray-600 leading-6">
                        Sistem approval yang efisien dan terstruktur.
                    </p>

                </div>

                {{-- Card 4 --}}
                <div class="bg-white border border-[#C8DCE8] rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition">

                    <div class="w-14 h-14 rounded-full bg-[#E8571A] flex items-center justify-center mx-auto mb-5">

                        <svg class="w-6 h-6 fill-white" viewBox="0 0 24 24">
                            <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                        </svg>

                    </div>

                    <h3 class="text-[#003B5C] font-bold text-base mb-3">
                        Kolaborasi Tim
                    </h3>

                    <p class="text-sm text-gray-600 leading-6">
                        Bekerja sama dengan tim dalam satu platform.
                    </p>

                </div>

            </div>

        </div>

    </section>

    {{-- Cara Kerja --}}
    <section class="bg-[#F5F8FA] py-16 lg:py-20">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <h2 class="text-center text-3xl font-bold text-[#0A88C2] mb-12">
                Cara Kerja
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Step 1 --}}
                <div class="bg-white border border-[#C8DCE8] rounded-2xl p-8 shadow-sm hover:shadow-md transition">

                    <div class="w-11 h-11 rounded-full bg-[#003B5C] text-white flex items-center justify-center font-bold text-lg mb-5">
                        1
                    </div>

                    <h3 class="text-[#003B5C] font-bold text-lg mb-3">
                        Masuk
                    </h3>

                    <p class="text-sm text-gray-600 leading-6">
                        Masuk dengan email Universitas Brawijaya Anda.
                    </p>

                </div>

                {{-- Step 2 --}}
                <div class="bg-white border border-[#C8DCE8] rounded-2xl p-8 shadow-sm hover:shadow-md transition">

                    <div class="w-11 h-11 rounded-full bg-[#003B5C] text-white flex items-center justify-center font-bold text-lg mb-5">
                        2
                    </div>

                    <h3 class="text-[#003B5C] font-bold text-lg mb-3">
                        Ajukan Konten
                    </h3>

                    <p class="text-sm text-gray-600 leading-6">
                        Isi form pengajuan dengan detail konten yang ingin diajukan.
                    </p>

                </div>

                {{-- Step 3 --}}
                <div class="bg-white border border-[#C8DCE8] rounded-2xl p-8 shadow-sm hover:shadow-md transition">

                    <div class="w-11 h-11 rounded-full bg-[#003B5C] text-white flex items-center justify-center font-bold text-lg mb-5">
                        3
                    </div>

                    <h3 class="text-[#003B5C] font-bold text-lg mb-3">
                        Pantau Status
                    </h3>

                    <p class="text-sm text-gray-600 leading-6">
                        Lacak progress pengajuan Anda hingga disetujui.
                    </p>

                </div>

            </div>

        </div>

    </section>

    {{-- Footer --}}
    <footer class="bg-[#006A97] text-white py-8">

        <div class="text-center px-4">

            <p class="text-sm opacity-90 mb-1">
                © 2026 Fakultas Ilmu Komputer Universitas Brawijaya
            </p>

            <span class="text-xs opacity-70">
                Sistem Pengajuan Konten Digital
            </span>

        </div>

    </footer>

</body>
</html>