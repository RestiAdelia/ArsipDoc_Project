<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\SuratKeluar;
use App\Models\TemplateSurat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
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
        $fields   = $template->field_json ?? [];

        return view('template.form_dinamis', compact('template', 'fields'));
    }

    public function editForm(Request $request, $id)
    {
        $template = TemplateSurat::findOrFail($id);
        $fields   = $template->field_json ?? [];
        $oldInput = $request->except('_token');

        return view('template.form_dinamis', compact('template', 'fields', 'oldInput'));
    }

    public function preview(Request $request, $id)
    {
        $template  = TemplateSurat::findOrFail($id);
        $instansi  = Instansi::first();
        $dataInput = $request->except('_token');
        $fields    = $template->field_json ?? [];

        foreach ($fields as $field) {
            $key  = $field['name'] ?? '';
            $type = $field['type'] ?? '';
            if ($type === 'date' && !empty($dataInput[$key])) {
                $dataInput[$key] = \Carbon\Carbon::parse($dataInput[$key])
                    ->translatedFormat('d F Y');
            }
        }

        $isi = $template->isi_template;
        foreach ($dataInput as $key => $value) {
            $isi = preg_replace('/{{\s*' . preg_quote($key, '/') . '\s*}}/', $value, $isi);
        }
        $isi = nl2br(e($isi));

        $nomorSurat = $this->generateNomorSurat();

        return view('template.preview', [
            'template'  => $template,
            'isi'       => $isi,
            'nomor'     => $nomorSurat,
            'dataInput' => $dataInput,
            'instansi'  => $instansi,
            'fields'    => $fields,
            'surat'     => null,
            'sifat'     => $dataInput['sifat']    ?? '-',
            'lampiran'  => $dataInput['lampiran'] ?? '-',
            'perihal'   => $dataInput['perihal']  ?? $template->nama_template,
            'tujuan'    => $dataInput['tujuan']   ?? null,
        ]);
    }

    public function simpan(Request $request, $id)
    {
        $template  = TemplateSurat::findOrFail($id);
        $instansi  = Instansi::first();
        $dataInput = $request->except('_token');

        $sessionKey = 'surat_saved_' . $id . '_' . md5(json_encode($dataInput));
        if (session()->has($sessionKey)) {
            $suratLama = SuratKeluar::where('template_id', $id)->latest()->first();
            if ($suratLama) {
                return redirect()
                    ->route('template.previewSaved', $suratLama->id)
                    ->with('warning', 'Surat ini sudah pernah disimpan sebelumnya.');
            }
        }
        $fields = $template->field_json ?? [];
        foreach ($fields as $field) {
            $key  = $field['name'] ?? '';
            $type = $field['type'] ?? '';
            if ($type === 'date' && !empty($dataInput[$key])) {
                $dataInput[$key] = \Carbon\Carbon::parse($dataInput[$key])
                    ->translatedFormat('d F Y');
            }
        }

        $nomorSurat = $this->generateNomorSurat();

        $isi = $template->isi_template;
        foreach ($dataInput as $key => $value) {
            $isi = preg_replace('/{{\s*' . preg_quote($key, '/') . '\s*}}/', $value, $isi);
        }
        $isi = nl2br(e($isi));

        $namaFile = 'surat-' . str_replace('/', '-', $nomorSurat) . '.pdf';
        $path     = 'surat_keluar/' . $namaFile;

        $pdf = Pdf::loadView('template.pdf', [
            'template'  => $template,
            'isi'       => $isi,
            'nomor'     => $nomorSurat,
            'dataInput' => $dataInput,
            'instansi'  => $instansi,
            'sifat'     => $dataInput['sifat']    ?? '-',
            'lampiran'  => $dataInput['lampiran'] ?? '-',
            'perihal'   => $dataInput['perihal']  ?? $template->nama_template,
            'tujuan'    => $dataInput['tujuan']   ?? null,
        ])->setPaper('A4', 'portrait');

        Storage::disk('public')->put($path, $pdf->output());

        // Simpan ke DB
        $surat = SuratKeluar::create([
            'template_id' => $template->id,
            'kategori_id' => $template->kategori_id,
            'nomor_surat' => $nomorSurat,
            'data_isian'  => json_encode($dataInput),
            'file_pdf'    => $path,
        ]);

        //  Tandai sudah disimpan di session
        session()->put($sessionKey, true);

        return redirect()
            ->route('template.previewSaved', $surat->id)
            ->with('success', 'Surat berhasil disimpan.');
    }

    //  Preview surat yang sudah tersimpan
    public function previewSaved($id)
    {
        $surat     = SuratKeluar::with('template')->findOrFail($id);
        $instansi  = Instansi::first();
        $template  = $surat->template;
        $dataInput = is_array($surat->data_isian)
            ? $surat->data_isian
            : (json_decode($surat->data_isian, true) ?? []);

        $isi = $template->isi_template;
        foreach ($dataInput as $key => $value) {
            $isi = preg_replace('/{{\s*' . preg_quote($key, '/') . '\s*}}/', $value, $isi);
        }
        $isi = nl2br(e($isi));

        return view('template.preview', [
            'template'  => $template,
            'isi'       => $isi,
            'nomor'     => $surat->nomor_surat,
            'dataInput' => $dataInput,
            'instansi'  => $instansi,
            'fields'    => $template->field_json ?? [],
            'surat'     => $surat,
            'sifat'     => $dataInput['sifat']    ?? '-',
            'lampiran'  => $dataInput['lampiran'] ?? '-',
            'perihal'   => $dataInput['perihal']  ?? $template->nama_template,
            'tujuan'    => $dataInput['tujuan']   ?? null,
        ]);
    }

    // Export PDF dari surat tersimpan
    public function exportPdf($id)
    {
        $surat     = SuratKeluar::with('template')->findOrFail($id);
        $template  = $surat->template;
        $instansi  = Instansi::first();
        $dataInput = is_array($surat->data_isian)
            ? $surat->data_isian
            : (json_decode($surat->data_isian, true) ?? []);

        $isi = $template->isi_template;
        foreach ($dataInput as $key => $value) {
            $isi = preg_replace('/{{\s*' . preg_quote($key, '/') . '\s*}}/', $value, $isi);
        }
        $isi = nl2br(e($isi));

        $pdf = Pdf::loadView('template.pdf', [
            'template'  => $template,
            'isi'       => $isi,
            'nomor'     => $surat->nomor_surat,
            'dataInput' => $dataInput,
            'instansi'  => $instansi,
            'sifat'     => $dataInput['sifat']    ?? '-',
            'lampiran'  => $dataInput['lampiran'] ?? '-',
            'perihal'   => $dataInput['perihal']  ?? $template->nama_template,
            'tujuan'    => $dataInput['tujuan']   ?? null,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('surat_' . str_replace('/', '-', $surat->nomor_surat) . '.pdf');
    }

    // Generate nomor surat
    private function generateNomorSurat(): string
    {
        $last = SuratKeluar::latest()->first();
        $next = $last ? $last->id + 1 : 1;

        return sprintf('%03d/SRT/%02d/%s', $next, now()->month, now()->year);
    }
}