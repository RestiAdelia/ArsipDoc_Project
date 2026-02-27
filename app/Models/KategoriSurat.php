<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriSurat extends Model
{
    protected $table = 'kategori_surat';

    protected $fillable = [
        'nama_kategori',
        'kode_kategori',
        'deskripsi',
    ];
    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'kategori_id');
    }
    public function templates()
    {
        return $this->hasMany(TemplateSurat::class, 'kategori_id');
    }
}
