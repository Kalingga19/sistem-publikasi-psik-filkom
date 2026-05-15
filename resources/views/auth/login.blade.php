<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — PSIK Vokasi UB</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'serif-display': ['"DM Serif Display"', 'serif'],
                        'sans': ['"DM Sans"', 'sans-serif'],
                    },
                    colors: {
                        navy: {
                            DEFAULT: '#253465',
                            dark:    '#1b2649',
                            light:   '#2d3f6b',
                        },
                        gold: {
                            DEFAULT: '#f5a623',
                            light:   '#fdb944',
                            muted:   '#fff4e0',
                        },
                        ink: {
                            DEFAULT: '#1e2a45',
                            muted:   '#5a677f',
                            faint:   '#a8b3c4',
                        },
                        line:    '#dde3ed',
                        surface: '#f7f8fb',
                    },
                    boxShadow: {
                        'focus-navy': '0 0 0 3px rgba(37,52,101,0.1)',
                    },
                }
            }
        }
    </script>
    <style>
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 40px #ffffff inset !important;
            -webkit-text-fill-color: #1e2a45 !important;
        }
        /* Dekoratif lingkaran panel kiri */
        .panel-left::before {
            content: '';
            position: absolute;
            top: -100px; right: -100px;
            width: 360px; height: 360px;
            border: 1px solid rgba(245,166,35,0.12);
            border-radius: 50%;
        }
        .panel-left::after {
            content: '';
            position: absolute;
            bottom: -140px; left: -60px;
            width: 300px; height: 300px;
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 50%;
        }
        /* Transisi opacity alert */
        .alert-fade { transition: opacity 0.5s; }
    </style>
