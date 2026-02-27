<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\KategoriSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
   public function index()
{
    $data = Dokumen::with('kategori')->latest()->paginate(10);
    return view('dokumen.index', compact('data'));
}

    // form tambah
    public function create()
    {
        // return view('dokumen.create');
        $kategori = KategoriSurat::orderBy('nama_kategori')->get();
        return view('dokumen.create', compact('kategori'));
    }

    // simpan
    public function store(Request $request)
    {
        $request->validate([
            'nomor_dokumen' => 'required',
            'nama_dokumen' => 'required',
            'kategori_id' => 'required',
            'file_dokumen' => 'required|file|mimes:pdf,doc,docx',
        ]);

        // upload file
        $file = $request->file('file_dokumen');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('dokumen', $filename, 'public');


        Dokumen::create([
            'nomor_dokumen' => $request->nomor_dokumen,
            'nama_dokumen' => $request->nama_dokumen,
            'tanggal_dokumen' => $request->tanggal_dokumen,
            'kategori_id' => $request->kategori_id,
            'file_dokumen' => $filename,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('dokumen.index')
            ->with('success', 'Dokumen berhasil ditambahkan');
    }

    // form edit
    public function edit($id)

    {

        $kategori = KategoriSurat::orderBy('nama_kategori')->get();
        $data = Dokumen::findOrFail($id);
        return view('dokumen.edit', compact('data', 'kategori'));
    }

    // update
    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // jika upload file baru
        if ($request->hasFile('file_dokumen')) {

            // hapus file lama
            Storage::delete('public/dokumen/' . $dokumen->file_dokumen);

            $file = $request->file('file_dokumen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('dokumen', $filename, 'public');


            $dokumen->file_dokumen = $filename;
        }

        $dokumen->update([
            'nomor_dokumen' => $request->nomor_dokumen,
            'nama_dokumen' => $request->nama_dokumen,
            'tanggal_dokumen' => $request->tanggal_dokumen,

            'kategori_id' => $request->kategori_id,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('dokumen.index')
            ->with('success', 'Dokumen berhasil diupdate');
    }

    // hapus
    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        Storage::delete('public/dokumen/' . $dokumen->file_dokumen);
        $dokumen->delete();

        return back()->with('success', 'Dokumen berhasil dihapus');
    }
}
