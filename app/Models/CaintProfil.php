<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaintProfil extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'caint_profil';

    protected $fillable = [
        'thumbnail',
        'poster',
        'deskripsi',
    ];

    protected $casts = [
        'poster' => 'array',
    ];
}
