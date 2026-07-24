<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoalPG extends Model
{
    protected $table = 'soal_pg';

    protected $fillable = [
        'tugas_id',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'jawaban_benar',
        'poin',
    ];

    public function tugas(): BelongsTo
    {
        return $this->belongsTo(Tugas::class);
    }
}
