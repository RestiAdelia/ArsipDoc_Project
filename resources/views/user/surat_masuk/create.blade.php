@extends('layouts.main')

@section('content')
<div class="max-w-2xl mx-auto space-y-5">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-0.5">
                Surat Masuk
            </p>
            <h1 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">
                Form Surat Masuk Baru
            </h1>
        </div>

        <a href="{{ route('user.surat_masuk.index') }}"
           class="inline-flex items-center gap-1.5 text-sm text-slate-400 hover:text-slate-700 transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Card Form -->
    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">
        <form action="{{ route('user.surat_masuk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="px-8 py-7 space-y-5">

                <!-- Nomor Surat -->
                <div>
                    <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">
                        Nomor Surat
                    </label>
                    <input type="text"
                           name="nomor_surat"
                           value="{{ old('nomor_surat') }}"
                           placeholder="Contoh: 001/S-Masuk/2024"
                           class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200 @error('nomor_surat') border-red-300 @enderror"
                           required>
                    @error('nomor_surat')
                        <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Asal Surat & Instansi -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Asal Surat -->
                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">
                            Asal Surat
                        </label>
                        <input type="text"
                               name="asal_surat"
                               value="{{ old('asal_surat') }}"
                               placeholder="Contoh: Dinas Pendidikan"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200 @error('asal_surat') border-red-300 @enderror"
                               required>
                        @error('asal_surat')
                            <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Instansi -->
                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">
                            Instansi
                        </label>
                        <input type="text"
                               name="instansi"
                               value="{{ old('instansi') }}"
                               placeholder="Masukkan instansi"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200 @error('instansi') border-red-300 @enderror"
                               required>
                        @error('instansi')
                            <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Tanggal Surat -->
                <div>
                    <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">
                        Tanggal Surat
                    </label>
                    <input type="date"
                           name="tanggal_surat"
                           value="{{ old('tanggal_surat') }}"
                           class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200 @error('tanggal_surat') border-red-300 @enderror"
                           required>
                    @error('tanggal_surat')
                        <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Perihal -->
                <div>
                    <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">
                        Perihal
                    </label>
                    <textarea name="perihal"
                              rows="3"
                              placeholder="Jelaskan perihal surat secara singkat"
                              class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200 resize-none @error('perihal') border-red-300 @enderror"
                              required>{{ old('perihal') }}</textarea>
                    @error('perihal')
                        <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload File -->
                <div class="border border-dashed border-stone-300 bg-stone-50 rounded-xl px-5 py-4 space-y-2">
                    <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">
                        Upload File (PDF / DOC / DOCX)
                    </label>

                    <input type="file"
                           name="file"
                           class="block w-full text-xs text-slate-500
                               file:mr-3 file:py-1.5 file:px-4
                               file:rounded-lg file:border-0
                               file:text-xs file:font-medium
                               file:bg-slate-900 file:text-white
                               hover:file:bg-slate-800 file:transition-colors file:cursor-pointer
                               @error('file') border-red-300 @enderror"
                           required>

                    <p class="text-xs text-slate-400">Maksimal ukuran file 2MB.</p>

                    @error('file')
                        <p class="text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Footer -->
            <div class="px-8 py-5 bg-stone-50 border-t border-stone-100 flex justify-end gap-3">
                <a href="{{ route('user.surat_masuk.index') }}"
                   class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-stone-200 hover:border-stone-300 rounded-xl transition-colors duration-200">
                    Batal
                </a>

                <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-slate-900/15">
                    Kirim Surat
                </button>
            </div>

        </form>
    </div>

</div>
@endsection 