@extends('layouts.main')

@section('title', 'Edit Kategori Surat')

@section('content')
<div class="max-w-2xl mx-auto space-y-5">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-0.5">
                Kategori Surat
            </p>
            <h1 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">
                Edit Kategori Surat
            </h1>
        </div>

        <a href="{{ route('kategori.index') }}"
           class="inline-flex items-center gap-1.5 text-sm text-slate-400 hover:text-slate-700 transition-colors duration-200">
            ← Kembali
        </a>
    </div>

    <!-- Card Form -->
    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="px-8 py-7 space-y-5">

                <!-- Nama Kategori -->
                <div>
                    <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">
                        Nama Kategori
                    </label>
                    <input type="text"
                           name="nama_kategori"
                           value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                           class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200 @error('nama_kategori') border-red-300 @enderror"
                           required>

                    @error('nama_kategori')
                        <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kode Kategori -->
                <div>
                    <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">
                        Kode Kategori
                    </label>
                    <input type="text"
                           name="kode_kategori"
                           value="{{ old('kode_kategori', $kategori->kode_kategori) }}"
                           class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200 @error('kode_kategori') border-red-300 @enderror"
                           required>

                    @error('kode_kategori')
                        <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">
                        Deskripsi
                        <span class="normal-case tracking-normal text-slate-300">(Opsional)</span>
                    </label>
                    <textarea name="deskripsi" rows="3"
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200 resize-none @error('deskripsi') border-red-300 @enderror">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>

                    @error('deskripsi')
                        <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Footer -->
            <div class="px-8 py-5 bg-stone-50 border-t border-stone-100 flex justify-end gap-3">
                <a href="{{ route('kategori.index') }}"
                   class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-stone-200 hover:border-stone-300 rounded-xl transition-colors duration-200">
                    Batal
                </a>

                <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-slate-900/15">
                    Update Kategori
                </button>
            </div>

        </form>
    </div>

</div>
@endsection