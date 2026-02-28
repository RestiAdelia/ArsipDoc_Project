<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDokumen = Dokumen::count();
        $totalSuratMasuk = SuratMasuk::count();
        $suratHariIni = SuratMasuk::whereDate('created_at', Carbon::today())->count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalUser  = User::where('role', 'user')->count();
        $totalSuratKeluar = SuratKeluar::count();


        return view('dashboard', compact(
            'totalDokumen',
            'totalSuratMasuk',
            'suratHariIni',
            'totalAdmin',
            'totalSuratKeluar',
            'totalUser',
        ));
    }
    public function userDashboard()
    {
        $userId = auth()->id();
        $userName = auth()->user()->name;

        // total surat yang dikirim user
        $totalSuratUser = SuratMasuk::where('user_id', $userId)->count();

        // surat user hari ini
        $suratHariIniUser = SuratMasuk::where('user_id', $userId)
            ->whereDate('created_at', now()->toDateString())
            ->count();

        // total arsip (global)
        $totalDokumen = Dokumen::count();

        return view('user.dashboard', [
            'userName' => $userName,
            'totalSuratUser' => $totalSuratUser,
            'suratHariIniUser' => $suratHariIniUser,
            'totalDokumen' => $totalDokumen,
        ]);
    }
}
