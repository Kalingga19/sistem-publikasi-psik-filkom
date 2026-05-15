<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PSIK Vokasi UB</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                            faint:   '#1e2a4520',
                        },
                        gold: {
                            DEFAULT: '#f5a623',
                            light:   '#fdb944',
                            muted:   '#fff8ed',
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

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.97); }
            to   { opacity: 1; transform: scale(1); }
        }
        @keyframes progress {
            from { width: 0%; }
        }

        .anim-fade-up  { animation: fadeInUp 0.5s ease-out forwards; }
        .anim-scale-in { animation: scaleIn 0.5s ease-out forwards; }

        .stat-card { opacity: 0; transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 12px 28px -6px rgba(37,52,101,0.12); }

        .chart-wrap { opacity: 0; animation: scaleIn 0.6s ease-out 0.7s forwards; }

        .progress-bar { animation: progress 1.2s ease-out forwards; }
        .counter { display: inline-block; }
    </style>
</head>
<body class="bg-surface text-ink">

{{-- ── Toast Sukses ── --}}
@if(session('success'))
<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 3000)"
    x-show="show"
    x-transition
    class="fixed top-5 right-5 z-50"
>
    <div class="flex items-center gap-3 bg-navy text-white px-5 py-3 rounded-lg shadow-xl border-l-4 border-gold text-sm font-medium">
        <i class="fas fa-check-circle text-gold"></i>
        {{ session('success') }}
    </div>
</div>
@endif

