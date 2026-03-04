<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';

    protected $fillable = [
        'user_id',
        'nomor_surat',
        'asal_surat',
        'instansi',
        'perihal',
        'tanggal_surat',
        'file',
        'status',
        'status_arsip',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dokumen()
    {
        return $this->hasOne(Dokumen::class, 'nomor_dokumen', 'nomor_surat');
    }
}
