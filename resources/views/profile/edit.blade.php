@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500 mb-0.5">Akun</p>

                <h1 class="text-xl font-bold text-slate-900" style="font-family: 'Georgia', serif;">Pengaturan Akun</h1>
            </div>

            <div class="inline-flex p-1 bg-stone-100 rounded-xl border border-stone-200">
                <span
                    class="px-5 py-2 text-xs font-bold rounded-lg shadow-sm bg-white text-slate-900 border border-stone-100 cursor-default">
                    Profil
                </span>
                <a href="{{ route('profile.password') }}"
                    class="px-5 py-2 text-xs font-medium rounded-lg text-slate-500 hover:text-slate-700 hover:bg-stone-200/50 transition-colors">
                    Password
                </a>
            </div>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show"
                class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 divide-y lg:divide-y-0 lg:divide-x divide-stone-100">

                    <!-- KOLOM KIRI: Foto & Info -->
                    <div class="lg:col-span-1 py-10 px-6 bg-stone-50/40 flex flex-col items-center text-center">
                        <div class="relative group cursor-pointer" onclick="document.getElementById('input-foto').click()">
                            @if ($user->foto)
                                <img id="preview-foto" src="{{ asset('storage/' . $user->foto) }}"
                                    class="w-36 h-36 rounded-full object-cover border-4 border-white shadow-xl ring-1 ring-stone-200 group-hover:ring-slate-300 transition-all">
                            @else
                                <div id="preview-initials"
                                    class="w-36 h-36 rounded-full bg-slate-900 flex items-center justify-center text-white font-bold text-5xl shadow-xl border-4 border-white ring-1 ring-stone-200">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <img id="preview-foto" src=""
                                    class="w-36 h-36 rounded-full object-cover border-4 border-white shadow-xl hidden">
                            @endif

                            <!-- Overlay Icon -->
                            <div
                                class="absolute inset-0 bg-slate-900/30 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[1px]">
                                <svg class="w-8 h-8 text-white drop-shadow-md" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-5 space-y-3">
                            <label for="input-foto"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-stone-300 rounded-full text-xs font-bold uppercase tracking-wider text-slate-700 hover:border-slate-800 hover:bg-slate-50 transition-all shadow-sm cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                Ganti Foto
                            </label>
                            <input type="file" name="foto" id="input-foto" accept="image/*" class="hidden">

                            <div class="flex flex-col items-center gap-1">
                                <span
                                    class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold uppercase border border-slate-200 tracking-wide">
                                    {{ $user->role }}
                                </span>
                                <p class="text-[10px] text-slate-400">JPG/PNG, Maks. 2MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-2 p-8 space-y-6 bg-white">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Input Nama -->
                            <div class="space-y-1.5 group">
                                <label
                                    class="text-[11px] font-bold text-slate-500 uppercase tracking-wider ml-1 group-focus-within:text-slate-800 transition-colors">Nama
                                    Lengkap</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-slate-800 transition-colors"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $user->name) }}" autocomplete="name"
                                        class="w-full bg-white border @error('name') border-red-500 ring-red-100 @else border-stone-200 group-hover:border-stone-300 @enderror text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-slate-100 focus:border-slate-800 block pl-11 py-3 transition-all shadow-sm placeholder:text-slate-300"
                                        placeholder="Contoh: John Doe">
                                </div>
                                @error('name')
                                    <p class="text-[10px] text-red-500 ml-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Input Email -->
                            <div class="space-y-1.5 group">
                                <label
                                    class="text-[11px] font-bold text-slate-500 uppercase tracking-wider ml-1 group-focus-within:text-slate-800 transition-colors">Alamat
                                    Email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-slate-800 transition-colors"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', $user->email) }}" autocomplete="email"
                                        class="w-full bg-white border @error('email') border-red-500 ring-red-100 @else border-stone-200 group-hover:border-stone-300 @enderror text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-slate-100 focus:border-slate-800 block pl-11 py-3 transition-all shadow-sm placeholder:text-slate-300"
                                        placeholder="nama@email.com">
                                </div>
                                @error('email')
                                    <p class="text-[10px] text-red-500 ml-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Input Telepon -->
                        <div class="space-y-1.5 group">
                            <label
                                class="text-[11px] font-bold text-slate-500 uppercase tracking-wider ml-1 group-focus-within:text-slate-800 transition-colors">Nomor
                                Telepon</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400 group-focus-within:text-slate-800 transition-colors"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <input type="tel" name="phone" id="phone"
                                    value="{{ old('phone', $user->phone) }}" autocomplete="tel"
                                    class="w-full bg-white border @error('phone') border-red-500 ring-red-100 @else border-stone-200 group-hover:border-stone-300 @enderror text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-slate-100 focus:border-slate-800 block pl-11 py-3 transition-all shadow-sm placeholder:text-slate-300"
                                    placeholder="0812xxxx">
                            </div>
                            @error('phone')
                                <p class="text-[10px] text-red-500 ml-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Input Alamat -->
                        <div class="space-y-1.5 group">
                            <label
                                class="text-[11px] font-bold text-slate-500 uppercase tracking-wider ml-1 group-focus-within:text-slate-800 transition-colors">Alamat
                                Domisili</label>
                            <div class="relative">
                                <!-- Icon Align Top -->
                                <div class="absolute top-3.5 left-0 pl-4 pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400 group-focus-within:text-slate-800 transition-colors"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <textarea name="alamat" id="alamat" rows="3" autocomplete="street-address"
                                    class="w-full bg-white border @error('alamat') border-red-500 ring-red-100 @else border-stone-200 group-hover:border-stone-300 @enderror text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-slate-100 focus:border-slate-800 block pl-11 py-3 transition-all shadow-sm resize-none placeholder:text-slate-300 leading-relaxed"
                                    placeholder="Nama jalan, nomor rumah, RT/RW, Kecamatan...">{{ old('alamat', $user->alamat) }}</textarea>
                            </div>
                            @error('alamat')
                                <p class="text-[10px] text-red-500 ml-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Footer Buttons -->
                        <div class="pt-6 mt-2 border-t border-stone-100 flex items-center justify-end gap-3">
                            <a href="{{ route('profile.index') }}"
                                class="px-5 py-2.5 text-xs font-bold text-slate-500 hover:text-slate-800 hover:bg-stone-50 rounded-xl transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/20 active:scale-95 focus:ring-4 focus:ring-slate-900/20">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Preview Foto Logic
        document.getElementById('input-foto').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview-foto');
                    const initials = document.getElementById('preview-initials');

                    preview.src = e.target.result;
                    preview.classList.remove('hidden');

                    if (initials) {
                        initials.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
@endsection
