@extends('layouts.main')

@section('content')
<div class="max-w-5xl mx-auto space-y-5">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-0.5">Akun</p>
            <h1 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">Profil Saya</h1>
        </div>
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium px-5 py-2.5 rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-slate-900/15">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
            </svg>
            Edit Profil
        </a>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3.5 rounded-2xl text-sm font-medium">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- KOLOM KIRI --}}
        <div class="lg:col-span-1">
            <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden sticky top-6">

                <!-- Banner -->
                <div class="h-28 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-700"></div>

                <!-- Foto + Nama + Badge -->
                <div class="flex flex-col items-center -mt-16 pb-6 px-6 text-center">
                    <div class="relative mb-4">
                        @if($user->foto)
                            <img src="{{ asset('storage/'.$user->foto) }}"
                                 alt="{{ $user->name }}"
                                 class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-xl">
                        @else
                            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-slate-700 to-slate-900 border-4 border-white flex items-center justify-center text-white font-bold text-4xl shadow-xl" style="font-family: 'Georgia', serif;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="absolute bottom-2 right-2 w-4 h-4 rounded-full bg-emerald-400 border-2 border-white shadow"></div>
                    </div>

                    <h2 class="text-base font-semibold text-slate-800" style="font-family: 'Georgia', serif;">{{ $user->name }}</h2>
                    <p class="text-xs text-slate-400 mt-0.5 truncate w-full">{{ $user->email }}</p>
                    <span class="mt-3 inline-flex px-3 py-1 text-[10px] font-medium rounded-lg
                        {{ $user->role === 'admin' ? 'bg-slate-900 text-white' : 'bg-stone-100 text-slate-600 border border-stone-200' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>

                <!-- Info Kontak -->
                <div class="px-6 py-5 border-t border-stone-100 space-y-3.5">

                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-lg bg-stone-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                            </svg>
                        </div>
                        <p class="text-xs text-slate-600">{{ $user->phone ?? '—' }}</p>
                    </div>

                    @if($user->alamat)
                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-stone-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                            </svg>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">{{ $user->alamat }}</p>
                    </div>
                    @endif

                </div>

                <!-- Footer -->
                <div class="px-6 py-3.5 bg-stone-50 border-t border-stone-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-400"></div>
                        <p class="text-[11px] text-slate-400">Akun Aktif</p>
                    </div>
                    <p class="text-[11px] text-slate-400">
                        {{ $user->created_at ? $user->created_at->format('M Y') : '' }}
                    </p>
                </div>

            </div>
        </div>

        {{-- KOLOM KANAN --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Informasi Pribadi --}}
            <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-7 py-5 border-b border-stone-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-stone-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                        </svg>
                    </div>
                    <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Informasi Pribadi</p>
                </div>
                <div class="px-7 py-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Nama Lengkap</p>
                        <div class="flex items-center gap-3 bg-stone-50 border border-stone-100 rounded-xl px-4 py-3">
                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                            </svg>
                            <p class="text-sm font-medium text-slate-800 truncate">{{ $user->name }}</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Role Akun</p>
                        <div class="flex items-center gap-3 bg-stone-50 border border-stone-100 rounded-xl px-4 py-3">
                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                            </svg>
                            <p class="text-sm font-medium text-slate-800">{{ ucfirst($user->role) }}</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Alamat Email</p>
                        <div class="flex items-center gap-3 bg-stone-50 border border-stone-100 rounded-xl px-4 py-3">
                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                            </svg>
                            <p class="text-sm font-medium text-slate-800 truncate">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Nomor Telepon</p>
                        <div class="flex items-center gap-3 bg-stone-50 border border-stone-100 rounded-xl px-4 py-3">
                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                            </svg>
                            <p class="text-sm font-medium text-slate-800">{{ $user->phone ?? '—' }}</p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Alamat --}}
            <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-7 py-5 border-b border-stone-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-stone-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                        </svg>
                    </div>
                    <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Alamat & Lokasi</p>
                </div>
                <div class="px-7 py-6">
                    @if($user->alamat)
                        <div class="flex items-start gap-3 bg-stone-50 border border-stone-100 rounded-xl px-4 py-3">
                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                            </svg>
                            <p class="text-sm font-medium text-slate-800 leading-relaxed">{{ $user->alamat }}</p>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-8 border border-dashed border-stone-300 rounded-xl bg-stone-50">
                            <div class="w-10 h-10 rounded-2xl bg-stone-100 flex items-center justify-center mb-3">
                                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-slate-400 mb-2">Belum ada alamat yang disimpan.</p>
                            <a href="{{ route('profile.edit') }}"
                               class="text-xs font-medium text-slate-600 hover:text-slate-900 bg-white border border-stone-200 hover:border-stone-300 px-4 py-1.5 rounded-xl transition-colors duration-200">
                                Tambahkan Alamat
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Keamanan --}}
            <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-7 py-5 border-b border-stone-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-stone-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                        </svg>
                    </div>
                    <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Keamanan</p>
                </div>
                <div class="px-7 py-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-800">Password</p>
                            <p class="text-xs text-slate-400 mt-0.5">Ganti password secara berkala untuk keamanan akun</p>
                        </div>
                    </div>
                    <a href="{{ route('profile.edit') }}"
                       class="text-xs font-medium text-slate-600 hover:text-slate-900 bg-stone-50 border border-stone-200 hover:border-stone-300 px-4 py-2 rounded-xl transition-colors duration-200 whitespace-nowrap">
                        Ganti Password
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection