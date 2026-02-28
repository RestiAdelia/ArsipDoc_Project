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

    
    public function form(Request $request)
    {
        $kategori = KategoriSurat::all();

        $templates = collect();
        if ($request->kategori_id) {
            $templates = TemplateSurat::where('kategori_id', $request->kategori_id)->get();
        }

        $template = null;
        if ($request->template_id) {
            $template = TemplateSurat::find($request->template_id);
        }

        return view('template.form_dinamis', compact(
            'kategori',
            'templates',
            'template'
        ));
    }

    public function generate(Request $request, $id)
    {
        $template = TemplateSurat::findOrFail($id);

        $isi = $template->isi_template;

        // 🔥 ganti {{field}}
        foreach ($request->except('_token', 'template_id') as $key => $value) {
            $isi = str_replace('{{' . $key . '}}', $value, $isi);
        }

        return view('template.preview', [
            'template' => $template,
            'isi' => $isi
        ]);
    }
}