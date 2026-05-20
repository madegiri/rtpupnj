<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class KategoriKonten extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_konten';

    protected $fillable = [
        'nama_kategori_konten',
        'slug',
    ];

    public function setNamaKategoriKontenAttribute($value)
    {
        $this->attributes['nama_kategori_konten'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function konten()
    {
        return $this->hasMany(Konten::class, 'kategori_konten_id');
    }
}
