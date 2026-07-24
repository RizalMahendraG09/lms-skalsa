<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataPelajaran extends Model
{
    protected $fillable = [
        'nama_mapel',
        'guru_id',
        'kelas_id',
    ];

    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function materis(): HasMany
    {
        return $this->hasMany(Materi::class);
    }

    public function pertemuans(): HasMany
    {
        return $this->hasMany(Pertemuan::class);
    }
}
