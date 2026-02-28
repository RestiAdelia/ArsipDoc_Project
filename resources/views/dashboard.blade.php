@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6 flex items-center justify-between">
            <div>
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-1">Selamat Datang</p>
                <h2 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">
                    {{ Auth::user()->name }}
                </h2>
                <p class="text-xs text-slate-400 mt-0.5">Berikut ringkasan aktivitas surat kamu hari ini.</p>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-slate-900 flex items-center justify-center text-white font-semibold text-base flex-shrink-0"
                style="font-family: 'Georgia', serif;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <!-- Total Arsip -->
            <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Total Arsip</p>
                    <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">{{ $totalDokumen }}
                </p>
                <p class="text-xs text-slate-400 mt-1">Dokumen tersimpan</p>
            </div>

            <!-- Total Surat Masuk -->
            <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Surat Masuk</p>
                    <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">
                    {{ $totalSuratMasuk }}</p>
                <p class="text-xs text-slate-400 mt-1">Total keseluruhan</p>
            </div>

            <!-- Surat Hari Ini -->
            <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Hari Ini</p>
                    <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">{{ $suratHariIni }}
                </p>
                <p class="text-xs text-slate-400 mt-1">Surat masuk</p>
            </div>
             <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Surat Keluar</p>
                    <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">
                    {{ $totalSuratKeluar }}</p>
                <p class="text-xs text-slate-400 mt-1">Total keseluruhan</p>
            </div>
            <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Total Admin</p>
                    <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">{{ $totalAdmin }}
                </p>
                <p class="text-xs text-slate-400 mt-1">Akun admin </p>
        </div>

        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Total User</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">{{ $totalUser }}</p>
            <p class="text-xs text-slate-400 mt-1">Akun user terdaftar</p>
        </div>

    </div>


    </div>
@endsection
