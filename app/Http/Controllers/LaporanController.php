<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Instansi;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{

    public function suratMasuk(Request $request)
    {
        $query = SuratMasuk::with('user');
        $query->where('status_arsip', 'nonaktif')->where('status', '!=', 'pending');

        if ($request->dari && $request->sampai) {
            $query->whereBetween('tanggal_surat', [$request->dari, $request->sampai]);
        }

        $totalData = (clone $query)->count();
        $data      = $query->latest()->paginate(10)->withQueryString();

        return view('admin.laporan.surat_masuk', compact('data', 'request', 'totalData'));
    }

    public function suratKeluar(Request $request)
    {
        $query = SuratKeluar::with('user');

        if ($request->dari && $request->sampai) {
            $query->whereBetween('created_at', [
                $request->dari . ' 00:00:00',
                $request->sampai . ' 23:59:59',
            ]);
        }

        $totalData = (clone $query)->count();
        $data      = $query->latest()->paginate(10)->withQueryString();

        return view('admin.laporan.surat_keluar', compact('data', 'request', 'totalData'));
    }

    public function arsip(Request $request)
    {
        $query = Dokumen::with('user');

        if ($request->dari && $request->sampai) {
            $query->whereBetween('created_at', [$request->dari, $request->sampai]);
        }

        $totalData = (clone $query)->count();
        $data      = $query->latest()->paginate(10)->withQueryString();

        return view('admin.laporan.arsip', compact('data', 'request', 'totalData'));
    }

    public function cetakPDF(Request $request)
    {
        $jenis = $request->jenis;
        $judul = '';

        switch ($jenis) {
            case 'surat_masuk':
                $query   = SuratMasuk::query();
                $colDate = 'tanggal_surat';
                $judul   = 'LAPORAN SURAT MASUK';
                break;

            case 'surat_keluar':
                $query   = SuratKeluar::query();
                $colDate = 'created_at';
                $judul   = 'LAPORAN SURAT KELUAR';
                break;

            case 'arsip':
                $query   = Dokumen::query();
                $colDate = 'tanggal_dokumen';
                $judul   = 'LAPORAN ARSIP DOKUMEN';
                break;

            default:
                return redirect()->back()->with('error', 'Jenis laporan tidak valid');
        }

        if ($request->dari && $request->sampai) {
            $query->whereBetween($colDate, [
                $request->dari . ' 00:00:00',
                $request->sampai . ' 23:59:59',
            ]);
        }

        $data      = $query->latest()->get();
        $totalData = $data->count();
        $instansi  = Instansi::first();
        $orientasi = ($jenis == 'arsip') ? 'portrait' : 'landscape';

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('data', 'jenis', 'judul', 'instansi', 'totalData'))
                  ->setPaper('a4', $orientasi);

        return $pdf->stream('laporan_' . $jenis . '.pdf');
    }
}