<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — PSIK Vokasi UB</title>
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
                }
            }
        }
    </script>
    <style>
        /* Pseudo-element dekoratif — tidak bisa murni Tailwind */
        .panel-left::before {
            content: '';
            position: absolute;
            top: -100px; right: -100px;
            width: 360px; height: 360px;
            border: 1px solid rgba(245,166,35,0.12);
            border-radius: 50%;
        }
        /* Autofill override */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 40px #ffffff inset !important;
            -webkit-text-fill-color: #1e2a45 !important;
        }
    </style>
</head>
<body class="min-h-screen grid grid-cols-1 md:grid-cols-2 bg-surface font-sans text-ink" style="font-family:'DM Sans',sans-serif;">

    <!-- ── Panel Kiri ── -->
    <aside class="panel-left relative hidden md:flex flex-col justify-between bg-navy text-white overflow-hidden px-14 py-12">

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
            <h1 class="text-[clamp(2.2rem,3vw,2.9rem)] leading-[1.18] font-normal mb-5 text-white"
                style="font-family:'DM Serif Display',serif;">
                Bergabung<br>
                <em class="italic text-gold-light">dengan</em><br>
                PSIK
            </h1>
            <p class="text-sm leading-[1.7] text-white/50 max-w-[300px] font-light">
                Daftarkan diri Anda untuk mengakses layanan peminjaman dan fasilitas PSIK Vokasi UB.
            </p>
        </div>

        <!-- Steps -->
        <div class="relative z-10 flex flex-col gap-5">
            @foreach([
                ['01', 'Buat akun',           'Isi data diri dengan NIM dan email kampus'],
                ['02', 'Ajukan peminjaman',    'Pilih alat atau studio yang dibutuhkan'],
                ['03', 'Pantau status',        'Terima konfirmasi dan lacak status secara langsung'],
            ] as [$num, $title, $desc])
            <div class="flex gap-[14px] items-start">
                <span class="shrink-0 w-5 pt-[2px] text-[11px] text-gold opacity-60"
                      style="font-family:'DM Serif Display',serif;">
                    {{ $num }}
                </span>
                <div>
                    <h4 class="text-[13px] font-medium text-white/75 mb-[2px]">{{ $title }}</h4>
                    <p class="text-[12px] text-white/35 font-light leading-[1.5]">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </aside>

    <!-- ── Panel Kanan ── -->
    <main class="flex items-center justify-center p-8 pt-20 md:pt-8 bg-surface">
        <div class="w-full max-w-[380px]">

            <!-- Header form -->
            <div class="mb-8">
                <p class="text-[11px] font-medium tracking-[0.12em] uppercase text-gold mb-2">Pendaftaran</p>
                <h2 class="text-[1.9rem] font-normal text-ink leading-[1.2]"
                    style="font-family:'DM Serif Display',serif;">
                    Buat akun baru
                </h2>
            </div>

            <form method="POST" action="{{ route('register.process') }}">
                @csrf

                <!-- Nama lengkap -->
                <div class="mb-[0.9rem]">
                    <label for="name" class="block text-[12px] font-medium text-ink-muted mb-[5px] tracking-[0.01em]">
                        Nama lengkap
                    </label>
                    <input type="text" id="name" name="name"
                           placeholder="Masukkan nama lengkap"
                           required autocomplete="off"
                           class="w-full h-11 px-3 rounded-lg border border-line bg-white
                                  text-sm text-ink placeholder-ink-faint outline-none
                                  transition duration-150
                                  focus:border-navy-light focus:shadow-[0_0_0_3px_rgba(37,52,101,0.1)]">
                </div>

                <!-- NIM -->
                <div class="mb-[0.9rem]">
                    <label for="nim" class="block text-[12px] font-medium text-ink-muted mb-[5px] tracking-[0.01em]">
                        NIM
                    </label>
                    <input type="text" id="nim" name="nim"
                           placeholder="Nomor Induk Mahasiswa"
                           required autocomplete="off" inputmode="numeric" pattern="[0-9]*"
                           class="w-full h-11 px-3 rounded-lg border border-line bg-white
                                  text-sm text-ink placeholder-ink-faint outline-none
                                  transition duration-150
                                  focus:border-navy-light focus:shadow-[0_0_0_3px_rgba(37,52,101,0.1)]">
                    @error('nim')
                    <p class="text-[12px] text-[#c0392b] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-[0.9rem]">
                    <label for="email" class="block text-[12px] font-medium text-ink-muted mb-[5px] tracking-[0.01em]">
                        Email
                    </label>
                    <input type="email" id="email" name="email"
                           placeholder="nama@student.ub.ac.id"
                           required autocomplete="off"
                           class="w-full h-11 px-3 rounded-lg border border-line bg-white
                                  text-sm text-ink placeholder-ink-faint outline-none
                                  transition duration-150
                                  focus:border-navy-light focus:shadow-[0_0_0_3px_rgba(37,52,101,0.1)]">
                    @error('email')
                    <p class="text-[12px] text-[#c0392b] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-[0.9rem]">
                    <label for="password" class="block text-[12px] font-medium text-ink-muted mb-[5px] tracking-[0.01em]">
                        Kata sandi
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                               placeholder="Min. 8 karakter"
                               required autocomplete="new-password"
                               oninput="checkStrength(this.value)"
                               class="w-full h-11 pl-3 pr-10 rounded-lg border border-line bg-white
                                      text-sm text-ink placeholder-ink-faint outline-none
                                      transition duration-150
                                      focus:border-navy-light focus:shadow-[0_0_0_3px_rgba(37,52,101,0.1)]">
                        <button type="button"
                                onclick="togglePwd()"
                                aria-label="Tampilkan sandi"
                                class="absolute right-3 top-1/2 -translate-y-1/2 flex items-center
                                       text-ink-faint hover:text-ink-muted transition duration-150
                                       bg-transparent border-0 cursor-pointer p-[2px]">
                            <svg id="ico-eye" class="w-4 h-4"
                                 fill="none" stroke="currentColor" stroke-width="1.5"
                                 stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Strength bar -->
                    <div class="flex gap-1 mt-[7px]">
                        <div id="s1" class="h-[3px] flex-1 rounded-sm bg-line transition-colors duration-300"></div>
                        <div id="s2" class="h-[3px] flex-1 rounded-sm bg-line transition-colors duration-300"></div>
                        <div id="s3" class="h-[3px] flex-1 rounded-sm bg-line transition-colors duration-300"></div>
                        <div id="s4" class="h-[3px] flex-1 rounded-sm bg-line transition-colors duration-300"></div>
                    </div>
                    <p id="strength-text" class="text-[11px] text-ink-faint mt-[5px] h-[14px]"></p>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="relative w-full h-[46px] mt-5 overflow-hidden rounded-lg
                               bg-navy text-white text-sm font-medium tracking-[0.01em]
                               transition duration-150 hover:bg-navy-dark active:scale-[0.99]
                               border-0 cursor-pointer">
                    Buat akun
                    <span class="absolute bottom-0 left-0 right-0 h-[2.5px] bg-gold"></span>
                </button>
            </form>

            <!-- Footer form -->
            <p class="mt-6 text-center text-[13px] text-ink-faint">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                   class="text-navy font-medium no-underline hover:text-gold transition duration-150">
                    Masuk di sini
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

        const levels = [
            { label: '',              colors: [] },
            { label: 'Terlalu lemah', colors: ['#e24b4a'] },
            { label: 'Lemah',         colors: ['#ef9f27','#ef9f27'] },
            { label: 'Cukup',         colors: ['#f5a623','#f5a623','#f5a623'] },
            { label: 'Kuat',          colors: ['#1d9e75','#1d9e75','#1d9e75','#1d9e75'] }
        ];

        function checkStrength(v) {
            let score = 0;
            if (v.length >= 8) score++;
            if (/[a-z]/.test(v) && /[A-Z]/.test(v)) score++;
            if (/[0-9]/.test(v)) score++;
            if (/[^a-zA-Z0-9]/.test(v)) score++;
            const segs  = ['s1','s2','s3','s4'];
            const lvl   = v.length === 0 ? 0 : Math.max(1, score);
            segs.forEach((id, i) => {
                document.getElementById(id).style.background = levels[lvl].colors[i] || '#dde3ed';
            });
            const el  = document.getElementById('strength-text');
            const clr = ['','#a8b3c4','#c0392b','#b8860b','#1a7a4a'];
            el.textContent  = levels[lvl].label;
            el.style.color  = clr[lvl] || '';
        }
    </script>
</body>
</html>