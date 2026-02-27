<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\TemplateSurat;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tetap dipakai untuk logic lain jika perlu, tapi tidak disimpan ke DB
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class GenerateSuratController extends Controller
{

    public function pilihTemplate()
    {
        $templates = TemplateSurat::with('kategori')->latest()->get();
        return view('template.pilih_template', compact('templates'));
    }

    /**
     * 2️⃣ Form dinamis berdasarkan template
     */
    public function form($id)
    {
        $template = TemplateSurat::findOrFail($id);

        // decode field json dari template
        $fields = $template->field_json ?? [];

        return view('template.form_dinamis', compact('template', 'fields'));
    }


    private function generateNomorSurat($kategoriId = null)
    {
        $last = SuratKeluar::latest()->first();
        $next = $last ? $last->id + 1 : 1;

        return sprintf(
            "%03d/RTS/%02d/%s",
            $next,
            now()->month,
            now()->year
        );
    }

    public function preview(Request $request, $id)
    {
        $template = TemplateSurat::findOrFail($id);
        $instansi = Instansi::first();

       
        $dataInput = $request->except('_token');

        $nomorSurat = $this->generateNomorSurat($template->kategori_id);

        // ambil isi template
        $isi = $template->isi_template;

        // 🔥 REPLACE LEBIH KUAT (ANTI SPASI)
        foreach ($dataInput as $key => $value) {
            $isi = preg_replace('/{{\s*' . $key . '\s*}}/', $value, $isi);
        }

        return view('template.preview', [
            'template'  => $template,
            'isi'       => $isi,
            'nomor'     => $nomorSurat,
            'dataInput' => $dataInput,
            'instansi'  => $instansi,
            'surat'     => null // 🔥 PENTING untuk blade
        ]);
    }

    public function simpan(Request $request, $id)
    {
        $template = TemplateSurat::findOrFail($id);

        $dataInput   = $request->except('_token');
        $nomorSurat  = $this->generateNomorSurat($template->kategori_id);


        $surat = SuratKeluar::create([
            'template_id' => $template->id,
            'kategori_id' => $template->kategori_id,
            'nomor_surat' => $nomorSurat,
            'data_isian'  => json_encode($dataInput),
            'file_pdf'    => null,

        ]);

        return redirect()
            ->route('template.previewSaved', $surat->id)
            ->with('success', 'Surat berhasil disimpan');
    }


    public function previewSaved($id)
    {
        $surat    = SuratKeluar::with('template')->findOrFail($id);
        $instansi = Instansi::first();


        $dataInput = json_decode($surat->data_isian, true) ?? [];

        $isi = $surat->template->isi_template;

        foreach ($dataInput as $key => $value) {
            $isi = str_replace("{{" . $key . "}}", $value, $isi);
        }

        return view('template.preview', [
            'template'  => $surat->template,
            'isi'       => $isi, // Hasil generate ulang
            'nomor'     => $surat->nomor_surat,
            'dataInput' => $dataInput,
            'instansi'  => $instansi,
            'surat'     => $surat
        ]);
    }

    public function editForm(Request $request, $id)
{
    $template = TemplateSurat::findOrFail($id);
    $fields   = $template->field_json ?? [];

    // ambil data lama dari preview
    $oldInput = $request->except('_token');

    return view('template.form_dinamis', [
        'template' => $template,
        'fields'   => $fields,
        'oldInput' => $oldInput
    ]);
}

    public function exportPdf($id)
    {
        $surat    = SuratKeluar::with('template')->findOrFail($id);
        $instansi = Instansi::first();

        $dataInput = json_decode($surat->data_isian, true) ?? [];

        $isi = $surat->template->isi_template;

        foreach ($dataInput as $key => $value) {
            $isi = str_replace("{{" . $key . "}}", $value, $isi);
        }
        $pdf = Pdf::loadView('template.pdf', [
            'template' => $surat->template,
            'isi'      => $isi,
            'nomor'    => $surat->nomor_surat,
            'instansi' => $instansi
        ])->setPaper('A4', 'portrait');
        $namaFile = 'surat-' . str_replace('/', '-', $surat->nomor_surat) . '.pdf';

        $path = 'surat_keluar/' . $namaFile;
        Storage::disk('public')->put($path, $pdf->output());
        $surat->update([
            'file_pdf' => $path
        ]);
        return $pdf->download($namaFile);
    }
}
