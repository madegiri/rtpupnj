<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class UnitPUT extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'unit_put';

    protected $fillable = [
        'slug',
        'nama_singkat_unit_put',
        'nama_lengkap_unit_put',
        'poster',
        'thumbnail',
        'deskripsi',
        'visi_misi',
        'dukungan_kebijakan',
        'sdm',
        'sarana_prasarana',
        'roadmap',
        'struktur_organisasi',
    ];

    protected $casts = [
        'poster' => 'array',
        'roadmap'  => 'array',
        'struktur_organisasi' => 'array',
    ];

    public function setNamaSingkatUnitPutAttribute($value)
    {
        $this->attributes['nama_singkat_unit_put'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function kategoriProduk()
    {
        return $this->hasMany(KategoriProdukPUT::class, 'unit_put_id');
    }
}
