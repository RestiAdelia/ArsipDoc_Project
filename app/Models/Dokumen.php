<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumens';
    protected $fillable = [
        'nomor_dokumen',
        'nama_dokumen',
        'tanggal_dokumen',
        'kategori_id',
        'file_dokumen',
        'keterangan',

    ];
    public function kategori()
    {
        return $this->belongsTo(KategoriSurat::class, 'kategori_id');
    }
}
