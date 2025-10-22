<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto_berita',
        'judul_berita',
        'deskripsi',
    ];

    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }
}