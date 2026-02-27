@extends('layouts.main')

@section('title', 'Dashboard User')

@section('content')
<div class="space-y-4">

    {{-- Welcome Banner --}}
    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6 flex items-center justify-between">
        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-1">Selamat Datang</p>
            <h2 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">
                {{ Auth::user()->name }}
            </h2>
            <p class="text-xs text-slate-400 mt-0.5">Berikut ringkasan aktivitas surat kamu hari ini.</p>
        </div>
        <div class="w-11 h-11 rounded-2xl bg-slate-900 flex items-center justify-center text-white font-semibold text-base flex-shrink-0" style="font-family: 'Georgia', serif;">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        {{-- Surat Saya --}}
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Surat Saya</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.022.55m0 0l-4.661 2.51m16.5 1.615a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V8.844a2.25 2.25 0 011.183-1.98l7.5-4.04a2.25 2.25 0 012.134 0l7.5 4.04a2.25 2.25 0 011.183 1.98V19.5z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">{{ $totalSuratUser }}</p>
            <p class="text-xs text-slate-400 mt-1">Total surat yang kamu kirim</p>
        </div>

        {{-- Hari Ini --}}
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Hari Ini</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">{{ $suratHariIniUser }}</p>
            <p class="text-xs text-slate-400 mt-1">Surat saya hari ini</p>
        </div>

        {{-- Total Arsip --}}
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-7 py-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Total Arsip</p>
                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">{{ $totalDokumen }}</p>
            <p class="text-xs text-slate-400 mt-1">Dokumen tersimpan dalam sistem</p>
        </div>

    </div>

</div>
@endsection