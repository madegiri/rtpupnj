<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SubKategoriProdukPUT extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sub_kategori_produk_put';   

    protected $fillable = [
        'kategori_produk_put_id', 
        'slug', 
        'nama_sub_kategori'
    ];

    public function setNamaSubKategoriAttribute($value)
    {
        $this->attributes['nama_sub_kategori'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function kategoriProdukPut()
    {
        return $this->belongsTo(KategoriProdukPUT::class, 'kategori_produk_put_id');
    }

    public function putProduk()
    {
        return $this->hasMany(PUTProduk::class, 'sub_kategori_produk_put_id');
    }
}
