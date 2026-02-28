<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\GenerateSuratCOntroller;
use App\Http\Controllers\KategoriSuratController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\TemplateSuratController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login-proses', [AuthController::class, 'loginProses'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index'); // tampil
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // form edit
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update'); // proses update

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard',  [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])
        ->name('user.dashboard');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('surat_masuk', [SuratMasukController::class, 'index'])->name('surat_masuk.index'); // list semua surat
    Route::patch('surat_masuk/{id}/approve', [SuratMasukController::class, 'approve'])
        ->name('admin.surat_masuk.approve');
    Route::patch('surat_masuk/{id}/reject', [SuratMasukController::class, 'reject'])
        ->name('admin.surat_masuk.reject');

    Route::get('/admin/user/create', [AuthController::class, 'create'])
        ->name('admin.user.create');
    Route::get('/admin/user/index', [AuthController::class, 'index'])
        ->name('admin.user.index');

    Route::post('/admin/user/store', [AuthController::class, 'store'])
        ->name('admin.user.store');
        Route::get('/template/create', [TemplateSuratController::class, 'create'])
    ->name('template.create');

Route::post('/template/store', [TemplateSuratController::class, 'store'])
    ->name('template.store');
    Route::post('/template/{id}/edit-form', [GenerateSuratController::class, 'editForm'])
    ->name('template.editForm');
    Route::get('/template', [GenerateSuratController::class, 'pilihTemplate'])->name('template.pilih');
    Route::get('template/form/{id}', [GenerateSuratController::class, 'form'])->name('template.form');
    Route::post('template/preview/{id}', [GenerateSuratController::class, 'preview'])->name('template.preview');
    Route::post('template/simpan/{id}', [GenerateSuratController::class, 'simpan'])->name('template.simpan');
    Route::get('template/preview/{id}', [GenerateSuratController::class, 'previewSaved'])->name('template.previewSaved');
    Route::get('template/pdf/{id}', [GenerateSuratController::class, 'exportPdf'])->name('template.pdf');
    
    Route::resource('dokumen', DokumenController::class);
    Route::resource('kategori', KategoriSuratController::class);
    Route::get('/surat-keluar', [SuratKeluarController::class, 'index'])
    ->name('surat-keluar.index');
});



Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('surat_masuk', [SuratMasukController::class, 'indexUser'])->name('surat_masuk.index'); // list surat user
    Route::get('surat_masuk/create', [SuratMasukController::class, 'createUser'])->name('surat_masuk.create'); // form kirim surat
    Route::post('surat_masuk', [SuratMasukController::class, 'storeUser'])->name('surat_masuk.store'); // submit surat
});
