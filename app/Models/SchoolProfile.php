<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SchoolProfile extends Model
{
    protected $fillable = [
        'nama_sekolah',
        'logo',
        'alamat',
        'email',
        'telepon',
        'website',
        'visi',
        'misi',
        'sejarah',
        'kepala_sekolah',
        'foto_kepala_sekolah',
    ];

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? Storage::url($this->logo) : null;
    }

    public function getFotoKepalaSekolahUrlAttribute(): ?string
    {
        return $this->foto_kepala_sekolah ? Storage::url($this->foto_kepala_sekolah) : null;
    }
}
