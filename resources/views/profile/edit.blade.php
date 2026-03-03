@extends('layouts.main')

@section('content')
<div class="max-w-5xl mx-auto space-y-5">
    <!-- Form Card dengan layout 2 kolom -->
    <div class="bg-white rounded-xl border border-stone-200/70 shadow-md overflow-hidden">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="role" value="{{ $user->role }}">

            <div class="grid grid-cols-1 lg:grid-cols-3 divide-y lg:divide-y-0 lg:divide-x divide-stone-100">
                
                <!-- SIDEBAR KIRI: Foto & Role Info -->
                <div class="lg:col-span-1 p-6 bg-stone-50/50">
                    <div class="space-y-6 sticky top-6">
                        <!-- Section Title -->
                        <div>
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-1 h-5 bg-secondary rounded-full"></div>
                                <h3 class="text-xs font-semibold uppercase tracking-wider" style="color: #141E30;">Foto Profil</h3>
                            </div>
                            
                            <!-- Preview Foto -->
                            <div class="flex flex-col items-center text-center">
                                <div class="relative group mb-4">
                                    @if($user->foto)
                                        <img id="preview-foto"
                                             src="{{ asset('storage/'.$user->foto) }}"
                                             alt="{{ $user->name }}"
                                             class="w-32 h-32 rounded-2xl object-cover border-4 border-white shadow-xl ring-4 ring-secondary/10 group-hover:ring-secondary/30 transition-all duration-300">
                                    @else
                                        <div id="preview-initials"
                                             class="w-32 h-32 rounded-2xl bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white font-bold text-5xl shadow-xl ring-4 ring-secondary/10"
                                             style="background: linear-gradient(135deg, #141E30, #3E5A76);">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <img id="preview-foto"
                                             src=""
                                             alt="Preview"
                                             class="w-32 h-32 rounded-2xl object-cover border-4 border-white shadow-xl hidden">
                                    @endif
                                    
                                    <!-- Status indicator -->
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-400 rounded-full border-3 border-white"></div>
                                </div>
                                
                                <!-- Upload Area -->
                                <div class="w-full">
                                    <label for="input-foto" class="block w-full cursor-pointer">
                                        <div class="border-2 border-dashed border-stone-300 bg-white rounded-xl p-4 hover:border-secondary hover:bg-secondary/5 transition-all duration-200">
                                            <svg class="w-6 h-6 text-slate-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                            </svg>
                                            <p class="text-xs text-slate-500">Klik untuk upload foto</p>
                                            <p class="text-[9px] text-slate-400 mt-1">JPG/PNG, maks 2MB</p>
                                        </div>
                                    </label>
                                    <input type="file" name="foto" id="input-foto" accept="image/*" class="hidden">
                                    @error('foto') <p class="text-[10px] text-red-400 mt-2 text-center">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Info Role Card -->
                        <div class="bg-white rounded-xl border border-stone-200 p-4">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-7 h-7 rounded-lg bg-secondary/10 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-slate-600">Role Akun</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold capitalize" style="color: #141E30;">{{ $user->role }}</span>
                                <span class="px-2 py-1 bg-primary/10 text-primary text-[9px] font-medium rounded-full">Tidak dapat diubah</span>
                            </div>
                            <p class="text-[9px] text-slate-400 mt-2">Role ditentukan oleh administrator sistem</p>
                        </div>
                    </div>
                </div>

                <!-- SIDEBAR KANAN: Form Fields -->
                <div class="lg:col-span-2 p-6">
                    <div class="space-y-6">
                        
                        <!-- Informasi Pribadi Section -->
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-1 h-4 bg-secondary rounded-full"></div>
                                <h3 class="text-xs font-semibold uppercase tracking-wider" style="color: #141E30;">Informasi Pribadi</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Nama -->
                                <div class="space-y-1.5">
                                    <label class="block text-[10px] uppercase tracking-wider text-slate-400 font-medium">Nama Lengkap</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                            </svg>
                                        </div>
                                        <input type="text" name="name"
                                               value="{{ old('name', $user->name) }}"
                                               class="w-full bg-stone-50 border border-stone-200 rounded-lg pl-10 pr-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary/20 transition-all">
                                    </div>
                                    @error('name') <p class="text-[10px] text-red-400 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Email -->
                                <div class="space-y-1.5">
                                    <label class="block text-[10px] uppercase tracking-wider text-slate-400 font-medium">Alamat Email</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                            </svg>
                                        </div>
                                        <input type="email" name="email"
                                               value="{{ old('email', $user->email) }}"
                                               class="w-full bg-stone-50 border border-stone-200 rounded-lg pl-10 pr-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary/20 transition-all">
                                    </div>
                                    @error('email') <p class="text-[10px] text-red-400 mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Kontak Section -->
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-1 h-4 bg-secondary rounded-full"></div>
                                <h3 class="text-xs font-semibold uppercase tracking-wider" style="color: #141E30;">Kontak</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Phone -->
                                <div class="space-y-1.5">
                                    <label class="block text-[10px] uppercase tracking-wider text-slate-400 font-medium">Nomor Telepon</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                            </svg>
                                        </div>
                                        <input type="tel" name="phone"
                                               value="{{ old('phone', $user->phone) }}"
                                               placeholder="08123456789"
                                               class="w-full bg-stone-50 border border-stone-200 rounded-lg pl-10 pr-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary/20 transition-all">
                                    </div>
                                    @error('phone') <p class="text-[10px] text-red-400 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Alamat (full width) -->
                                <div class="md:col-span-2 space-y-1.5">
                                    <label class="block text-[10px] uppercase tracking-wider text-slate-400 font-medium">Alamat</label>
                                    <div class="relative">
                                        <div class="absolute top-3 left-0 pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                            </svg>
                                        </div>
                                        <textarea name="alamat" rows="3"
                                                  placeholder="Masukkan alamat lengkap"
                                                  class="w-full bg-stone-50 border border-stone-200 rounded-lg pl-10 pr-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary/20 transition-all resize-none">{{ old('alamat', $user->alamat) }}</textarea>
                                    </div>
                                    @error('alamat') <p class="text-[10px] text-red-400 mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Keamanan Section -->
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-1 h-4 bg-secondary rounded-full"></div>
                                <h3 class="text-xs font-semibold uppercase tracking-wider" style="color: #141E30;">Keamanan</h3>
                            </div>
                            
                            <div class="bg-stone-50/80 rounded-xl border border-stone-200 p-4 space-y-4">
                                <p class="text-[10px] text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Kosongkan jika tidak ingin mengubah password
                                </p>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-1.5">
                                        <label class="block text-[10px] uppercase tracking-wider text-slate-400 font-medium">Password Baru</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                                </svg>
                                            </div>
                                            <input type="password" name="password"
                                                   placeholder="Minimal 8 karakter"
                                                   class="w-full bg-white border border-stone-200 rounded-lg pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary/20 transition-all">
                                        </div>
                                        @error('password') <p class="text-[10px] text-red-400 mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="space-y-1.5">
                                        <label class="block text-[10px] uppercase tracking-wider text-slate-400 font-medium">Konfirmasi</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <input type="password" name="password_confirmation"
                                                   placeholder="Ulangi password"
                                                   class="w-full bg-white border border-stone-200 rounded-lg pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary/20 transition-all">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Aksi -->
            <div class="px-6 py-4 bg-stone-50/80 border-t border-stone-100 flex items-center justify-end gap-3">
                <a href="{{ route('profile.index') }}"
                   class="px-4 py-2 text-xs font-medium text-slate-600 hover:text-slate-800 bg-white border border-stone-200 hover:border-stone-300 rounded-lg transition-all duration-200">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2 text-xs font-medium text-white bg-primary hover:bg-secondary rounded-lg transition-all duration-200 hover:-translate-y-0.5 shadow-sm shadow-primary/20 inline-flex items-center gap-2"
                        style="background-color: #141E30;">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

</div>

<!-- Script Preview Foto -->
<script>
    const inputFoto = document.getElementById('input-foto');
    const previewFoto = document.getElementById('preview-foto');
    const previewInitials = document.getElementById('preview-initials');

    inputFoto.addEventListener('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewFoto.src = e.target.result;
                previewFoto.classList.remove('hidden');
                if (previewInitials) previewInitials.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection