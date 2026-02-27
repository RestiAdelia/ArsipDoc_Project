@extends('layouts.main')

@section('content')
<div class="max-w-2xl mx-auto space-y-5">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-0.5">Akun</p>
            <h1 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">Edit Profil</h1>
        </div>
        <a href="{{ route('profile.index') }}"
           class="inline-flex items-center gap-1.5 text-sm text-slate-400 hover:text-slate-700 transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="role" value="{{ $user->role }}">

            {{-- Foto Profil --}}
            <div class="px-8 pt-7 pb-1">
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Foto Profil</p>
            </div>

            <div class="px-8 py-5">
                <div class="flex items-center gap-5">

                    {{-- Preview --}}
                    <div class="flex-shrink-0">
                        @if($user->foto)
                            <img id="preview-foto"
                                 src="{{ asset('storage/'.$user->foto) }}"
                                 alt="{{ $user->name }}"
                                 class="w-16 h-16 rounded-2xl object-cover border border-stone-200">
                        @else
                            <div id="preview-initials"
                                 class="w-16 h-16 rounded-2xl bg-slate-900 flex items-center justify-center text-white font-semibold text-xl"
                                 style="font-family: 'Georgia', serif;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <img id="preview-foto"
                                 src=""
                                 alt="Preview"
                                 class="w-16 h-16 rounded-2xl object-cover border border-stone-200 hidden">
                        @endif
                    </div>

                    <div class="flex-1 border border-dashed border-stone-300 bg-stone-50 rounded-xl px-5 py-4 space-y-2">
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">
                            Ganti Foto <span class="normal-case tracking-normal text-slate-300">(JPG / PNG)</span>
                        </label>
                        <input type="file" name="foto" id="input-foto" accept="image/*"
                               class="block w-full text-xs text-slate-500
                                   file:mr-3 file:py-1.5 file:px-4
                                   file:rounded-lg file:border-0
                                   file:text-xs file:font-medium
                                   file:bg-slate-900 file:text-white
                                   hover:file:bg-slate-800 file:transition-colors file:cursor-pointer"/>
                        <p class="text-xs text-slate-400">Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah.</p>
                        @error('foto') <p class="text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="h-px bg-stone-100 mx-8"></div>

            {{-- Informasi Akun --}}
            <div class="px-8 pt-6 pb-1">
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Informasi Akun</p>
            </div>

            <div class="px-8 py-5 space-y-5">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- Nama -->
                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Nama Lengkap</label>
                        <input type="text" name="name"
                               value="{{ old('name', $user->name) }}"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">
                        @error('name') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Alamat Email</label>
                        <input type="email" name="email"
                               value="{{ old('email', $user->email) }}"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">
                        @error('email') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Nomor Telepon</label>
                        <input type="tel" name="phone"
                               value="{{ old('phone', $user->phone) }}"
                               placeholder="Contoh: 08123456789"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">
                        @error('phone') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
                    </div>

                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Alamat</label>
                    <textarea name="alamat" rows="2"
                              placeholder="Masukkan alamat lengkap"
                              class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200 resize-none">{{ old('alamat', $user->alamat) }}</textarea>
                    @error('alamat') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
                </div>

            </div>

            <div class="h-px bg-stone-100 mx-8"></div>

            {{-- Ganti Password --}}
            <div class="px-8 pt-6 pb-1">
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Ganti Password</p>
                <p class="text-xs text-slate-400 mt-0.5">Biarkan kosong jika tidak ingin mengubah password.</p>
            </div>

            <div class="px-8 py-5 space-y-5">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Password Baru</label>
                        <input type="password" name="password"
                               placeholder="Masukkan password baru"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">
                        @error('password') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                               placeholder="Ulangi password baru"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">
                    </div>
                </div>

            </div>

            <!-- Footer Aksi -->
            <div class="px-8 py-5 bg-stone-50 border-t border-stone-100 flex justify-end gap-3">
                <a href="{{ route('profile.index') }}"
                   class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-stone-200 hover:border-stone-300 rounded-xl transition-colors duration-200">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-slate-900/15">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

</div>

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