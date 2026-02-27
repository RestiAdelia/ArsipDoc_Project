@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto space-y-5">

        {{-- HEADER --}}
        <div class="flex items-center justify-between bg-white p-4 rounded-xl shadow-sm border border-stone-200">
            <div>
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-1">
                    {{ isset($surat) && $surat ? 'Arsip Surat' : 'Preview Mode' }}
                </p>
                <h1 class="text-lg font-semibold text-slate-800" style="font-family: Georgia, serif;">
                    {{ isset($surat) && $surat ? 'Detail Surat Keluar' : 'Cek Draft Surat' }}
                </h1>
            </div>

            <div class="flex gap-2">
                @if (isset($surat) && $surat)
                    <a href="{{ route('template.pdf', $surat->id) }}" target="_blank"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg">
                        Export PDF
                    </a>
                @else
                    {{-- SIMPAN --}}
                    <form action="{{ route('template.simpan', $template->id) }}" method="POST">
                        @csrf

                        @foreach ($dataInput as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach

                        <button type="submit"
                            class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-sm rounded-lg">
                            💾 Simpan Surat
                        </button>
                    </form>

                    <form action="{{ route('template.editForm', $template->id) }}" method="POST">
                        @csrf

                        @foreach ($dataInput as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach

                        <button type="submit"
                            class="px-4 py-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-700 border border-yellow-200 text-sm rounded-lg">
                            ✏️ Edit Kembali
                        </button>
                    </form>
                @endif
            </div>
        </div>

        {{-- KERTAS SURAT --}}
        <div class="bg-white border border-stone-200 shadow-lg p-12 min-h-[29.7cm] mx-auto"
            style="width: 21cm; font-family: 'Times New Roman', serif;">

            {{-- KOP --}}
            <div class="border-b-4 border-double border-black pb-4 mb-6 flex items-center gap-4">

                {{-- ✅ LOGO FIX --}}
                <img src="{{ asset('storage/instansi/logo.png') }}" class="h-20 w-auto" alt="Logo"
                    onerror="this.style.display='none'">

                <div class="text-center w-full">
                    <h2 class="text-xl font-bold uppercase">
                        {{ $instansi->nama_instansi ?? 'NAMA INSTANSI' }}
                    </h2>
                    <p class="text-sm">{{ $instansi->alamat ?? 'Alamat Instansi Lengkap' }}</p>
                    <p class="text-sm">
                        Telp: {{ $instansi->telepon ?? '-' }} |
                        Email: {{ $instansi->email ?? '-' }}
                    </p>
                </div>
            </div>

            {{-- NOMOR --}}
            <div class="flex justify-between mb-8 text-sm">
                <table>
                    <tr>
                        <td class="font-bold w-24">Nomor</td>
                        <td>:</td>
                        <td>{{ $nomor }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold">Perihal</td>
                        <td>:</td>
                        <td class="font-bold">{{ $template->nama_template }}</td>
                    </tr>
                </table>

                <div class="text-right">
                    <p>{{ $instansi->kota ?? 'Padang' }},
                        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>

            {{-- ISI --}}
            <div class="text-justify text-black text-base leading-relaxed mb-10">
                {!! $isi !!}
            </div>

            {{-- TTD --}}
            <div class="flex justify-end mt-12">
                <div class="text-center w-64">
                    <p class="mb-20">
                        Hormat Kami,<br>
                        {{ $instansi->jabatan_pimpinan ?? 'Pimpinan' }}
                    </p>

                    <p class="font-bold underline">
                        {{ $instansi->nama_pimpinan ?? '(Nama Pimpinan)' }}
                    </p>
                    <p>NIP. {{ $instansi->nip_pimpinan ?? '-' }}</p>
                </div>
            </div>

        </div>
    </div>
@endsection
