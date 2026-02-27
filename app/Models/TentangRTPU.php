<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TentangRTPU extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tentang_rtpu';

    protected $fillable = [
        'isi'
    ];

}
