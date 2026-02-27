@extends('layouts.main')

@section('content')
<div class="space-y-5">

    <!-- Header -->
    <div>
        <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-0.5">Surat Keluar</p>
        <h1 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">Pilih Template Surat</h1>
    </div>

    <!-- Grid Template -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($templates as $t)

        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 overflow-hidden flex flex-col">

            <!-- Mini Kop -->
            <div class="px-6 pt-5 pb-4 border-b-2 border-double border-stone-300 bg-stone-50">
                <div class="flex items-start justify-between gap-2">
                    <div class="w-8 h-8 rounded-lg bg-slate-900 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                    </div>
                    <span class="inline-flex px-2 py-0.5 text-[10px] font-medium text-slate-500 bg-white border border-stone-200 rounded-lg flex-shrink-0">
                        {{ $t->kategori->nama_kategori ?? '—' }}
                    </span>
                </div>
                <h3 class="text-sm font-bold text-slate-800 mt-3 leading-snug" style="font-family: 'Times New Roman', serif;">
                    {{ strtoupper($t->nama_template) }}
                </h3>
            </div>

            <!-- Preview -->
            <div class="px-6 py-4 flex-1" style="font-family: 'Times New Roman', serif;">
                <table class="w-full mb-3" style="font-size: 11px; color: #64748b;">
                    <tr>
                        <td width="60px">Nomor</td>
                        <td width="10px">:</td>
                        <td class="italic">............/{{ date('Y') }}</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>:</td>
                        <td class="font-semibold text-slate-700">{{ $t->nama_template }}</td>
                    </tr>
                </table>

                <div class="h-px bg-stone-100 mb-3"></div>

                @php
                    $preview = preg_replace('/{{.*?}}/', '________', $t->isi_template);
                    $preview = \Illuminate\Support\Str::limit(strip_tags($preview), 180);
                @endphp
                <p class="text-slate-400 leading-relaxed" style="font-size: 11px; text-align: justify;">
                    {{ $preview }}
                </p>

                <!-- Placeholder TTD -->
                <div class="flex justify-end mt-4">
                    <div class="text-center" style="font-size: 10px; color: #94a3b8;">
                        <p>............, .................. {{ date('Y') }}</p>
                        <p class="mt-1">{{ $t->jabatan ?? 'Pejabat Berwenang' }}</p>
                        <div class="mt-6 mb-1 border-b border-dashed border-stone-300 w-28 mx-auto"></div>
                        <p class="italic">( Tanda Tangan )</p>
                    </div>
                </div>
            </div>

            <!-- Footer Aksi -->
           <!-- Footer Aksi -->
<div class="px-6 py-4 bg-stone-50 border-t border-stone-100 flex gap-2">
    <button onclick="openPreview(this)"
            data-template="{{ addslashes(strip_tags($t->isi_template)) }}"
            class="flex-1 inline-flex items-center justify-center gap-1.5 px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 bg-white border border-stone-200 hover:border-stone-300 rounded-xl transition-colors duration-200">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        Preview
    </button>
    <a href="{{ route('template.form', $t->id) }}"
       class="flex-1 inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-xl transition-all duration-200">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
        </svg>
        Gunakan
    </a>
</div>

        </div>

        @empty
        <div class="col-span-3 flex flex-col items-center justify-center py-16 border border-dashed border-stone-300 rounded-2xl bg-white">
            <div class="w-12 h-12 rounded-2xl bg-stone-100 flex items-center justify-center mb-3">
                <svg class="w-6 h-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                </svg>
            </div>
            <p class="text-sm text-slate-400">Belum ada template surat tersedia.</p>
        </div>
        @endforelse
    </div>

</div>

<!-- Modal Preview -->
<div id="modalPreview" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-6">
    <div class="bg-white w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-2xl shadow-xl border border-stone-200">

        <!-- Modal Header -->
        <div class="flex items-center justify-between px-7 py-5 border-b border-stone-100">
            <div>
                <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400">Pratinjau</p>
                <h3 class="text-base font-semibold text-slate-800" style="font-family: 'Georgia', serif;">Preview Template</h3>
            </div>
            <button onclick="closePreview()"
                    class="w-8 h-8 rounded-lg bg-stone-100 hover:bg-stone-200 flex items-center justify-center text-slate-500 transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Modal Body: Tampilan Surat -->
        <div class="px-10 py-8" style="font-family: 'Times New Roman', serif;">

           <div class="border-b-4 border-double border-black pb-4 mb-6 flex items-center gap-4">
           <img src="{{ isset($instansi->logo) ? asset('storage/'.$instansi->logo) : asset('storage/instansi/logo.png') }}"
     class="w-20 h-20 object-contain"
     alt="Logo"
     onerror="this.style.display='none'">
            
            <div class="text-center w-full">
                <h2 class="text-xl font-bold uppercase">{{ $instansi->nama_instansi ?? 'NAMA INSTANSI' }}</h2>
                <p class="text-sm">{{ $instansi->alamat ?? 'Alamat Instansi Lengkap' }}</p>
                <p class="text-sm">Telp: {{ $instansi->telepon ?? '-' }} | Email: {{ $instansi->email ?? '-' }}</p>
            </div>
        </div>


            <!-- Info Surat -->
            <table class="mb-4" style="font-size: 12px;">
                <tr>
                    <td width="80px" class="pb-1">Nomor</td>
                    <td width="12px" class="pb-1">:</td>
                    <td class="pb-1 text-slate-400 italic">............/........./{{ date('Y') }}</td>
                </tr>
                <tr>
                    <td class="pb-1">Perihal</td>
                    <td class="pb-1">:</td>
                    <td class="pb-1 font-semibold">Template Surat</td>
                </tr>
            </table>

            <!-- Isi Surat -->
            <div id="previewContent"
                 class="text-slate-700 leading-relaxed whitespace-pre-line"
                 style="font-size: 12px; text-align: justify;">
            </div>

            <!-- TTD -->
            <div class="flex justify-end mt-8">
                <div class="text-center" style="font-size: 11px; color: #64748b;">
                    <p>............, .................. {{ date('Y') }}</p>
                    <p class="mt-1">Pejabat Berwenang,</p>
                    <div class="mt-10 mb-1 border-b border-slate-400 w-36 mx-auto"></div>
                    <p class="font-semibold text-slate-700">( Nama Pejabat )</p>
                    <p>NIP. ........................</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function openPreview(btn) {
    let hasil = btn.dataset.template;
    hasil = hasil.replace(/\{\{.*?\}\}/g, '________');
    document.getElementById('previewContent').innerText = hasil;
    const modal = document.getElementById('modalPreview');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closePreview() {
    const modal = document.getElementById('modalPreview');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

document.getElementById('modalPreview').addEventListener('click', function(e) {
    if (e.target === this) closePreview();
});
</script>

@endsection