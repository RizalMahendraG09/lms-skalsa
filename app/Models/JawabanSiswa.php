<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JawabanSiswa extends Model
{
    protected $table = 'jawaban_siswa';

    protected $fillable = [
        'siswa_id',
        'tugas_id',
        'nilai_pg',
        'nilai_essay',
        'nilai_akhir',
        'status',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
        ];
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    public function tugas(): BelongsTo
    {
        return $this->belongsTo(Tugas::class);
    }

    public function jawabanPG(): HasMany
    {
        return $this->hasMany(JawabanPG::class);
    }

    public function jawabanEssay(): HasMany
    {
        return $this->hasMany(JawabanEssay::class);
    }
}
