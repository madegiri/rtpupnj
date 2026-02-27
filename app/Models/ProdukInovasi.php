<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProdukInovasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produk_inovasi';

    protected $fillable = [
        'nama',
        'slug',
        'gambar',
        'galeri',
        'deskripsi',
    ];

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    protected $casts = [
        'galeri' => 'array',
    ];
}
