@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto space-y-5">

        <!-- Header & Tab -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500 mb-0.5">Akun</p>
                <h1 class="text-xl font-bold text-slate-900" style="font-family: 'Georgia', serif;">Pengaturan Akun</h1>
            </div>
            <div class="flex items-center gap-1 p-1 bg-stone-100 border border-stone-200 rounded-xl">
                <a href="{{ route('profile.edit') }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-medium rounded-lg text-slate-400 hover:text-slate-600 hover:bg-white/60 transition-all duration-200">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    Profil
                </a>
                <span
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-medium rounded-lg bg-white text-slate-800 shadow-sm border border-stone-200 cursor-default">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                    Password
                </span>
            </div>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div
                class="flex items-center gap-3 px-5 py-3.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span><span class="font-medium">Berhasil!</span> {{ session('success') }}</span>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

            <!-- Card Header -->
            <div class="flex items-center gap-3 px-6 py-4 border-b border-stone-100 bg-stone-50/50">
                <div class="w-8 h-8 rounded-xl bg-slate-900 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-800">Ubah Password</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Lindungi akun Anda dengan password yang kuat.</p>
                </div>
            </div>

            <form action="{{ route('profile.password.update') }}" method="POST" class="px-6 py-6 md:px-8">
                @csrf
                @method('PUT')

                <div class="max-w-2xl mx-auto space-y-5">

                    <!-- Password Lama -->
                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Password
                            Lama</label>
                        <input type="password" name="current_password" required autocomplete="current-password"
                            placeholder="Masukkan password saat ini"
                            class="w-full bg-stone-50 border @error('current_password') border-red-300 @else border-stone-200 @enderror rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">
                        @error('current_password')
                            <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Divider -->
                    <div class="relative py-1">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-stone-100"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-white px-3 text-[10px] uppercase tracking-[0.2em] text-slate-400">Password
                                Baru</span>
                        </div>
                    </div>

                    <!-- Password Baru & Konfirmasi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Password
                                Baru</label>
                            <input type="password" name="password" required autocomplete="new-password"
                                placeholder="Minimal 8 karakter"
                                class="w-full bg-stone-50 border @error('password') border-red-300 @else border-stone-200 @enderror rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">
                            @error('password')
                                <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Konfirmasi
                                Password</label>
                            <input type="password" name="password_confirmation" required autocomplete="new-password"
                                placeholder="Ulangi password baru"
                                class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="pt-4 border-t border-stone-100 flex items-center justify-end gap-3">
                        <a href="{{ route('profile.index') }}"
                            class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-stone-200 hover:border-stone-300 rounded-xl transition-colors duration-200">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-slate-900/15">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Update Password
                        </button>
                    </div>

                </div>
            </form>
        </div>

        <!-- Tips Keamanan -->
        <div class="flex items-start gap-3 px-5 py-4 bg-stone-50 border border-stone-200 rounded-2xl">
            <div class="w-7 h-7 rounded-lg bg-slate-900 flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-700 mb-0.5">Tips Keamanan</p>
                <p class="text-xs text-slate-400 leading-relaxed">Gunakan kombinasi huruf besar, huruf kecil, angka, dan
                    simbol. Hindari menggunakan tanggal lahir atau nama sebagai password.</p>
            </div>
        </div>

    </div>
@endsection
