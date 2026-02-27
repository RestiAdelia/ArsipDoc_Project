<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSurat extends Model

{

    use HasFactory;
    protected $table = 'template_surat';
    protected $fillable = [
        'kategori_id',
        'nama_template',
        'isi_template',
        'field_json'
    ];
    protected $casts = [
        'field_json' => 'array',
    ];
    public function kategori()
    {
        return $this->belongsTo(KategoriSurat::class, 'kategori_id');
    }
    public function suratKeluar()
    {
        return $this->hasMany(SuratKeluar::class, 'template_id');
    }
}
