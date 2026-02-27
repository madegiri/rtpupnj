<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Sertifikasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sertifikasi';

    protected $fillable = [
        'nama',
        'slug',
        'gambar',
        'deskripsi',
        'penyelenggara',
    ];

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
