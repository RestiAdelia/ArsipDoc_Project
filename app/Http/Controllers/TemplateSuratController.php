<?php

namespace App\Http\Controllers;

use App\Models\KategoriSurat;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;

class TemplateSuratController extends Controller
{
    
    public function create()
    {
        $kategoris = KategoriSurat::all();
        return view('template.create', compact('kategoris'));
    }

    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'nama_template' => 'required',
            'isi_template'  => 'required',
            'kategori_id'   => 'required|exists:kategori_surat,id',
        ]);

        TemplateSurat::create([
            'kategori_id'   => $request->kategori_id,
            'nama_template' => $request->nama_template,
            'isi_template'  => $request->isi_template,
            'field_json'    => $request->field_json, 
        ]);

        return redirect()->route('template.pilih')
            ->with('success', 'Template berhasil ditambahkan');
    }

}