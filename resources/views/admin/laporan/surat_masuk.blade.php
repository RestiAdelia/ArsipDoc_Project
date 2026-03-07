@extends('layouts.main')

@section('content')
<div class="space-y-5">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-0.5">Laporan</p>
            <h1 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">Laporan Surat Masuk</h1>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-5 py-3.5 bg-stone-50 border-b border-stone-200">
            <p class="text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Filter Tanggal</p>
        </div>
        <form action="{{ route('laporan.surat-masuk') }}" method="GET" class="p-5">
            <div class="flex flex-col sm:flex-row gap-4 items-end">

                <div class="flex-1">
                    <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Dari Tanggal</label>
                    <input type="date" name="dari" value="{{ request('dari') }}"
                           class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">
                </div>

                <div class="flex-1">
                    <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Sampai Tanggal</label>
                    <input type="date" name="sampai" value="{{ request('sampai') }}"
                           class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200">
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-slate-900/15">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/>
                        </svg>
                        Filter
                    </button>
                    <a href="{{ route('laporan.cetak-pdf', ['jenis' => 'surat_masuk', 'dari' => request('dari'), 'sampai' => request('sampai')]) }}"
                       target="_blank"
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-stone-50 text-red-500 hover:text-red-600 text-sm font-medium border border-stone-200 hover:border-red-200 rounded-xl transition-all duration-200">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                        </svg>
                        Download PDF
                    </a>
                </div>

            </div>
        </form>
    </div>

    <!-- Tabel Card -->
    <div class="border border-stone-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-5 py-3.5 bg-stone-50 border-b border-stone-200 flex items-center justify-between">
            <p class="text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Data Surat Masuk</p>
            <span class="text-[11px] text-slate-400">{{ count($data) }} data</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-stone-200 bg-stone-50/60">
                        <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium w-12">No</th>
                        <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">No. Surat</th>
                        <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Tanggal</th>
                        <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Pengirim</th>
                        <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Asal Surat</th>
                        <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Status</th>

                        
                        <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Perihal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 bg-white">
                    @forelse($data as $key => $item)
                    <tr class="hover:bg-stone-50/60 transition-colors duration-150">
                        <td class="px-5 py-3.5 text-xs text-slate-400">{{ $key + 1 }}</td>
                        <td class="px-5 py-3.5 text-sm font-medium text-slate-800">{{ $item->nomor_surat }}</td>
                        <td class="px-5 py-3.5 text-sm text-slate-600">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($item->tanggal_surat)->format('d M Y') }}
                            </div>
                        </td>
                          
                        <td class="px-5 py-3.5 text-sm text-slate-600">{{ $item->user->name ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-sm text-slate-500 max-w-xs truncate">{{ $item->asal_surat }}</td>
                        <td class="px-5 py-3.5 text-sm text-slate-500 max-w-xs truncate">{{ $item->status }}</td>
                        <td class="px-5 py-3.5 text-sm text-slate-500 max-w-xs truncate">{{ $item->perihal }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-14 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-10 h-10 rounded-2xl bg-stone-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-400">Tidak ada data surat masuk.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection