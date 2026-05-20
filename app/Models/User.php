<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function konten()
    {
        return $this->hasMany(Konten::class, 'users_id');
    }

    public function lomba()
    {
        return $this->hasMany(Lomba::class, 'users_id');
    }

    public function tentangRTPU()
    {
        return $this->hasMany(TentangRTPU::class, 'users_id');
    }

    public function strukturOrganisasi()
    {
        return $this->hasMany(StrukturOrganisasi::class, 'users_id');
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'users_id');
    }

    public function produkPUT()
    {
        return $this->hasMany(PUTProduk::class, 'users_id');
    }

    public function sertifikasi()
    {
        return $this->hasMany(Sertifikasi::class, 'users_id');
    }
}
