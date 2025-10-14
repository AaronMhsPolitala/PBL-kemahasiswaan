<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $fillable = ['nama', 'isi_komentar', 'berita_id'];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}
