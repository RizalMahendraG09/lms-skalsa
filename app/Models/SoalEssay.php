<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoalEssay extends Model
{
    protected $table = 'soal_essay';

    protected $fillable = [
        'tugas_id',
        'pertanyaan',
        'poin',
    ];

    public function tugas(): BelongsTo
    {
        return $this->belongsTo(Tugas::class);
    }
}
