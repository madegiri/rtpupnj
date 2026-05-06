<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Lomba extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lomba';

    protected $fillable = [
        'users_id',
        'kategori_lomba_id',
        'nama_lomba',
        'slug',
        'gambar',
        'penyelenggara',
        'kategori_peserta',
        'jenis_pelaksanaan',
        'deskripsi',
        'link_pendaftaran',
        'tanggal_mulai_pendaftaran',
        'tanggal_selesai_pendaftaran',
    ];

    public function setNamaLombaAttribute($value)
    {
        $this->attributes['nama_lomba'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    protected $casts = [
        'kategori_peserta'          => 'array',
        'tanggal_mulai_pendaftaran' => 'date',
        'tanggal_selesai_pendaftaran' => 'date',
    ];

    const KATEGORI_PESERTA = [
        'sma'       => 'SMA / Sederajat',
        'smk'       => 'SMK / Sederajat',
        'mahasiswa' => 'Mahasiswa',
        'umum'      => 'Umum',
    ];

    const JENIS_PELAKSANAAN = [
        'online'  => 'Online',
        'offline' => 'Offline',
        'hybrid'  => 'Online & Offline',
    ];

    public function kategoriLomba()
    {
        return $this->belongsTo(KategoriLomba::class, 'kategori_lomba_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
