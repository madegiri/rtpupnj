<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class UnitPUT extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'unit_put';

    protected $fillable = [
        'slug',
        'nama_singkat_unit_put',
        'nama_lengkap_unit_put',
        'poster',
        'thumbnail',
        'deskripsi',
        'visi_misi',
        'dukungan_kebijakan',
        'sdm',
        'sarana_prasarana',
        'roadmap',
        'struktur_organisasi',
        'penelitian',
        'pengabdian_masyarakat',
        'lecturer_series',
        'magang_riset',
        'kegiatan_lainnya',
    ];

    protected $casts = [
        'poster' => 'array',
        'sarana_prasarana' => 'array',
        'penelitian' => 'array',
        'pengabdian_masyarakat' => 'array',
        'kegiatan_lainnya' => 'array',
    ];

    public function setNamaSingkatUnitPutAttribute($value)
    {
        $this->attributes['nama_singkat_unit_put'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function setPengabdianMasyarakatAttribute($value)
    {
        $this->attributes['pengabdian_masyarakat'] = $this->withSlugs($value);
    }

    public function setKegiatanLainnyaAttribute($value)
    {
        $this->attributes['kegiatan_lainnya'] = $this->withSlugs($value);
    }

    protected function withSlugs($items): ?string
    {
        if (empty($items)) {
            return null;
        }

        $result = [];

        foreach ($items as $item) {
            $item['slug'] = Str::slug($item['judul'] ?? '');
            $item['created_at'] = $item['created_at'] ?? now()->toDateTimeString();
            $item['user_id'] = $item['user_id'] ?? auth()->id(); 
            unset($item['user_name']);
            $result[] = $item;
        }

        return json_encode($result);
    }

    public static function urutTerbaru($items)
    {
        return collect($items ?? [])
            ->reverse()
            ->sortByDesc('created_at')
            ->values();
    }

    public function namaPembuat(?array $items): array
    {
        $ids = collect($items)->pluck('user_id')->filter()->unique();

        return $ids->isEmpty()
            ? []
            : \App\Models\User::whereIn('id', $ids)->pluck('name', 'id')->all();
    }

    public function kategoriProduk()
    {
        return $this->hasMany(KategoriProdukPUT::class, 'unit_put_id');
    }
}
