@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-5">

    <!-- Welcome Banner -->
    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-sm px-6 py-4 flex items-center justify-between relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 rounded-full blur-3xl -mr-8 -mt-8" style="background-color: rgba(62,90,118,0.06);"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 rounded-full blur-2xl -ml-8 -mb-8" style="background-color: rgba(20,30,48,0.05);"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-2 mb-0.5">
                <span class="w-1 h-3 rounded-full" style="background-color: #3E5A76;"></span>
                <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 font-medium">Selamat Datang</p>
            </div>
            <h2 class="text-base font-semibold" style="font-family: 'Georgia', serif; color: #141E30;">
                {{ Auth::user()->name }}
            </h2>
            <p class="text-[11px] text-slate-400 mt-0.5 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ now()->translatedFormat('l, d F Y') }}
            </p>
        </div>

        <div class="relative z-10">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-white font-semibold text-base shadow-md relative overflow-hidden"
                style="background-color: #141E30; font-family: 'Georgia', serif;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full border-2 border-white" style="background-color: #3E5A76;"></div>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">

        <!-- Total Arsip -->
        <div class="group bg-white border border-stone-200/70 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 px-5 py-5 relative overflow-hidden">
            <div class="flex items-center justify-between mb-3">
                <p class="text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium leading-tight">Total Arsip</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold leading-none" style="font-family: 'Georgia', serif; color: #141E30;">{{ $totalDokumen }}</p>
            <p class="text-[10px] text-slate-400 mt-1.5 flex items-center gap-1">
                <span class="w-1 h-1 rounded-full" style="background-color: #3E5A76;"></span>
                Dokumen
            </p>
        </div>

        <!-- Surat Masuk -->
        <div class="group bg-white border border-stone-200/70 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 px-5 py-5 relative overflow-hidden">
            <div class="flex items-center justify-between mb-3">
                <p class="text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium leading-tight">Surat Masuk</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859M12 3v8.25m0 0l-3-3m3 3l3-3"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold leading-none" style="font-family: 'Georgia', serif; color: #141E30;">{{ $totalSuratMasuk }}</p>
            <p class="text-[10px] text-slate-400 mt-1.5 flex items-center gap-1">
                <span class="w-1 h-1 rounded-full" style="background-color: #3E5A76;"></span>
                Keseluruhan
            </p>
        </div>

        <!-- Surat Keluar -->
        <div class="group bg-white border border-stone-200/70 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 px-5 py-5 relative overflow-hidden">
            <div class="flex items-center justify-between mb-3">
                <p class="text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium leading-tight">Surat Keluar</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold leading-none" style="font-family: 'Georgia', serif; color: #141E30;">{{ $totalSuratKeluar }}</p>
            <p class="text-[10px] text-slate-400 mt-1.5 flex items-center gap-1">
                <span class="w-1 h-1 rounded-full" style="background-color: #3E5A76;"></span>
                Keseluruhan
            </p>
        </div>

        <!-- Hari Ini -->
        <div class="group bg-white border border-stone-200/70 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 px-5 py-5 relative overflow-hidden">
            <div class="flex items-center justify-between mb-3">
                <p class="text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium leading-tight">Hari Ini</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold leading-none" style="font-family: 'Georgia', serif; color: #141E30;">{{ $suratHariIni }}</p>
            <p class="text-[10px] text-slate-400 mt-1.5 flex items-center gap-1">
                <span class="w-1 h-1 rounded-full" style="background-color: #3E5A76;"></span>
                Surat masuk
            </p>
        </div>

        <!-- Total Admin -->
        <div class="group bg-white border border-stone-200/70 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 px-5 py-5 relative overflow-hidden">
            <div class="flex items-center justify-between mb-3">
                <p class="text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium leading-tight">Total Admin</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold leading-none" style="font-family: 'Georgia', serif; color: #141E30;">{{ $totalAdmin }}</p>
            <p class="text-[10px] text-slate-400 mt-1.5 flex items-center gap-1">
                <span class="w-1 h-1 rounded-full" style="background-color: #3E5A76;"></span>
                Admin aktif
            </p>
        </div>

        <!-- Total User -->
        <div class="group bg-white border border-stone-200/70 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 px-5 py-5 relative overflow-hidden">
            <div class="flex items-center justify-between mb-3">
                <p class="text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium leading-tight">Total User</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold leading-none" style="font-family: 'Georgia', serif; color: #141E30;">{{ $totalUser }}</p>
            <p class="text-[10px] text-slate-400 mt-1.5 flex items-center gap-1">
                <span class="w-1 h-1 rounded-full" style="background-color: #3E5A76;"></span>
                User terdaftar
            </p>
        </div>

    </div>

    <!-- Chart Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        <!-- Line Chart -->
        <div class="lg:col-span-2 bg-white border border-stone-200/70 rounded-2xl shadow-sm px-7 py-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <div class="flex items-center gap-2 mb-0.5">
                        <span class="w-1 h-3 rounded-full" style="background-color: #3E5A76;"></span>
                        <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 font-medium">Statistik</p>
                    </div>
                    <h3 class="text-base font-semibold" style="font-family: 'Georgia', serif; color: #141E30;">
                        Tren Surat 6 Bulan Terakhir
                    </h3>
                </div>
                <div class="flex items-center gap-3 text-[11px] text-slate-500">
                    <span class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full" style="background-color: #3E5A76;"></span>
                        Masuk
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full" style="background-color: #141E30;"></span>
                        Keluar
                    </span>
                </div>
            </div>
            <canvas id="trendChart" height="110"></canvas>
        </div>

        <!-- Donut Chart -->
        <div class="bg-white border border-stone-200/70 rounded-2xl shadow-sm px-7 py-6 flex flex-col">
            <div class="mb-4">
                <div class="flex items-center gap-2 mb-0.5">
                    <span class="w-1 h-3 rounded-full" style="background-color: #3E5A76;"></span>
                    <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 font-medium">Komposisi</p>
                </div>
                <h3 class="text-base font-semibold" style="font-family: 'Georgia', serif; color: #141E30;">
                    Distribusi Dokumen
                </h3>
            </div>
            <div class="flex-1 flex items-center justify-center">
                <canvas id="donutChart" width="200" height="200"></canvas>
            </div>
            <div class="mt-3 space-y-1.5">
                <div class="flex items-center justify-between text-[11px] text-slate-500">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full" style="background-color: #3E5A76;"></span>
                        Surat Masuk
                    </span>
                    <span class="font-semibold" style="color: #141E30;">{{ $totalSuratMasuk }}</span>
                </div>
                <div class="flex items-center justify-between text-[11px] text-slate-500">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full" style="background-color: #141E30;"></span>
                        Surat Keluar
                    </span>
                    <span class="font-semibold" style="color: #141E30;">{{ $totalSuratKeluar }}</span>
                </div>
                <div class="flex items-center justify-between text-[11px] text-slate-500">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full" style="background-color: #94a3b8;"></span>
                        Arsip
                    </span>
                    <span class="font-semibold" style="color: #141E30;">{{ $totalDokumen }}</span>
                </div>
            </div>
        </div>

    </div>

