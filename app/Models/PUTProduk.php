<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PUTProduk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'put_produk';

    protected $fillable = [
        'users_id',
        'kategori_produk_put_id',
        'judul',
        'slug',
        'thumbnail',
        'poster',
        'galeri',
        'isi',
    ];

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    protected $casts = [
        'galeri' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function kategoriProduk()
    {
        return $this->belongsTo(KategoriProdukPUT::class, 'kategori_produk_put_id');
    }
}
