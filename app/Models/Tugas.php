<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tugas extends Model
{
    protected $fillable = [
        'mata_pelajaran_id',
        'guru_id',
        'judul',
        'deskripsi',
        'deadline',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'datetime',
        ];
    }

    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function soalPG(): HasMany
    {
        return $this->hasMany(SoalPG::class);
    }

    public function soalEssay(): HasMany
    {
        return $this->hasMany(SoalEssay::class);
    }

    public function jawabanSiswa(): HasMany
    {
        return $this->hasMany(JawabanSiswa::class);
    }
}
