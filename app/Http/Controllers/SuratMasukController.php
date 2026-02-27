<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{

    public function  index()
    {
        $surat = SuratMasuk::latest()->paginate(10);
        return view('admin.surat_masuk.index', [
            'user' => Auth::user(),
            'surat' => $surat
        ]);
       
    }

    public function create()
    {
        return view('admin.surat_masuk.create');
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $filePath = $this->handleFileUpload($request);

        SuratMasuk::create([
            'nomor_surat' => $request->nomor_surat,
            'asal_surat' => $request->asal_surat,
            'perihal' => $request->perihal,
            'tanggal_surat' => $request->tanggal_surat,
            'file' => $filePath,
        ]);

        return redirect()->route('admin.surat_masuk.index')->with('success', 'Surat masuk berhasil ditambahkan.');
    }
    public function approve($id)
    {
        SuratMasuk::findOrFail($id)->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Surat berhasil di-approve.');
    }

    public function reject($id)
    {
        SuratMasuk::findOrFail($id)->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Surat ditolak.');
    }


    public function destroy(SuratMasuk $surat_masuk)
    {
        if ($surat_masuk->file) {
            Storage::disk('public')->delete($surat_masuk->file);
        }
        $surat_masuk->delete();

        return redirect()->route('admin.surat_masuk.index')->with('success', 'Surat masuk berhasil dihapus.');
    }

    public function indexUser()
    {
        //     // Menampilkan surat terbaru
        //     $surat = SuratMasuk::latest()->paginate(10);
        //     return view('user.surat_masuk.index', compact('surat'));
        $surat = SuratMasuk::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.surat_masuk.index', [
            'user' => Auth::user(),
            'surat' => $surat
        ]);
    }


    // 2. Menampilkan form create untuk user
    public function createUser()
    {
        return view('user.surat_masuk.create');
    }

    
    private function handleFileUpload($request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // ambil nama asli
            $originalName = $file->getClientOriginalName();

            // 🔥 biar tidak ketimpa kalau nama sama
            $filename = time() . '_' . $originalName;

            // simpan ke storage/public/surat_masuk
            $file->storeAs('surat_masuk', $filename, 'public');

            return 'surat_masuk/' . $filename;
        }

        return null;
    }

    public function storeUser(Request $request)
    {
        // Validasi
        $this->validateRequest($request);

        // Upload File
        $filePath = $this->handleFileUpload($request);

        // Simpan Data
        SuratMasuk::create([
            'user_id' => Auth::id(), 
            'nomor_surat' => $request->nomor_surat,
            'asal_surat' => $request->asal_surat,
            'perihal' => $request->perihal,
            'instansi' => $request->instansi,
            'tanggal_surat' => $request->tanggal_surat,
            'file' => $filePath,
        ]);

        return redirect()->route('user.surat_masuk.index')
            ->with('success', 'Surat Anda berhasil dikirim.');
    }
    private function validateRequest($request)
    {
        return $request->validate([
            'nomor_surat'   => 'required|unique:surat_masuk,nomor_surat',
            'asal_surat'    => 'required',
            'perihal'       => 'required',
            'instansi'      => 'required',
            'tanggal_surat' => 'required|date',
            'file'          => 'required|mimes:pdf,doc,docx|max:2048',
        ]);
    }
}
