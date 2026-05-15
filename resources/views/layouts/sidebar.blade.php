<aside class="relative w-64 min-h-screen bg-[#253465] flex flex-col overflow-hidden flex-shrink-0 border-r border-[#f5a623]">


    {{-- Decorative circle top-right --}}
    <div class="absolute -top-20 -right-20 w-56 h-56 rounded-full border border-[#f5a623]/10 pointer-events-none"></div>

    {{-- Decorative circle bottom-left --}}
    <div class="absolute -bottom-24 -left-12 w-52 h-52 rounded-full border border-white/[0.04] pointer-events-none"></div>


    {{-- ══════════════════════════════════════
         HEADER / BRAND
    ══════════════════════════════════════ --}}
    <div class="relative z-10 px-5 pt-6 pb-5  flex-shrink-0">
        <div class="flex items-center gap-3">
                <img src="{{ asset('img/logo.png') }}"
                class="w-[52px] h-[52px] object-contain brightness-0 invert"
                alt="Vokasi UB">
            <div>
                <div class="font-serif text-[14px] tracking-wide text-white">PSIK · Vokasi UB</div>
                <div class="text-[10.5px] font-light text-white/35 tracking-widest mt-px">Universitas Brawijaya</div>
            </div>
        </div>
    </div>


    {{-- ══════════════════════════════════════
         NAVIGASI
    ══════════════════════════════════════ --}}
    <nav class="relative z-10 flex-1 overflow-y-auto px-3 py-3 space-y-1">

{{-- Dashboard (admin only) --}}
@if(auth()->user()->isAdmin())
<div class="mt-1">
    <a href="{{ route('dashboard') }}"
       class="flex items-center gap-[10px] px-3 py-[9px] rounded-[7px] text-[13px] no-underline transition-all duration-150
              {{ request()->routeIs('dashboard')
                  ? 'bg-[#f5a623]/10 text-white border-l-2 border-[#f5a623] pl-[10px]'
                  : 'text-white/55 hover:bg-white/[0.06] hover:text-white/85' }}">
        <span class="w-4 h-4 flex items-center justify-center text-[13px] flex-shrink-0
                     {{ request()->routeIs('dashboard') ? 'text-[#f5a623]' : 'text-white/30' }}">
            <i class="fas fa-th-large"></i>
        </span>
        Dashboard
    </a>
</div>
@else
{{-- Dashboard (user) --}}
<div class="mt-1">
    <a href="{{ route('dashboard.user') }}"
       class="flex items-center gap-[10px] px-3 py-[9px] rounded-[7px] text-[13px] no-underline transition-all duration-150
              {{ request()->routeIs('dashboard.user')
                  ? 'bg-[#f5a623]/10 text-white border-l-2 border-[#f5a623] pl-[10px]'
                  : 'text-white/55 hover:bg-white/[0.06] hover:text-white/85' }}">
        <span class="w-4 h-4 flex items-center justify-center text-[13px] flex-shrink-0
                     {{ request()->routeIs('dashboard.user') ? 'text-[#f5a623]' : 'text-white/30' }}">
            <i class="fas fa-th-large"></i>
        </span>
        Dashboard
    </a>
