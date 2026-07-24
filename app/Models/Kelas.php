<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    protected $fillable = [
        'nama_kelas',
    ];

    public function siswa(): HasMany
    {
        return $this->hasMany(User::class, 'kelas_id');
    }

    public function mataPelajarans(): HasMany
    {
        return $this->hasMany(MataPelajaran::class);
    }
}
