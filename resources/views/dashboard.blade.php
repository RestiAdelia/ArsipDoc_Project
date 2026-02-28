@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-5">

    <!-- Welcome Banner -->
    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6 flex items-center justify-between">
        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-1">Selamat Datang</p>
            <h2 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">
                {{ Auth::user()->name }}
            </h2>
            <p class="text-xs text-slate-400 mt-0.5">Berikut ringkasan aktivitas surat hari ini.</p>
        </div>
        <div class="w-11 h-11 rounded-2xl bg-slate-900 flex items-center justify-center text-white font-semibold text-base flex-shrink-0"
             style="font-family: 'Georgia', serif;">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

        <!-- Total Arsip -->
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Total Arsip</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">{{ $totalDokumen }}</p>
            <p class="text-xs text-slate-400 mt-1">Dokumen tersimpan</p>
        </div>

        <!-- Surat Masuk -->
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Surat Masuk</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859M12 3v8.25m0 0l-3-3m3 3l3-3"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">{{ $totalSuratMasuk }}</p>
            <p class="text-xs text-slate-400 mt-1">Total keseluruhan</p>
        </div>

        <!-- Surat Keluar -->
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Surat Keluar</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">{{ $totalSuratKeluar }}</p>
            <p class="text-xs text-slate-400 mt-1">Total keseluruhan</p>
        </div>

        <!-- Hari Ini -->
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Hari Ini</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">{{ $suratHariIni }}</p>
            <p class="text-xs text-slate-400 mt-1">Surat masuk hari ini</p>
        </div>

        <!-- Total Admin -->
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Total Admin</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">{{ $totalAdmin }}</p>
            <p class="text-xs text-slate-400 mt-1">Akun admin aktif</p>
        </div>

        <!-- Total User -->
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Total User</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">{{ $totalUser }}</p>
            <p class="text-xs text-slate-400 mt-1">Akun user terdaftar</p>
        </div>

    </div>

</div>
@endsection