<div class="flex h-screen overflow-hidden">

    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">

        @include('layouts.header')

        <main class="flex-1 overflow-y-auto bg-surface px-6 py-6">

            {{-- ── Welcome Banner ── --}}
            <div class="relative overflow-hidden rounded-xl bg-navy px-8 py-7 mb-6 anim-scale-in">
                {{-- Gold top bar --}}
                <div class="absolute top-0 left-0 right-0 h-[3px] bg-gold"></div>
                {{-- Decorative circles --}}
                <div class="absolute -top-16 -right-16 w-56 h-56 rounded-full border border-gold/10 pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-10 w-44 h-44 rounded-full border border-white/[0.04] pointer-events-none"></div>

                <div class="relative z-10 flex items-end justify-between flex-wrap gap-4">
                    <div>
                        <p class="text-[11px] font-medium tracking-[0.1em] uppercase text-gold/70 mb-1">Dashboard</p>
                        <h1 class="text-2xl font-normal text-white mb-1"
                            style="font-family:'DM Serif Display',serif;">
                            Selamat Datang, <em class="italic text-gold-light">{{ Auth::user()->name }}</em>
                        </h1>
                        <p class="text-sm text-white/45 font-light">Berikut ringkasan aktivitas sistem</p>
                    </div>
                    <div class="bg-white/[0.07] border border-white/[0.1] rounded-lg px-4 py-3 text-right">
                        <p class="text-[10.5px] text-white/35 tracking-widest uppercase font-light mb-[2px]">Hari ini</p>
                        <p class="text-sm font-medium text-white">{{ now()->translatedFormat('l, d M Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- ── Stat Cards ── --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

                {{-- Total Alat --}}
                <div class="stat-card bg-white rounded-xl border border-line p-5 anim-fade-up" style="animation-delay:0.1s">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-[11px] font-medium tracking-[0.06em] uppercase text-ink-faint mb-1">Total Alat</p>
                            <h3 class="text-3xl font-normal text-ink counter"
                                data-target="{{ $stats['total_peminjaman_alat'] }}"
                                style="font-family:'DM Serif Display',serif;">0</h3>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-navy/[0.07] border border-navy/10 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-tools text-navy text-sm"></i>
                        </div>
                    </div>
                    <div class="h-[3px] rounded-full bg-line overflow-hidden">
                        <div class="progress-bar h-full rounded-full bg-navy" style="width:100%; animation-delay:0.5s;"></div>
                    </div>
                    <p class="text-[11px] text-ink-faint mt-2 font-light">
                        <i class="fas fa-database mr-1 opacity-50"></i> Data terkini
                    </p>
                </div>

                {{-- Peminjaman Studio --}}
                <div class="stat-card bg-white rounded-xl border border-line p-5 anim-fade-up" style="animation-delay:0.2s">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-[11px] font-medium tracking-[0.06em] uppercase text-ink-faint mb-1">Peminjaman Studio</p>
                            <h3 class="text-3xl font-normal text-ink counter"
                                data-target="{{ $stats['peminjaman_studio'] }}"
                                style="font-family:'DM Serif Display',serif;">0</h3>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-[#f5a623]/10 border border-[#f5a623]/20 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-microphone text-gold text-sm"></i>
                        </div>
                    </div>
                    <div class="h-[3px] rounded-full bg-line overflow-hidden">
                        <div class="progress-bar h-full rounded-full bg-gold" style="width:100%; animation-delay:0.6s;"></div>
                    </div>
                    <p class="text-[11px] text-ink-faint mt-2 font-light">
                        <i class="fas fa-database mr-1 opacity-50"></i> Data terkini
                    </p>
                </div>

                {{-- Media Partner Aktif --}}
                <div class="stat-card bg-white rounded-xl border border-line p-5 anim-fade-up" style="animation-delay:0.3s">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-[11px] font-medium tracking-[0.06em] uppercase text-ink-faint mb-1">Media Partner Aktif</p>
                            <h3 class="text-3xl font-normal text-ink counter"
                                data-target="{{ $stats['media_partner_aktif'] }}"
                                style="font-family:'DM Serif Display',serif;">0</h3>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-[#1a7a4a]/10 border border-[#1a7a4a]/15 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-handshake text-[#1a7a4a] text-sm"></i>
                        </div>
                    </div>
                    <div class="h-[3px] rounded-full bg-line overflow-hidden">
                        <div class="progress-bar h-full rounded-full bg-[#1a7a4a]" style="width:100%; animation-delay:0.7s;"></div>
                    </div>
                    <p class="text-[11px] text-ink-faint mt-2 font-light">
                        <i class="fas fa-database mr-1 opacity-50"></i> Data terkini
                    </p>
                </div>

                {{-- Menunggu Persetujuan --}}
                <div class="stat-card bg-white rounded-xl border border-line p-5 anim-fade-up" style="animation-delay:0.4s">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-[11px] font-medium tracking-[0.06em] uppercase text-ink-faint mb-1">Menunggu Persetujuan</p>
                            <h3 class="text-3xl font-normal text-ink counter"
                                data-target="{{ $stats['menunggu_persetujuan'] }}"
                                style="font-family:'DM Serif Display',serif;">0</h3>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-amber-50 border border-amber-200/60 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-hourglass-half text-amber-500 text-sm"></i>
                        </div>
                    </div>
                    <div class="h-[3px] rounded-full bg-line overflow-hidden">
                        <div class="progress-bar h-full rounded-full bg-amber-400"
                             style="width:{{ $stats['menunggu_persetujuan'] > 0 ? '35%' : '0%' }}; animation-delay:0.8s;"></div>
                    </div>
                    <p class="text-[11px] mt-2 font-light {{ $stats['menunggu_persetujuan'] > 0 ? 'text-amber-500' : 'text-ink-faint' }}">
                        <i class="fas fa-clock mr-1 opacity-60"></i>
                        {{ $stats['menunggu_persetujuan'] > 0 ? 'Butuh tindakan' : 'Semua sudah diproses' }}
                    </p>
                </div>

            </div>

            {{-- ── Charts ── --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                {{-- Grafik Bulanan --}}
                <div class="chart-wrap bg-white rounded-xl border border-line p-6">
                    <div class="flex items-center justify-between mb-5">
                        <div>
                            <p class="text-[10px] font-medium tracking-[0.1em] uppercase text-gold/70 mb-[2px]">Statistik</p>
                            <h3 class="text-[15px] font-normal text-ink"
                                style="font-family:'DM Serif Display',serif;">
                                Peminjaman Bulanan
                            </h3>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1.5 text-[11px] text-ink-faint">
                                <span class="w-2 h-2 rounded-full bg-navy inline-block"></span> Alat
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-ink-faint">
                                <span class="w-2 h-2 rounded-full bg-gold inline-block"></span> Studio
                            </span>
                        </div>
                    </div>
                    <canvas id="monthlyChart"></canvas>
                </div>

                {{-- Grafik Kategori --}}
                <div class="chart-wrap bg-white rounded-xl border border-line p-6">
                    <div class="flex items-center justify-between mb-5">
                        <div>
                            <p class="text-[10px] font-medium tracking-[0.1em] uppercase text-gold/70 mb-[2px]">Distribusi</p>
                            <h3 class="text-[15px] font-normal text-ink"
                                style="font-family:'DM Serif Display',serif;">
                                Kategori Peminjaman
                            </h3>
                        </div>
                        <div class="w-7 h-7 rounded-lg bg-navy/[0.06] flex items-center justify-center">
                            <i class="fas fa-chart-pie text-navy/50 text-xs"></i>
                        </div>
                    </div>
                    <canvas id="categoryChart"></canvas>
                </div>

            </div>

        </main>
    </div>
</div>

<script>
    // Counter animation
    function animateCounter() {
        document.querySelectorAll('.counter').forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target')) || 0;
            if (target === 0) { counter.textContent = '0'; return; }
            const step = target / (1500 / 16);
            let current = 0;
            const update = () => {
                current += step;
                if (current < target) {
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(update);
                } else {
                    counter.textContent = target;
                }
            };
            setTimeout(update, 400);
        });
    }

    window.addEventListener('load', () => {
        animateCounter();
        document.querySelectorAll('.stat-card').forEach((card, i) => {
            setTimeout(() => card.style.opacity = '1', i * 80 + 100);
        });
    });

    const dataAlatBulanan   = @json($dataAlatBulanan);
    const dataStudioBulanan = @json($dataStudioBulanan);
    const dataKategori      = @json($dataKategori);

    // Monthly chart
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    const gradNavy = monthlyCtx.createLinearGradient(0, 0, 0, 300);
    gradNavy.addColorStop(0, 'rgba(37,52,101,0.18)');
    gradNavy.addColorStop(1, 'rgba(37,52,101,0.0)');
    const gradGold = monthlyCtx.createLinearGradient(0, 0, 0, 300);
    gradGold.addColorStop(0, 'rgba(245,166,35,0.2)');
    gradGold.addColorStop(1, 'rgba(245,166,35,0.0)');

    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
            datasets: [{
                label: 'Peminjaman Alat',
                data: dataAlatBulanan,
                borderColor: '#253465',
                backgroundColor: gradNavy,
                tension: 0.4, fill: true,
                borderWidth: 2,
                pointRadius: 4, pointHoverRadius: 6,
                pointBackgroundColor: '#253465',
                pointBorderColor: '#fff', pointBorderWidth: 2
            }, {
                label: 'Peminjaman Studio',
                data: dataStudioBulanan,
                borderColor: '#f5a623',
                backgroundColor: gradGold,
                tension: 0.4, fill: true,
                borderWidth: 2,
                pointRadius: 4, pointHoverRadius: 6,
                pointBackgroundColor: '#f5a623',
                pointBorderColor: '#fff', pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1b2649',
                    padding: 12, cornerRadius: 8,
                    titleFont: { size: 12, weight: '500', family: 'DM Sans' },
                    bodyFont:  { size: 12, family: 'DM Sans' },
                    borderColor: 'rgba(245,166,35,0.3)', borderWidth: 1
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#dde3ed', drawBorder: false },
                    ticks: { font: { size: 11, family: 'DM Sans' }, color: '#a8b3c4' }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11, family: 'DM Sans' }, color: '#a8b3c4' }
                }
            },
            animation: { duration: 1200, easing: 'easeInOutQuart' }
        }
    });

    // Donut chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: ['Peminjaman Alat', 'Peminjaman Studio', 'Media Partner'],
            datasets: [{
                data: dataKategori,
                backgroundColor: ['#253465', '#f5a623', '#1a7a4a'],
                borderWidth: 4,
                borderColor: '#ffffff',
                hoverOffset: 12
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true, padding: 16,
                        font: { size: 12, family: 'DM Sans' },
                        color: '#5a677f'
                    }
                },
                tooltip: {
                    backgroundColor: '#1b2649',
                    padding: 12, cornerRadius: 8,
                    titleFont: { size: 12, weight: '500', family: 'DM Sans' },
                    bodyFont:  { size: 12, family: 'DM Sans' },
                    borderColor: 'rgba(245,166,35,0.3)', borderWidth: 1
                }
            },
            animation: { animateRotate: true, animateScale: true, duration: 1200, easing: 'easeInOutQuart' }
        }
    });
</script>
</body>
</html>