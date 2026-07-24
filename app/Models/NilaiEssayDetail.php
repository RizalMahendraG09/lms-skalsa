<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NilaiEssayDetail extends Model
{
    protected $table = 'nilai_essay_detail';

    protected $fillable = [
        'jawaban_essay_id',
        'nilai',
        'catatan',
    ];

    public function jawabanEssay(): BelongsTo
    {
        return $this->belongsTo(JawabanEssay::class);
    }
}
