@extends('layouts.main')

@section('title', 'Tambah Dokumen')

@section('content')
    <div class="max-w-2xl mx-auto space-y-5">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-0.5">Dokumen</p>
                <h1 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">Input Dokumen Baru
                </h1>
            </div>

        </div>

        <!-- Card Form -->
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">
            <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="px-8 py-7 space-y-5">

                    <!-- Nomor Dokumen -->
                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Nomor
                            Dokumen</label>
                        <input type="text" name="nomor_dokumen" value="{{ old('nomor_dokumen') }}"
                            placeholder="Contoh: 001/SRT/2024"
                            class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">
                        @error('nomor_dokumen')
                            <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Dokumen -->
                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Nama
                            Dokumen / Perihal</label>
                        <input type="text" name="nama_dokumen" value="{{ old('nama_dokumen') }}"
                            placeholder="Masukkan judul dokumen"
                            class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">
                        @error('nama_dokumen')
                            <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal & Jenis -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Tanggal
                                Dokumen</label>
                            <input type="date" name="tanggal_dokumen" value="{{ old('tanggal_dokumen') }}"
                                class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">
                        </div>
                       
                            <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">
                                Jenis Dokumen
                            </label>

                            <select name="kategori_id"
                                class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">

                                <option value="">-- Pilih Kategori --</option>

                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}"
                                        {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">
                        Keterangan <span class="normal-case tracking-normal text-slate-300">(Opsional)</span>
                    </label>
                    <textarea name="keterangan" rows="3"
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200 resize-none">{{ old('keterangan') }}</textarea>
                </div>

                <!-- Upload File -->
                <div class="border border-dashed border-stone-300 bg-stone-50 rounded-xl px-5 py-4 space-y-2">
                    <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium">Upload File <span
                            class="normal-case tracking-normal text-slate-300">(PDF / DOC)</span></label>

                    <input type="file" name="file_dokumen"
                        class="block w-full text-xs text-slate-500
                               file:mr-3 file:py-1.5 file:px-4
                               file:rounded-lg file:border-0
                               file:text-xs file:font-medium
                               file:bg-slate-900 file:text-white
                               hover:file:bg-slate-800 file:transition-colors file:cursor-pointer" />

                    <p class="text-xs text-slate-400">Maksimal ukuran file menyesuaikan konfigurasi server.</p>

                    @error('file_dokumen')
                        <p class="text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

        </div>

        <!-- Footer Aksi -->
        <div class="px-8 py-5 bg-stone-50 border-t border-stone-100 flex justify-end gap-3">
            <a href="{{ route('dokumen.index') }}"
                class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-stone-200 hover:border-stone-300 rounded-xl transition-colors duration-200">
                Batal
            </a>
            <button type="submit"
                class="px-5 py-2.5 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-slate-900/15">
                Simpan Dokumen
            </button>
        </div>

        </form>
    </div>

    </div>
@endsection
