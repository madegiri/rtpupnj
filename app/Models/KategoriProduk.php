<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class KategoriProduk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_produk';

    protected $fillable = [
        'nama_kategori_produk',
        'slug',
    ];

    public function setNamaKategoriProdukAttribute($value)
    {
        $this->attributes['nama_kategori_produk'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_produk_id');
    }
}
