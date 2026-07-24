<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    protected $fillable = [
        'judul',
        'foto',
        'deskripsi',
        'kategori',
    ];

    public function getFotoUrlAttribute(): string
    {
        return Storage::url($this->foto);
    }

    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }
}
