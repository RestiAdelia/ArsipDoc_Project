@extends('layouts.main')

@section('content')
<div class="max-w-5xl mx-auto space-y-4">

    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm px-5 py-3.5 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="javascript:history.back()"
               class="w-8 h-8 flex items-center justify-center rounded-lg border border-stone-200 hover:bg-stone-50 text-slate-400 hover:text-slate-600 transition-colors duration-150">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                </svg>
            </a>
            <div>
                <div class="flex items-center gap-2 mb-0.5">
                    <span class="w-1 h-3 rounded-full" style="background-color: #3E5A76;"></span>
                    <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 font-medium">
                        {{ isset($surat) && $surat ? 'Arsip Surat' : 'Preview Mode' }}
                    </p>
                </div>
                <h1 class="text-base font-semibold text-slate-800" style="font-family: Georgia, serif;">
                    {{ isset($surat) && $surat ? 'Detail Surat Keluar' : 'Cek Draft Surat' }}
                </h1>
            </div>
        </div>

        <div class="flex items-center gap-2">
            @if(isset($surat) && $surat)
                <a href="{{ route('template.pdf', $surat->id) }}" target="_blank"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-xl transition-colors duration-150 shadow-sm shadow-red-600/20">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                    </svg>
                    Export PDF
                </a>
            @else
                <a href="javascript:history.back()">
                    <button type="button"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-white hover:bg-amber-50 text-amber-600 hover:text-amber-700 border border-stone-200 hover:border-amber-200 text-sm font-medium rounded-xl transition-colors duration-150">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                        </svg>
                        Edit Kembali
                    </button>
                </a>
                <form action="{{ route('template.simpan', $template->id) }}" method="POST">
                    @csrf
                    @foreach($dataInput as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-xl transition-colors duration-150 shadow-sm shadow-slate-900/20">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"/>
                        </svg>
                        Simpan Surat
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if(session('warning'))
    <div class="flex items-center gap-2.5 px-4 py-2.5 bg-orange-50 border border-orange-200 rounded-xl text-xs text-orange-700">
        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
        </svg>
        {{ session('warning') }}
    </div>
    @endif
    @if(session('success'))
    <div class="flex items-center gap-2.5 px-4 py-2.5 bg-green-50 border border-green-200 rounded-xl text-xs text-green-700">
        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- BANNER DRAFT --}}
    @if(!(isset($surat) && $surat))
    <div class="flex items-center gap-2.5 px-4 py-2.5 bg-amber-50 border border-amber-200 rounded-xl text-xs text-amber-700">
        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
        </svg>
        Ini adalah <strong class="mx-0.5">preview draft</strong> — surat belum tersimpan. Periksa kembali sebelum menyimpan.
    </div>
    @endif

    {{-- KERTAS SURAT --}}
    <div class="bg-white border border-stone-200 shadow-lg mx-auto"
         style="width: 21cm; min-height: 29.7cm; font-family: 'Times New Roman', serif; font-size: 12pt; line-height: 1.6; padding: 2.5cm 2.5cm 2cm 3cm;">

        {{-- KOP --}}
        <div style="border-bottom: 4px double #000; padding-bottom: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 16px;">
            <img src="{{ asset('storage/instansi/logo.png') }}" style="height: 80px; width: auto;" alt="Logo"
                 onerror="this.style.display='none'">
            <div style="text-align: center; flex: 1;">
                <div style="font-size: 16pt; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px;">
                    {{ $instansi->nama_instansi ?? 'NAMA INSTANSI' }}
                </div>
                <div style="font-size: 10pt; line-height: 1.4;">
                    {{ $instansi->alamat ?? 'Jl. Alamat Instansi No. 1, Kota' }}
                </div>
                <div style="font-size: 10pt;">
                    Telp: {{ $instansi->telepon ?? '-' }}&nbsp;&nbsp;|&nbsp;&nbsp;Email: {{ $instansi->email ?? '-' }}
                </div>
            </div>
        </div>

        {{-- NOMOR, SIFAT, LAMPIRAN, PERIHAL + TANGGAL --}}
        <table style="width: 100%; margin-bottom: 16pt; font-size: 12pt; border-collapse: collapse;">
            <tr>
                <td style="vertical-align: top; width: 55%;">
                    <table style="border-collapse: collapse;">
                        <tr>
                            <td style="width: 80px; padding: 1.5pt 0;">Nomor</td>
                            <td style="padding: 1.5pt 6pt;">:</td>
                            <td style="padding: 1.5pt 0;">{{ $nomor }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 1.5pt 0;">Sifat</td>
                            <td style="padding: 1.5pt 6pt;">:</td>
                            <td style="padding: 1.5pt 0;">{{ $sifat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 1.5pt 0;">Lampiran</td>
                            <td style="padding: 1.5pt 6pt;">:</td>
                            <td style="padding: 1.5pt 0;">{{ $lampiran ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 1.5pt 0;">Perihal</td>
                            <td style="padding: 1.5pt 6pt;">:</td>
                            <td style="padding: 1.5pt 0; font-weight: bold;">
                                {{ $perihal ?? $template->nama_template }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top; text-align: right; font-size: 12pt;">
                    {{ $instansi->kota ?? 'Padang' }},
                    @if(!empty($dataInput['tanggal']))
                        {{ $dataInput['tanggal'] }}
                    @else
                        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                    @endif
                </td>
            </tr>
        </table>

        {{-- TUJUAN --}}
        @if(!empty($tujuan))
        <div style="margin-bottom: 16pt; font-size: 12pt; line-height: 1.8;">
            <p style="margin:0;">Kepada Yth.</p>
            <p style="margin:0;">{{ $tujuan }}</p>
            <p style="margin:0;">di Tempat</p>
        </div>
        @endif

        {{-- ISI SURAT --}}
        <div style="text-align: justify; font-size: 12pt; line-height: 1.8; margin-bottom: 20pt;">
            {!! $isi !!}
        </div>

        {{-- TANDA TANGAN --}}
        <table style="width: 100%; margin-top: 24pt; border-collapse: collapse;">
            <tr>
                <td style="width: 55%;"></td>
                <td style="width: 45%; text-align: center; font-size: 12pt; line-height: 1.8; vertical-align: top;">
                    <p style="margin: 0;">Hormat Kami,</p>
                    <p style="margin: 0;">{{ $instansi->jabatan_pimpinan ?? 'Pimpinan' }}</p>
                    <div style="height: 60pt;"></div>
                    <p style="margin: 0; font-weight: bold; text-decoration: underline;">
                        {{ $instansi->nama_pimpinan ?? '(Nama Pimpinan)' }}
                    </p>
                    <p style="margin: 0; font-size: 11pt;">
                        NIP. {{ $instansi->nip_pimpinan ?? '-' }}
                    </p>
                </td>
            </tr>
        </table>

    </div>

    <div class="h-6"></div>

</div>
@endsection