</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
    const labels = @json($chartLabels);
    const masuk  = @json($chartSuratMasuk);
    const keluar = @json($chartSuratKeluar);

    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Surat Masuk',
                    data: masuk,
                    borderColor: '#3E5A76',
                    backgroundColor: 'rgba(62,90,118,0.08)',
                    borderWidth: 2,
                    pointBackgroundColor: '#3E5A76',
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    tension: 0.4,
                    fill: true,
                },
                {
                    label: 'Surat Keluar',
                    data: keluar,
                    borderColor: '#141E30',
                    backgroundColor: 'rgba(20,30,48,0.05)',
                    borderWidth: 2,
                    pointBackgroundColor: '#141E30',
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    tension: 0.4,
                    fill: true,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#141E30',
                    titleFont: { family: 'Georgia, serif', size: 11 },
                    bodyFont: { size: 11 },
                    padding: 8,
                    cornerRadius: 8,
                },
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8', font: { size: 10 } },
                },
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.04)' },
                    ticks: { color: '#94a3b8', font: { size: 10 }, stepSize: 1, precision: 0 },
                },
            },
        },
    });

    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Surat Masuk', 'Surat Keluar', 'Arsip'],
            datasets: [{
                data: [{{ $totalSuratMasuk }}, {{ $totalSuratKeluar }}, {{ $totalDokumen }}],
                backgroundColor: ['#3E5A76', '#141E30', '#94a3b8'],
                borderWidth: 0,
                hoverOffset: 5,
            }],
        },
        options: {
            responsive: false,
            cutout: '72%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#141E30',
                    titleFont: { family: 'Georgia, serif', size: 11 },
                    bodyFont: { size: 11 },
                    padding: 8,
                    cornerRadius: 8,
                },
            },
        },
    });
</script>
@endpush

@endsection