<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';

    protected $fillable = [
        'template_id',
        'kategori_id',
        'nomor_surat',
        'data_isian',
        'file_pdf'
    ];

    protected $casts = [
        'data_isian' => 'array'
    ];

    public function template()
    {
        return $this->belongsTo(TemplateSurat::class, 'template_id');
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriSurat::class, 'kategori_id');
    }
}
