<header class="relative bg-white border-b border-[#dde3ed] flex-shrink-0"
        x-data="{ openProfile: {{ $errors->any() ? 'true' : 'false' }} }"
        x-init="
            ['livewire:navigated', 'turbo:load'].forEach(event => {
                document.addEventListener(event, () => { openProfile = false });
            });
        ">

    <div class="flex items-center justify-between px-6 pt-5 pb-4">

        {{-- Page Title --}}
        <div>
            <h2 class="font-serif text-[1.4rem] font-normal text-[#253465] leading-snug">
                @yield('page-title', 'Dashboard')
            </h2>
            <p class="text-[12px] font-light text-[#a8b3c4] mt-0.5 tracking-wide">
                Sistem Informasi Peminjaman dan Layanan PSIK
            </p>
        </div>

        {{-- Avatar trigger --}}
        <button @click="openProfile = true"
                class="relative w-9 h-9 rounded-full bg-gradient-to-br from-[#f5a623] to-[#fdb944]
                       flex items-center justify-center flex-shrink-0
                       ring-2 ring-[#f5a623]/30 hover:ring-[#f5a623]/60
                       transition-all duration-150 cursor-pointer overflow-hidden">
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=253465&color=f5a623&bold=true"
                 class="w-full h-full object-cover"
                 alt="{{ Auth::user()->name }}">
        </button>

    </div>

    {{-- ══════════════════════════════════════
         MODAL PROFILE
    ══════════════════════════════════════ --}}
    <div x-show="openProfile"
         x-transition.opacity
         x-cloak
         class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 px-4">

        <div @click.away="openProfile = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="relative bg-white w-full max-w-sm rounded-2xl shadow-2xl overflow-hidden">

            {{-- Gold bar --}}
            <div class="absolute top-0 left-0 right-0 h-[3px] bg-[#f5a623]"></div>

            {{-- Close --}}
            <button @click="openProfile = false"
                    class="absolute top-4 right-4 w-7 h-7 flex items-center justify-center
                           rounded-md text-[#a8b3c4] hover:text-[#253465] hover:bg-[#f7f8fb]
                           transition-all duration-150 text-sm z-10">
                <i class="fas fa-times"></i>
            </button>

            {{-- Header --}}
            <div class="bg-[#253465] px-6 pt-8 pb-6 text-center">
                <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-[#f5a623] to-[#fdb944]
                            ring-4 ring-[#f5a623]/25 overflow-hidden mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=253465&color=f5a623&bold=true"
                         class="w-full h-full object-cover"
                         alt="{{ Auth::user()->name }}">
                </div>
                <h3 class="font-serif text-[1.1rem] font-normal text-white">
                    {{ Auth::user()->name }}
                </h3>
                <p class="text-[11px] font-light text-[#f5a623] tracking-widest uppercase mt-1">
                    {{ Auth::user()->role }}
                </p>
            </div>

            {{-- Form --}}
            <form action="{{ route('profile.update') }}" method="POST" class="px-6 py-5">
                @csrf
                @method('PUT')

                {{-- Hanya tampilkan error validasi profile, bukan session success dari halaman lain --}}
                @if($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-[#fdf3f2] border border-[#f5c2be]">
                    @foreach($errors->all() as $error)
                        <p class="text-[12px] text-[#c0392b]">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $error }}
                        </p>
                    @endforeach
                </div>
                @endif

                {{-- ── SUCCESS: hanya tampilkan jika berasal dari profile update ── --}}
                @if(session('profile_success'))
                <div class="mb-4 p-3 rounded-lg bg-[#edfaf4] border border-[#a3e8c5]">
                    <p class="text-[12px] text-[#1a7a4a]">
                        <i class="fas fa-check-circle mr-1"></i>{{ session('profile_success') }}
                    </p>
                </div>
                @endif

                {{-- Nama --}}
                <div class="mb-4">
                    <label class="block text-[11px] font-medium text-[#5a677f] uppercase tracking-[0.08em] mb-1.5">
                        Nama
                    </label>
                    <input type="text" name="name"
                           value="{{ old('name', Auth::user()->name) }}"
                           class="w-full h-11 px-3 rounded-lg border text-[14px] text-[#1e2a45]
                                  focus:outline-none focus:border-[#253465] focus:ring-2 focus:ring-[#253465]/10
                                  transition-all duration-150 placeholder-[#a8b3c4]
                                  {{ $errors->has('name') ? 'border-[#c0392b] bg-[#fdf3f2]' : 'border-[#dde3ed] bg-white' }}">
                    @error('name')
                        <p class="text-[11px] text-[#c0392b] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-2">
                    <label class="block text-[11px] font-medium text-[#5a677f] uppercase tracking-[0.08em] mb-1.5">
                        Email
                    </label>
                    <input type="email" name="email"
                           value="{{ old('email', Auth::user()->email) }}"
                           placeholder="nim@student.ub.ac.id"
                           class="w-full h-11 px-3 rounded-lg border text-[14px] text-[#1e2a45]
                                  focus:outline-none focus:border-[#253465] focus:ring-2 focus:ring-[#253465]/10
                                  transition-all duration-150 placeholder-[#a8b3c4]
                                  {{ $errors->has('email') ? 'border-[#c0392b] bg-[#fdf3f2]' : 'border-[#dde3ed] bg-white' }}">
                    @error('email')
                        <p class="text-[11px] text-[#c0392b] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Domain hint --}}
                <p class="text-[11px] text-[#a8b3c4] mb-5">
                    <i class="fas fa-info-circle mr-1"></i>
                    Hanya email <span class="font-medium text-[#5a677f]">@student.ub.ac.id</span> yang diizinkan
                </p>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-2 pt-1">
                    <button type="button"
                            @click="openProfile = false"
                            class="h-9 px-4 rounded-lg border border-[#dde3ed] text-[13px] font-medium
                                   text-[#5a677f] hover:bg-[#f7f8fb] hover:text-[#1e2a45]
                                   transition-all duration-150">
                        Batal
                    </button>
                    <button type="submit"
                            class="relative h-9 px-4 rounded-lg bg-[#253465] text-white text-[13px] font-medium
                                   hover:bg-[#1b2649] transition-all duration-150 overflow-hidden">
                        <span class="absolute bottom-0 left-0 right-0 h-[2.5px] bg-[#f5a623]"></span>
                        <i class="fas fa-save mr-1.5 text-[11px]"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

</header>

<style>[x-cloak] { display: none !important; }</style>