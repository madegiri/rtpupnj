<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class KategoriProdukPUT extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_produk_put';

    protected $fillable = [
        'unit_put_id',
        'slug',
        'nama_kategori',
    ];

    public function setNamaKategoriAttribute($value)
    {
        $this->attributes['nama_kategori'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function unitPut()
    {
        return $this->belongsTo(UnitPUT::class, 'unit_put_id');
    }

    public function putProduk()
    {
        return $this->hasMany(PUTProduk::class, 'kategori_produk_put_id');
    }
}
