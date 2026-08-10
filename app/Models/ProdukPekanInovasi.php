<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProdukPekanInovasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produk_pekan_inovasi';

    protected $fillable = [
        'users_id',
        'kategori_produk_pekan_inovasi_id',
        'judul',
        'slug',
        'thumbnail',
        'poster',
        'galeri',
        'video',
        'isi',
    ];

    protected $casts = [
        'galeri' => 'array',
    ];

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function kategoriProdukPekanInovasi()
    {
        return $this->belongsTo(KategoriProdukPekanInovasi::class, 'kategori_produk_pekan_inovasi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function getVideoEmbedUrlAttribute(): ?string
    {
        if (!$this->video) {
            return null;
        }

        $url = trim($this->video);

        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        if (preg_match('/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/', $url, $m)) {
            return 'https://drive.google.com/file/d/' . $m[1] . '/preview';
        }

        if (preg_match('/drive\.google\.com\/open\?id=([a-zA-Z0-9_-]+)/', $url, $m)) {
            return 'https://drive.google.com/file/d/' . $m[1] . '/preview';
        }

        return null;
    }

    public function getVideoTypeAttribute(): ?string
    {
        if (!$this->video) {
            return null;
        }

        if (preg_match('/(?:youtube\.com|youtu\.be)/', $this->video)) {
            return 'youtube';
        }

        if (str_contains($this->video, 'drive.google.com')) {
            return 'drive';
        }

        return 'direct';
    }
}