</head>
<body class="min-h-screen grid grid-cols-2 md:grid-cols-2 bg-surface font-sans text-ink" style="font-family:'DM Sans',sans-serif;">

    <!-- ── Panel Kiri ── -->
    <aside class="panel-left relative hidden md:flex flex-col justify-between bg-[#253465] text-white overflow-hidden px-14 py-12">

        <!-- Gold bar atas -->
        <div class="absolute top-0 left-0 right-0 h-[3px] bg-gold"></div>

        <!-- Brand -->
        <div class="flex items-center gap-[14px]">
            <img src="{{ asset('img/logo.png') }}"
                 class="w-[52px] h-[52px] object-contain brightness-0 invert"
                 alt="Vokasi UB">
            <div>
                <div class="font-serif-display text-[15px] tracking-[0.02em] text-white"
                     style="font-family:'DM Serif Display',serif;">
                    PSIK · Vokasi UB
                </div>
                <div class="text-[11px] font-light text-white/50 tracking-[0.04em] mt-[1px]">
                    Universitas Brawijaya
                </div>
            </div>
        </div>

        <!-- Headline -->
        <div class="relative z-10">
            <h1 class="font-serif-display text-[clamp(2.2rem,3vw,2.9rem)] leading-[1.18] font-normal mb-5 text-white"
                style="font-family:'DM Serif Display',serif;">
                Sistem Informasi<br>
                <em class="italic text-[#fdb944]">Peminjaman &amp;</em><br>
                Layanan
            </h1>
            <p class="text-sm leading-[1.7] text-white/50 max-w-[300px] font-light">
                Kelola peminjaman alat, studio, dan kemitraan media dari satu platform yang terintegrasi.
            </p>
        </div>

        <!-- Feature list -->
        <div class="relative z-10 flex flex-col gap-[9px]">
            @foreach(['Peminjaman peralatan','Reservasi studio','Manajemen media partner','Tracking status real-time'] as $f)
            <div class="flex items-center gap-[10px] text-[13px] text-white/50 font-light">
                <span class="w-[5px] h-[5px] rounded-full bg-gold opacity-60 shrink-0"></span>
                {{ $f }}
            </div>
            @endforeach
        </div>
    </aside>

    <!-- ── Panel Kanan ── -->
    <main class="flex items-center justify-center p-8 md:p-8 pt-20 md:pt-8 bg-surface col-span-2 md:col-span-1">
        <div class="w-full max-w-[380px]">

            <!-- Header form -->
            <div class="mb-10">
                <p class="text-[11px] font-medium tracking-[0.12em] uppercase text-gold mb-2">PSIK</p>
                <h2 class="font-serif-display text-[1.9rem] font-normal text-ink leading-[1.2]"
                    style="font-family:'DM Serif Display',serif;">
                    Selamat datang
                </h2>
            </div>

            <!-- Alert sukses -->
            @if(session('success'))
            <div id="success-alert"
                 class="alert-fade flex items-start gap-2 rounded-lg px-[14px] py-[10px] text-[13px] mb-5 bg-[#f0faf5] text-[#1a7a4a] border border-[#b6e4cc]">
                <svg class="w-4 h-4 shrink-0 mt-[1px]" fill="none" stroke="currentColor" stroke-width="1.5"
                     stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M20 6L9 17l-5-5"/>
                </svg>
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                    const el = document.getElementById('success-alert');
                    if (el) el.style.opacity = '0';
                }, 3000);
            </script>
            @endif

            <!-- Alert error -->
            @if(session('error'))
            <div class="flex items-start gap-2 rounded-lg px-[14px] py-[10px] text-[13px] mb-5 bg-[#fdf3f2] text-[#c0392b] border border-[#f5c2be]">
                <svg class="w-4 h-4 shrink-0 mt-[1px]" fill="none" stroke="currentColor" stroke-width="1.5"
                     stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 8v4m0 4h.01"/>
                </svg>
                {{ session('error') }}
            </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email"
                           class="block text-[12px] font-medium text-ink-muted mb-[5px] tracking-[0.01em]">
                        Email
                    </label>
                    <div class="relative">
                        <input type="email" id="email" name="email"
                               placeholder="nama@student.ub.ac.id"
                               required autocomplete="email"
                               class="w-full h-11 px-[14px] pr-10 rounded-lg border border-line bg-white
                                      text-sm text-ink placeholder-ink-faint outline-none
                                      transition duration-150
                                      focus:border-[#2d3f6b] focus:shadow-focus-navy">
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password"
                           class="block text-[12px] font-medium text-ink-muted mb-[5px] tracking-[0.01em]">
                        Kata sandi
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                               placeholder="••••••••"
                               required autocomplete="current-password"
                               class="w-full h-11 px-[14px] pr-10 rounded-lg border border-line bg-white
                                      text-sm text-ink placeholder-ink-faint outline-none
                                      transition duration-150
                                      focus:border-[#2d3f6b] focus:shadow-focus-navy">
                        <button type="button"
                                onclick="togglePwd()"
                                aria-label="Tampilkan sandi"
                                class="absolute right-3 top-1/2 -translate-y-1/2 flex items-center
                                       text-ink-faint hover:text-ink-muted transition duration-150 bg-transparent border-0 cursor-pointer p-[2px]">
                            <svg id="ico-eye" class="w-4 h-4"
                                 fill="none" stroke="currentColor" stroke-width="1.5"
                                 stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Tombol submit -->
                <button type="submit"
                        class="relative w-full h-[46px] mt-6 overflow-hidden rounded-lg
                               bg-navy text-white text-sm font-medium tracking-[0.01em]
                               transition duration-150 hover:bg-navy-dark active:scale-[0.99] cursor-pointer
                               border-0">
                    Masuk
                    <!-- Gold underbar -->
                    <span class="absolute bottom-0 left-0 right-0 h-[2.5px] bg-gold"></span>
                </button>
            </form>

            <!-- Footer form -->
            <p class="mt-7 text-center text-[13px] text-ink-faint">
                Belum punya akun?
                <a href="{{ route('auth.register') }}"
                   class="text-navy font-medium no-underline hover:text-gold transition duration-150">
                    Daftar sekarang
                </a>
            </p>

        </div>
    </main>

    <script>
        function togglePwd() {
            const inp = document.getElementById('password');
            const ico = document.getElementById('ico-eye');
            if (inp.type === 'password') {
                inp.type = 'text';
                ico.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>';
            } else {
                inp.type = 'password';
                ico.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
            }
        }
    </script>
</body>
</html>