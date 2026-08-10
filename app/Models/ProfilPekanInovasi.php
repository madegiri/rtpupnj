<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProfilPekanInovasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profil_pekan_inovasi';

    protected $fillable = [
        'slug',
        'nama_pekan_inovasi',
        'thumbnail',
        'galeri_kegiatan',
        'poster',
        'deskripsi',
    ];

    public function setNamaPekanInovasiAttribute($value)
    {
        $this->attributes['nama_pekan_inovasi'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    protected $casts = [
        'galeri_kegiatan' => 'array',
        'poster' => 'array',
    ];

    public function kategoriProdukPekanInovasi()
    {
        return $this->hasMany(KategoriProdukPekanInovasi::class, 'profil_pekan_inovasi_id');
    }
}
