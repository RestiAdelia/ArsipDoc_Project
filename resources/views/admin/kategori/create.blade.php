@extends('layouts.main')

@section('content')
<div class="max-w-xl space-y-5">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-0.5">Administrasi</p>
            <h1 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">Tambah Kategori</h1>
        </div>
        <a href="{{ route('kategori.index') }}"
           class="inline-flex items-center gap-1.5 text-sm text-slate-400 hover:text-slate-700 transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Card -->
    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            <div class="px-8 py-7 space-y-5">

                <!-- Nama Kategori -->
                <div>
                    <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Nama Kategori</label>
                    <input type="text" name="nama_kategori"
                           value="{{ old('nama_kategori') }}"
                           placeholder="Masukkan nama kategori"
                           class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">
                    @error('nama_kategori') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
                </div>

                <!-- Kode Kategori -->
                <div>
                    <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Kode Kategori</label>
                    <input type="text" name="kode_kategori"
                           value="{{ old('kode_kategori') }}"
                           placeholder="Contoh: SK-001"
                           class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">
                    @error('kode_kategori') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                              placeholder="Deskripsi singkat kategori ini"
                              class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200 resize-none">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
                </div>

            </div>

            <!-- Footer Aksi -->
            <div class="px-8 py-5 bg-stone-50 border-t border-stone-100 flex justify-end gap-3">
                <a href="{{ route('kategori.index') }}"
                   class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-stone-200 hover:border-stone-300 rounded-xl transition-colors duration-200">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-slate-900/15">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Simpan
                </button>
            </div>

        </form>
    </div>

</div>
@endsection