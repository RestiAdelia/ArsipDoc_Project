@extends('layouts.main')

@section('content')
    <div class="space-y-5">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-0.5">Administrasi</p>
                <h1 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">Kategori Surat</h1>
            </div>
            <a href="{{ route('kategori.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-slate-900/15">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kategori
            </a>
        </div>

        <!-- Tabel -->
        <div class="overflow-x-auto border border-stone-200 rounded-2xl shadow-sm">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-stone-200 bg-stone-50">
                        <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">No</th>
                        <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Nama
                            Kategori</th>
                        <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Kode</th>
                        <th class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium">Deskripsi
                        </th>
                        <th
                            class="px-5 py-3.5 text-[11px] uppercase tracking-[0.15em] text-slate-400 font-medium text-center">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 bg-white">
                    @forelse($kategori as $k)
                        <tr class="hover:bg-stone-50 transition-colors duration-150">

                            <td class="px-5 py-4 text-slate-400 text-xs">
                                {{ $kategori->firstItem() + $loop->index }}
                            </td>

                            <td class="px-5 py-4 text-slate-800 font-medium text-sm">{{ $k->nama_kategori }}</td>

                            <td class="px-5 py-4">
                                <span
                                    class="inline-flex px-2.5 py-1 text-[11px] font-medium text-slate-600 bg-stone-100 border border-stone-200 rounded-lg">
                                    {{ $k->kode_kategori }}
                                </span>
                            </td>

                            <td class="px-5 py-4 text-slate-500 text-sm max-w-xs truncate">
                                {{ $k->deskripsi ?? '—' }}
                            </td>

                            <td class="px-5 py-4 text-center">
                                <a href="{{ route('kategori.edit', $k->id) }}"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-slate-600 hover:text-slate-900 bg-white border border-stone-200 hover:border-stone-300 rounded-lg transition-colors duration-200">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-600 hover:text-red-900 bg-white border border-stone-200 hover:border-red-300 rounded-lg transition-colors duration-200">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-12 h-12 rounded-2xl bg-stone-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm text-slate-400">Belum ada kategori surat.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="flex justify-end mt-4">
                {{ $kategori->links() }}
            </div>
        </div>

    </div>
@endsection
