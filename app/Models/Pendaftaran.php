<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = [
        'name',
        'nim',
        'hp',
        'divisi',
        'alasan_bergabung',
        'status',
        'gambar',
    ];
}
