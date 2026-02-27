@extends('layouts.main')

@section('title', 'Tambah Surat Masuk')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Surat Masuk</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.surat_masuk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nomor_surat" class="form-label">Nomor Surat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}" placeholder="Masukkan Nomor Surat">
                    @error('nomor_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="asal_surat" class="form-label">Asal Surat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('asal_surat') is-invalid @enderror" id="asal_surat" name="asal_surat" value="{{ old('asal_surat') }}" placeholder="Contoh: Dinas Pendidikan">
                    @error('asal_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Instansi
    </label>
    <input type="text"
           name="instansi"
           value="{{ old('instansi') }}"
           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
           placeholder="Masukkan instansi"
           required>
</div>

                <div class="mb-3">
                    <label for="tanggal_surat" class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('tanggal_surat') is-invalid @enderror" id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat') }}">
                    @error('tanggal_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="perihal" class="form-label">Perihal <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('perihal') is-invalid @enderror" id="perihal" name="perihal" rows="3" placeholder="Isi perihal surat...">{{ old('perihal') }}</textarea>
                    @error('perihal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Upload File Surat</label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                    <small class="text-muted">Format: PDF, DOC, DOCX. Maksimal 2MB.</small>
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.surat_masuk.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection