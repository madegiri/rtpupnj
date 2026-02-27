<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CaintProduk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'caint_produk';

    protected $fillable = [
        'judul',
        'slug',
        'thumbnail',
        'galeri',
        'isi',
        'kategori',
    ];

        public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    protected $casts = [
        'galeri' => 'array',
    ];

    const KATEGORIS = [
        'Smart Campus'              => 'Smart Campus',
        'Green Energy'              => 'Green Energy',
        'Industrial Automation'     => 'Industrial Automation',
        'Agriculture & Environment' => 'Agriculture & Environment',
        'Healthcare'                => 'Healthcare',
    ];

    // Config warna & icon per kategori, dipanggil dari mana saja
    const KATEGORI_CONFIG = [
        'Smart Campus' => [
            'warna' => '#1a237e',
            'icon'  => 'bi-building',
            'slug'  => 'smart-campus',
        ],
        'Green Energy' => [
            'warna' => '#1a7a4a',
            'icon'  => 'bi-lightning-charge',
            'slug'  => 'green-energy',
        ],
        'Industrial Automation' => [
            'warna' => '#b71c1c',
            'icon'  => 'bi-gear-wide-connected',
            'slug'  => 'industrial-automation',
        ],
        'Agriculture & Environment' => [
            'warna' => '#e65100',
            'icon'  => 'bi-tree',
            'slug'  => 'agriculture-environment',
        ],
        'Healthcare' => [
            'warna' => '#6a1b9a',
            'icon'  => 'bi-heart-pulse',
            'slug'  => 'healthcare',
        ],
    ];
}
