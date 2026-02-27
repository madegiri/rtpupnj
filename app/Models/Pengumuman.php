<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pengumuman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengumuman';

    protected $fillable = [
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
}
