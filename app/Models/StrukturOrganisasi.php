<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class StrukturOrganisasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'struktur_organisasi';

    protected $fillable = [
        'users_id',
        'gambar',
        'nama',
        'slug',
        'jabatan',
        'deskripsi',
    ];

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
