<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PSIK FILKOM UB')</title>
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
        body { font-family: 'DM Sans', sans-serif; }

        /* Sidebar active state */
        .nav-link.active {
            background: rgba(245,166,35,0.08);
            color: #f5a623;
        }
        .nav-link.active .nav-icon { color: #f5a623; }

        /* Scrollbar tipis */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #dde3ed; border-radius: 99px; }

        /* Badge status */
        .badge-menunggu     { background:#fff8ec; color:#b45309; border:1px solid #fde68a; }
        .badge-revisi       { background:#fff8ec; color:#b45309; border:1px solid #fde68a; }
        .badge-disetujui    { background:#f0fdf4; color:#166534; border:1px solid #bbf7d0; }
        .badge-ditolak      { background:#fef2f2; color:#991b1b; border:1px solid #fecaca; }
        .badge-dijadwalkan  { background:#eff6ff; color:#1d4ed8; border:1px solid #bfdbfe; }
        .badge-dipublikasikan { background:#f5f3ff; color:#6d28d9; border:1px solid #ddd6fe; }
        .badge-diajukan     { background:#f8fafc; color:#475569; border:1px solid #e2e8f0; }
    </style>
    @stack('styles')
</head>
<body class="bg-surface text-ink min-h-screen flex">

    {{-- ══ SIDEBAR ══ --}}
    <aside id="sidebar"
           class="fixed inset-y-0 left-0 z-40 w-[240px] bg-navy flex flex-col
                  transition-transform duration-300 -translate-x-full md:translate-x-0">

        {{-- Gold bar atas --}}
        <div class="absolute top-0 left-0 right-0 h-[3px] bg-gold"></div>

        {{-- Brand --}}
        <div class="flex items-center gap-3 px-6 pt-8 pb-6">
            <img src="{{ asset('img/logo.png') }}"
                 class="w-9 h-9 object-contain brightness-0 invert" alt="FILKOM">
            <div>
                <div class="text-[13px] font-medium text-white tracking-wide"
                     style="font-family:'DM Serif Display',serif;">
                    PSIK · FILKOM
                </div>
                <div class="text-[10px] text-white/40 font-light">Universitas Brawijaya</div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="mx-6 h-px bg-white/10 mb-4"></div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 flex flex-col gap-[2px] overflow-y-auto">

            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}"
               class="nav-link flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px]
                      text-white/60 hover:text-white hover:bg-white/5 transition duration-150
                      {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
                <svg class="nav-icon w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                     stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            @auth
            @if(auth()->user()->isAdmin())
            {{-- Admin nav --}}
            <div class="px-3 pt-4 pb-1">
                <span class="text-[10px] text-white/25 uppercase tracking-[0.1em] font-medium">
                    Pengelolaan
                </span>
            </div>

            <a href="{{ route('admin.publications.index') }}"
               class="nav-link flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px]
                      text-white/60 hover:text-white hover:bg-white/5 transition duration-150
                      {{ request()->routeIs('admin.publications*') ? 'active' : '' }}">
                <svg class="nav-icon w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                     stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Pengajuan Masuk
            </a>

            @else
            {{-- User nav --}}
            <div class="px-3 pt-4 pb-1">
                <span class="text-[10px] text-white/25 uppercase tracking-[0.1em] font-medium">
                    Pengajuan
                </span>
            </div>

            <a href="{{ route('publications.create') }}"
               class="nav-link flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px]
                      text-white/60 hover:text-white hover:bg-white/5 transition duration-150
                      {{ request()->routeIs('publications.create') ? 'active' : '' }}">
                <svg class="nav-icon w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                     stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 4v16m8-8H4"/>
                </svg>
                Buat Pengajuan
            </a>

            <a href="{{ route('publications.index') }}"
               class="nav-link flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px]
                      text-white/60 hover:text-white hover:bg-white/5 transition duration-150
                      {{ request()->routeIs('publications.index') ? 'active' : '' }}">
                <svg class="nav-icon w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                     stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Riwayat Pengajuan
            </a>
            @endif
            @endauth

        </nav>

        {{-- User info + logout --}}
        <div class="mx-3 mb-4">
            <div class="h-px bg-white/10 mb-3"></div>
            <div class="flex items-center gap-3 px-3 py-2">
                <div class="w-8 h-8 rounded-full bg-gold/20 flex items-center justify-center shrink-0">
                    <span class="text-[12px] font-medium text-gold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[12px] font-medium text-white truncate">
                        {{ auth()->user()->name ?? '' }}
                    </div>
                    <div class="text-[10px] text-white/40">
                        {{ auth()->user()->isAdmin() ? 'Admin' : 'Pengaju' }}
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="text-white/30 hover:text-white/70 transition cursor-pointer bg-transparent border-0"
                            title="Logout">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ══ MAIN WRAPPER ══ --}}
    <div class="flex-1 flex flex-col md:ml-[240px] min-h-screen">

        {{-- Topbar mobile --}}
        <header class="md:hidden flex items-center justify-between px-4 py-3
                        bg-white border-b border-line sticky top-0 z-30">
            <button onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full')"
                    class="p-1 text-ink-muted bg-transparent border-0 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <span class="text-[13px] font-medium text-ink">PSIK FILKOM</span>
            <div class="w-6"></div>
        </header>

        {{-- Page content --}}
        <main class="flex-1 p-6 md:p-8">

            {{-- Flash messages --}}
            @if(session('success'))
            <div id="flash-success"
                 class="flex items-center gap-2 rounded-lg px-4 py-3 text-[13px] mb-5
                         bg-[#f0fdf4] text-[#166534] border border-[#bbf7d0]">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 6L9 17l-5-5"/>
                </svg>
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                    const el = document.getElementById('flash-success');
                    if (el) el.style.opacity = '0';
                }, 3000);
            </script>
            @endif

            @if(session('error'))
            <div class="flex items-center gap-2 rounded-lg px-4 py-3 text-[13px] mb-5
                         bg-[#fef2f2] text-[#991b1b] border border-[#fecaca]">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4m0 4h.01"/>
                </svg>
                {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    {{-- Overlay mobile sidebar --}}
    <div onclick="document.getElementById('sidebar').classList.add('-translate-x-full')"
         class="md:hidden fixed inset-0 z-30 bg-black/30 hidden" id="sidebar-overlay"></div>

    @stack('scripts')
</body>
</html>