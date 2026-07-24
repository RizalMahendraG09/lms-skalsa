<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JawabanEssay extends Model
{
    protected $table = 'jawaban_essay';

    protected $fillable = [
        'jawaban_siswa_id',
        'soal_essay_id',
        'jawaban',
    ];

    public function jawabanSiswa(): BelongsTo
    {
        return $this->belongsTo(JawabanSiswa::class);
    }

    public function soalEssay(): BelongsTo
    {
        return $this->belongsTo(SoalEssay::class);
    }

    public function nilaiEssayDetail(): HasOne
    {
        return $this->hasOne(NilaiEssayDetail::class);
    }
}
