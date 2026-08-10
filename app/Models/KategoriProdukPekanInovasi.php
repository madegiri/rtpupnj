<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class KategoriProdukPekanInovasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_produk_pekan_inovasi';

    protected $fillable = [
        'profil_pekan_inovasi_id',
        'slug',
        'nama_kategori',
    ];

    public function setNamaKategoriAttribute($value)
    {
        $this->attributes['nama_kategori'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function profilPekanInovasi()
    {
        return $this->belongsTo(ProfilPekanInovasi::class, 'profil_pekan_inovasi_id');
    }

    public function produkPekanInovasi()
    {
        return $this->hasMany(ProdukPekanInovasi::class, 'kategori_produk_pekan_inovasi_id');
    }
}
