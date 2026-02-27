@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    @if(Auth::user()->role === 'superadmin')

        {{-- Form Tambah User --}}
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

            <div class="px-8 py-5 border-b border-stone-100">
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-0.5">Administrasi</p>
                <h3 class="text-base font-semibold text-slate-800" style="font-family: 'Georgia', serif;">Tambah Akun User</h3>
            </div>

            @if(session('success_user'))
                <div class="mx-8 mt-5 flex items-center gap-3 px-5 py-3.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success_user') }}
                </div>
            @endif

            <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Informasi Akun --}}
                <div class="px-8 pt-6 pb-1">
                    <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Informasi Akun</p>
                </div>

                <div class="px-8 py-5 grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Nama Lengkap</label>
                        <input type="text" name="name" placeholder="Nama lengkap"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200"
                               required>
                        @error('name') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Alamat Email</label>
                        <input type="email" name="email" placeholder="Alamat email"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200"
                               required>
                        @error('email') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Password</label>
                        <input type="password" name="password" placeholder="Password"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200"
                               required>
                        @error('password') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200"
                               required>
                    </div>

                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Role</label>
                        <select name="role"
                                class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200"
                                required>
                            <option value="" disabled selected>Pilih role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        @error('role') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Alamat</label>
                        <textarea name="alamat" rows="2" placeholder="Masukkan alamat lengkap"
                                  class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200 resize-none">{{ old('alamat') }}</textarea>
                        @error('alamat') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
                    </div>

                </div>

                {{-- Divider --}}
                <div class="h-px bg-stone-100 mx-8"></div>

                {{-- Foto Profil --}}
                <div class="px-8 pt-6 pb-1">
                    <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Foto Profil</p>
                </div>

                <div class="px-8 pb-6">
                    <div class="border border-dashed border-stone-300 bg-stone-50 rounded-xl px-5 py-4 space-y-2">
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">
                            Upload Foto <span class="normal-case tracking-normal text-slate-300">(JPG / PNG)</span>
                        </label>
                        <input type="file" name="foto" accept="image/*"
                               class="block w-full text-xs text-slate-500
                                   file:mr-3 file:py-1.5 file:px-4
                                   file:rounded-lg file:border-0
                                   file:text-xs file:font-medium
                                   file:bg-slate-900 file:text-white
                                   hover:file:bg-slate-800 file:transition-colors file:cursor-pointer"/>
                        <p class="text-xs text-slate-400">Maksimal 2MB. Biarkan kosong jika tidak diperlukan.</p>
                        @error('foto') <p class="text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Footer Aksi --}}
                <div class="px-8 py-5 bg-stone-50 border-t border-stone-100 flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-slate-900/15">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah User
                    </button>
                </div>

            </form>
        </div>

    @endif

   

</div>
@endsection