<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PimpinanRTPU extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pimpinan_rtpu';

    protected $fillable = [
        'nama',
        'slug',
        'jabatan',
        'foto',
        'deskripsi',
    ];

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
