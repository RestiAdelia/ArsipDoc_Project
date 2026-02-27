<?php

namespace App\Http\Controllers;

use App\Models\KategoriSurat;
use Illuminate\Http\Request;
use Pest\Support\View;

class KategoriSuratController extends Controller
{
    public function index()
    {
        $kategori = KategoriSurat::latest()->paginate(10);
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:255',
            'kode_kategori' => 'required|max:20|unique:kategori_surat,kode_kategori',
        ]);

        KategoriSurat::create($request->all());

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }
    public function edit($id)
    {
        $kategori = KategoriSurat::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }
    public function update(Request $request, KategoriSurat $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|max:255',
            'kode_kategori' => 'required|max:20|unique:kategori_surat,kode_kategori,' . $kategori->id,
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

   public function destroy($id)
    {
        $kategori = KategoriSurat::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}