<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriLomba extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_lomba';

    protected $fillable = [
        'nama_kategori',
    ];

    public function lomba()
    {
        return $this->hasMany(Lomba::class, 'kategori_lomba_id');
    }
}
