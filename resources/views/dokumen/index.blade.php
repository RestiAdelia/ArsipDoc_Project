@extends('layouts.main')

@section('title', 'Arsip Dokumen')

@section('content')
<div class="space-y-5">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-0.5">Manajemen</p>
            <h1 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">Arsip Dokumen</h1>
        </div>
        <a href="{{ route('dokumen.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-slate-900/15">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Dokumen
        </a>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="flex items-center gap-3 px-5 py-3.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <span><span class="font-medium">Berhasil!</span> {{ session('success') }}</span>
        </div>
    @endif

    <!-- Tabel -->
    <div class="overflow-x-auto border border-stone-200 rounded-2xl shadow-sm">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b border-stone-200 bg-stone-50">
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">No</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Nomor</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Nama / Perihal</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Tanggal</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Jenis</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">File</th>
                    <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100 bg-white">
                @forelse($data as $item)
                <tr class="hover:bg-stone-50 transition-colors duration-150">

                    <td class="px-5 py-4 text-slate-400 text-xs">{{ $data->firstItem() + $loop->index }}</td>

                    <td class="px-5 py-4 text-slate-600 font-medium text-xs">{{ $item->nomor_dokumen }}</td>

                    <td class="px-5 py-4">
                        <p class="text-slate-800 font-medium text-sm">{{ $item->nama_dokumen }}</p>
                        @if($item->keterangan)
                            <p class="text-xs text-slate-400 truncate max-w-xs mt-0.5">{{ $item->keterangan }}</p>
                        @endif
                    </td>

                    <td class="px-5 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center gap-1.5 text-xs text-slate-600">
                            <svg class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                            </svg>
                            {{ \Carbon\Carbon::parse($item->tanggal_dokumen)->format('d M Y') }}
                        </span>
                    </td>

                    <td class="px-5 py-4">
                        <span class="inline-flex px-2.5 py-1 text-[11px] font-medium text-slate-600 bg-stone-100 border border-stone-200 rounded-lg">
                            {{ $item->kategori->nama_kategori ?? '—' }}
                        </span>
                    </td>

                    <td class="px-5 py-4">
                        @if($item->file_dokumen)
                            <a href="{{ asset('storage/dokumen/'.$item->file_dokumen) }}" target="_blank"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-slate-600 hover:text-slate-900 bg-white border border-stone-200 hover:border-stone-300 rounded-lg transition-colors duration-200">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Unduh
                            </a>
                        @else
                            <span class="text-xs text-slate-300 italic">—</span>
                        @endif
                    </td>

                    <td class="px-5 py-4">
                        <div class="flex items-center justify-center gap-1.5">

                            <a href="{{ route('dokumen.edit', $item->id) }}"
                               class="p-1.5 text-slate-500 hover:text-slate-900 hover:bg-stone-100 rounded-lg transition-colors duration-150"
                               title="Edit">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                                </svg>
                            </a>

                            <form action="{{ route('dokumen.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="p-1.5 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-150"
                                        title="Hapus">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center justify-center gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-stone-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-slate-400">Belum ada data dokumen yang diarsipkan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-end">
        {{ $data->links() }}
    </div>

</div>
@endsection