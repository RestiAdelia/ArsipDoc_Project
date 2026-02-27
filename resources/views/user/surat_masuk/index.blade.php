@extends('layouts.main')

@section('title', 'Surat Masuk Saya')

@section('content')
<div class="space-y-5">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-0.5">User</p>
            <h1 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">Daftar Surat Dikirim</h1>
        </div>
        <a href="{{ route('user.surat_masuk.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-slate-900/15">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Kirim Surat
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="flex items-center gap-3 px-5 py-3.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel -->
    <div class="overflow-x-auto border border-stone-200 rounded-2xl shadow-sm">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b border-stone-200 bg-stone-50">
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">No</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Nomor Surat</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Asal Surat</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Perihal</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Tanggal</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium text-center">Status</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium text-center">File</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-stone-100 bg-white">
                @forelse($surat as $index => $item)
                <tr class="hover:bg-stone-50 transition-colors duration-150">

                    <td class="px-5 py-4 text-slate-400 text-xs">{{ $surat->firstItem() + $index }}</td>

                    <td class="px-5 py-4 text-slate-700 font-medium text-xs">{{ $item->nomor_surat }}</td>

                    <td class="px-5 py-4 text-slate-600 text-sm">{{ $item->asal_surat }}</td>

                    <td class="px-5 py-4 text-slate-600 text-sm max-w-xs truncate">{{ Str::limit($item->perihal, 40) }}</td>

                    <td class="px-5 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center gap-1.5 text-xs text-slate-600">
                            <svg class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                            </svg>
                            {{ \Carbon\Carbon::parse($item->tanggal_surat)->format('d M Y') }}
                        </span>
                    </td>

                    <!-- Status Badge -->
                    <td class="px-5 py-4 text-center">
                        @if($item->status == 'pending')
                            <span class="inline-flex px-2.5 py-1 text-[11px] font-medium text-amber-700 bg-amber-50 border border-amber-200 rounded-lg">
                                Pending
                            </span>
                        @elseif($item->status == 'approved')
                            <span class="inline-flex px-2.5 py-1 text-[11px] font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-lg">
                                Disetujui
                            </span>
                        @elseif($item->status == 'rejected')
                            <span class="inline-flex px-2.5 py-1 text-[11px] font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg">
                                Ditolak
                            </span>
                        @else
                            <span class="inline-flex px-2.5 py-1 text-[11px] font-medium text-slate-400 bg-stone-50 border border-stone-200 rounded-lg">
                                —
                            </span>
                        @endif
                    </td>

                    <!-- File -->
                    <td class="px-5 py-4 text-center">
                        @if($item->file)
                            <a href="{{ Storage::url($item->file) }}" target="_blank"
                               class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-600 hover:text-slate-900 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Unduh
                            </a>
                        @else
                            <span class="text-xs text-slate-300 italic">Tidak ada</span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center justify-center gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-stone-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.022.55m0 0l-4.661 2.51m16.5 1.615a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V8.844a2.25 2.25 0 011.183-1.98l7.5-4.04a2.25 2.25 0 012.134 0l7.5 4.04a2.25 2.25 0 011.183 1.98V19.5z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-slate-400">Belum ada surat yang dikirim.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-end">
        {{ $surat->links() }}
    </div>

</div>
@endsection