</div>
@endif


        {{-- ── SECTION: PEMINJAMAN ── --}}
        <div class="mt-5">
            <div class="flex items-center gap-2 px-2 pb-2">
                <span class="text-[10px] font-medium tracking-[0.1em] uppercase text-[#f5a623]/55">Peminjaman</span>
                <span class="flex-1 h-px bg-[#f5a623]/12"></span>
            </div>

            <div class="space-y-px">

                {{-- Peminjaman Alat --}}
                <a href="{{ route('peminjaman.alat') }}"
                   class="flex items-center gap-[10px] px-3 py-[9px] rounded-[7px] text-[13px] no-underline transition-all duration-150
                          {{ request()->routeIs('peminjaman.alat')
                              ? 'bg-[#f5a623]/10 text-white border-l-2 border-[#f5a623] pl-[10px]'
                              : 'text-white/55 hover:bg-white/[0.06] hover:text-white/85' }}">
                    <span class="w-4 h-4 flex items-center justify-center text-[13px] flex-shrink-0
                                 {{ request()->routeIs('peminjaman.alat') ? 'text-[#f5a623]' : 'text-white/30' }}">
                        <i class="fas fa-tools"></i>
                    </span>
                    Peminjaman Alat
                </a>

                {{-- Peminjaman Studio --}}
                <a href="{{ route('peminjaman.studio') }}"
                   class="flex items-center gap-[10px] px-3 py-[9px] rounded-[7px] text-[13px] no-underline transition-all duration-150
                          {{ request()->routeIs('peminjaman.studio')
                              ? 'bg-[#f5a623]/10 text-white border-l-2 border-[#f5a623] pl-[10px]'
                              : 'text-white/55 hover:bg-white/[0.06] hover:text-white/85' }}">
                    <span class="w-4 h-4 flex items-center justify-center text-[13px] flex-shrink-0
                                 {{ request()->routeIs('peminjaman.studio') ? 'text-[#f5a623]' : 'text-white/30' }}">
                        <i class="fas fa-microphone"></i>
                    </span>
                    Peminjaman Studio
                </a>

                {{-- Media Partner --}}
                <a href="{{ route('media-partner.index') }}"
                   class="flex items-center gap-[10px] px-3 py-[9px] rounded-[7px] text-[13px] no-underline transition-all duration-150
                          {{ request()->routeIs('media-partner.index')
                              ? 'bg-[#f5a623]/10 text-white border-l-2 border-[#f5a623] pl-[10px]'
                              : 'text-white/55 hover:bg-white/[0.06] hover:text-white/85' }}">
                    <span class="w-4 h-4 flex items-center justify-center text-[13px] flex-shrink-0
                                 {{ request()->routeIs('media-partner.index') ? 'text-[#f5a623]' : 'text-white/30' }}">
                        <i class="fas fa-handshake"></i>
                    </span>
                    Media Partner
                </a>

            </div>
        </div>


        {{-- ── SECTION: DATA MASTER (admin only) ── --}}
        @if(auth()->user()->isAdmin())
        <div class="mt-5">
            <div class="flex items-center gap-2 px-2 pb-2">
                <span class="text-[10px] font-medium tracking-[0.1em] uppercase text-[#f5a623]/55">Data Master</span>
                <span class="flex-1 h-px bg-[#f5a623]/12"></span>
            </div>

            <div class="space-y-px">

                {{-- Data Alat --}}
                <a href="{{ route('equipment.index') }}"
                   class="flex items-center gap-[10px] px-3 py-[9px] rounded-[7px] text-[13px] no-underline transition-all duration-150
                          {{ request()->routeIs('equipment.index')
                              ? 'bg-[#f5a623]/10 text-white border-l-2 border-[#f5a623] pl-[10px]'
                              : 'text-white/55 hover:bg-white/[0.06] hover:text-white/85' }}">
                    <span class="w-4 h-4 flex items-center justify-content text-[13px] flex-shrink-0
                                 {{ request()->routeIs('equipment.index') ? 'text-[#f5a623]' : 'text-white/30' }}">
                        <i class="fas fa-box"></i>
                    </span>
                    Data Alat
                </a>

                {{-- Data Pengguna --}}
                <a href="{{ route('data.pengguna') }}"
                   class="flex items-center gap-[10px] px-3 py-[9px] rounded-[7px] text-[13px] no-underline transition-all duration-150
                          {{ request()->routeIs('data.pengguna')
                              ? 'bg-[#f5a623]/10 text-white border-l-2 border-[#f5a623] pl-[10px]'
                              : 'text-white/55 hover:bg-white/[0.06] hover:text-white/85' }}">
                    <span class="w-4 h-4 flex items-center justify-content text-[13px] flex-shrink-0
                                 {{ request()->routeIs('data.pengguna') ? 'text-[#f5a623]' : 'text-white/30' }}">
                        <i class="fas fa-users"></i>
                    </span>
                    Data Pengguna
                </a>

            </div>
        </div>
        @endif

    </nav>


    {{-- ══════════════════════════════════════
         FOOTER: USER INFO + LOGOUT
    ══════════════════════════════════════ --}}
    <div class="relative z-10 flex-shrink-0 px-3 pb-4">
        <div class="h-px bg-white/[0.08] mb-3"></div>

        <div class="flex items-center gap-[10px] px-[10px] py-[9px] rounded-lg bg-white/[0.04] border border-white/[0.08]">

            {{-- Avatar --}}
            <div class="relative w-8 h-8 rounded-full bg-gradient-to-br from-[#f5a623] to-[#fdb944] flex items-center justify-center flex-shrink-0">
                <i class="fas fa-user text-[#1b2649] text-xs"></i>
                <div class="absolute -bottom-px -right-px w-2 h-2 bg-green-400 rounded-full border-[1.5px] border-[#253465]"></div>
            </div>

            {{-- Nama & Role --}}
            <div class="flex-1 min-w-0">
                <div class="text-[12.5px] font-medium text-white truncate">
                    {{ auth()->user()->name ?? 'Pengguna' }}
                </div>
                <div class="text-[10.5px] font-light mt-px truncate
                            {{ auth()->user()->isAdmin() ? 'text-[#f5a623]' : 'text-white/55' }}">
                    {{ auth()->user()->isAdmin() ? 'Administrator' : 'User' }}
                </div>
            </div>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        title="Logout"
                        class="w-7 h-7 flex-shrink-0 flex items-center justify-center rounded-md
                               border border-red-500/20 bg-red-500/[0.06] text-red-400/55
                               hover:bg-red-500/85 hover:border-transparent hover:text-white
                               transition-all duration-150 text-[11px]">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>

        </div>
    </div>

</aside>