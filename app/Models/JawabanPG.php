<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JawabanPG extends Model
{
    protected $table = 'jawaban_pg';

    protected $fillable = [
        'jawaban_siswa_id',
        'soal_pg_id',
        'jawaban_siswa',
        'benar',
        'poin_didapat',
    ];

    public function jawabanSiswa(): BelongsTo
    {
        return $this->belongsTo(JawabanSiswa::class);
    }

    public function soalPG(): BelongsTo
    {
        return $this->belongsTo(SoalPG::class);
    }
}
