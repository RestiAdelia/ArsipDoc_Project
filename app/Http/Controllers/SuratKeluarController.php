<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    public function index()
{
    $data = SuratKeluar ::with('template', 'kategori')
        ->latest()
        ->get();

    return view('admin.surat_keluar.index', compact('data'));
}
}
