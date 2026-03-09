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
   public function getFieldJsonAttribute($value): array
    {
        if (is_array($value)) {
            return $value;
        }
        if (is_string($value) && !empty($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }
        return [];
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriSurat::class, 'kategori_id');
    }
    public function suratKeluar()
    {
        return $this->hasMany(SuratKeluar::class, 'template_id');
    }
}
