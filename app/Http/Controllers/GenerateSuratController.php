<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\TemplateSurat;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class GenerateSuratController extends Controller
{

    public function pilihTemplate()
    {
        $templates = TemplateSurat::with('kategori')->latest()->get();
        return view('template.pilih_template', compact('templates'));
    }

    public function form($id)
    {
        $template = TemplateSurat::findOrFail($id);
        $fields = $template->field_json ?? [];

        return view('template.form_dinamis', compact('template', 'fields'));
    }


    private function generateNomorSurat($kategoriId = null)
    {
        $last = SuratKeluar::latest()->first();
        $next = $last ? $last->id + 1 : 1;

        return sprintf(
            "%03d/SRT/%02d/%s",
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
        $isi = $template->isi_template;
        foreach ($dataInput as $key => $value) {
            $isi = preg_replace('/{{\s*' . $key . '\s*}}/', $value, $isi);
        }

        return view('template.preview', [
            'template'  => $template,
            'isi'       => $isi,
            'nomor'     => $nomorSurat,
            'dataInput' => $dataInput,
            'instansi'  => $instansi,
            'surat'     => null
        ]);
    }

    public function simpan(Request $request, $id)
    {
        $template = TemplateSurat::findOrFail($id);
        $instansi = Instansi::first();

        $dataInput  = $request->except('_token');
        $nomorSurat = $this->generateNomorSurat($template->kategori_id);
        $isi = $template->isi_template;
        foreach ($dataInput as $key => $value) {
            $isi = str_replace("{{" . $key . "}}", $value, $isi);
        }
        $namaFile = 'surat-' . str_replace('/', '-', $nomorSurat) . '.pdf';
        $path = 'surat_keluar/' . $namaFile;

        $pdf = Pdf::loadView('template.pdf', [
            'template' => $template,
            'isi'      => $isi,
            'nomor'    => $nomorSurat,
            'instansi' => $instansi
        ])->setPaper('A4', 'portrait');


        Storage::disk('public')->put($path, $pdf->output());


        $surat = SuratKeluar::create([
            'template_id' => $template->id,
            'kategori_id' => $template->kategori_id,
            'nomor_surat' => $nomorSurat,
            'data_isian'  => json_encode($dataInput),
            'file_pdf'    => $path,
        ]);

        return redirect()
            ->route('template.previewSaved', $surat->id)
            ->with('success', 'Surat berhasil disimpan & PDF dibuat');
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
            'isi'       => $isi,
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

        $oldInput = $request->except('_token');

        return view('template.form_dinamis', [
            'template' => $template,
            'fields'   => $fields,
            'oldInput' => $oldInput
        ]);
    }


    public function exportPdf($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        if (!$surat->file_pdf || !Storage::disk('public')->exists($surat->file_pdf)) {
            return back()->with('error', 'File PDF belum tersedia');
        }

        return response()->download(
            storage_path('app/public/' . $surat->file_pdf)
        );
    }
}
