<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PutoiProfil extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'putoi_profil';

    protected $fillable = [
        'thumbnail',
        'deskripsi',
    ];
}
