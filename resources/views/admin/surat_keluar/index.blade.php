@extends('layouts.main')

@section('content')
<div class="space-y-5">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-0.5">Administrasi</p>
            <h1 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">Surat Keluar</h1>
        </div>
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto border border-stone-200 rounded-2xl shadow-sm">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b border-stone-200 bg-stone-50">
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">No</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Nomor Surat</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Template</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Tanggal</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium text-center">File</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100 bg-white">
                @forelse($data as $k => $s)
                <tr class="hover:bg-stone-50 transition-colors duration-150">

                    <td class="px-5 py-4 text-slate-400 text-xs">{{ $k + 1 }}</td>

                    <td class="px-5 py-4 text-slate-700 font-medium text-xs">{{ $s->nomor_surat }}</td>

                    <td class="px-5 py-4">
                        <span class="inline-flex px-2.5 py-1 text-[11px] font-medium text-slate-600 bg-stone-100 border border-stone-200 rounded-lg">
                            {{ $s->template->nama_template ?? '—' }}
                        </span>
                    </td>

                    <td class="px-5 py-4">
                        <span class="inline-flex items-center gap-1.5 text-xs text-slate-600">
                            <svg class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                            </svg>
                            {{ optional($s->created_at)->format('d M Y') }}
                        </span>
                    </td>

                    <td class="px-5 py-4 text-center">
                        @if($s->file_pdf)
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ asset('storage/'.$s->file_pdf) }}" target="_blank"
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-slate-600 hover:text-slate-900 bg-white border border-stone-200 hover:border-stone-300 rounded-lg transition-colors duration-200">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Lihat
                                </a>
                                <a href="{{ asset('storage/'.$s->file_pdf) }}" download
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg transition-colors duration-200">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Unduh
                                </a>
                            </div>
                        @else
                            <span class="text-xs text-slate-300 italic">Belum ada file</span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center justify-center gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-stone-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-slate-400">Belum ada data surat keluar.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection