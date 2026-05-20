<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Konten extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'konten';

    protected $fillable = [
        'users_id',
        'kategori_konten_id',
        'judul',
        'slug',
        'thumbnail',
        'isi',
    ];

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function kategoriKonten()
    {
        return $this->belongsTo(KategoriKonten::class, 'kategori_konten_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
