    @extends('layouts.main')

    @section('content')
    <div class="max-w-3xl mx-auto">

        <h1 class="text-xl font-semibold mb-4">
            Tambah Template Surat
        </h1>

        <form method="POST" action="{{ route('template.store') }}">
            @csrf

            {{-- ✅ KATEGORI --}}
            <div class="mb-4">
                <label class="block text-sm mb-1">Kategori</label>
                <select name="kategori_id"
                    class="w-full border rounded-lg px-3 py-2" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}">
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Nama --}}
            <div class="mb-4">
                <label class="block text-sm mb-1">Nama Template</label>
                <input type="text" name="nama_template"
                    class="w-full border rounded-lg px-3 py-2" required>
            </div>

            {{-- Isi Template --}}
            <div class="mb-4">
                <label class="block text-sm mb-1">Isi Template</label>
                <textarea name="isi_template" rows="8"
                    class="w-full border rounded-lg px-3 py-2"
                    placeholder="Contoh: Dengan ini  ..."
                    required></textarea>
            </div>

            {{-- Field JSON --}}
            <div class="mb-4">
                <label class="block text-sm mb-1">Field JSON</label>
                <textarea name="field_json" rows="6"
                    class="w-full border rounded-lg px-3 py-2"
                    placeholder='[{"name":"nama","label":"Nama","type":"text"}]'
                    required></textarea>
            </div>

            <button class="px-4 py-2 bg-slate-900 text-white rounded-lg">
                Simpan Template
            </button>
        </form>

    </div>
    @endsection