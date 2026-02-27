@extends('layouts.admin')

@section('title', 'Edit Surat Masuk')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Surat Masuk</h6>
        </div>
        <div class="card-body">
            {{-- Perhatikan route menggunakan ID dan method PUT --}}
            <form action="{{ route('admin.surat_masuk.update', $surat_masuk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nomor_surat" class="form-label">Nomor Surat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $surat_masuk->nomor_surat) }}">
                    @error('nomor_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="asal_surat" class="form-label">Asal Surat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('asal_surat') is-invalid @enderror" id="asal_surat" name="asal_surat" value="{{ old('asal_surat', $surat_masuk->asal_surat) }}">
                    @error('asal_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal_surat" class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('tanggal_surat') is-invalid @enderror" id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat', $surat_masuk->tanggal_surat) }}">
                    @error('tanggal_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="perihal" class="form-label">Perihal <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('perihal') is-invalid @enderror" id="perihal" name="perihal" rows="3">{{ old('perihal', $surat_masuk->perihal) }}</textarea>
                    @error('perihal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">File Surat (Opsional)</label>
                    
                    {{-- Menampilkan link file yang sudah ada --}}
                    @if($surat_masuk->file)
                        <div class="mb-2">
                            <a href="{{ asset('storage/' . $surat_masuk->file) }}" target="_blank" class="text-decoration-none">
                                <i class="fas fa-file-alt"></i> Lihat File Saat Ini
                            </a>
                        </div>
                    @endif

                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file. (Format: PDF, DOC, DOCX. Max 2MB)</small>
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.surat_masuk.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection