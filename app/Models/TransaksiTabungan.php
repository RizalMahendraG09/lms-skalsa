<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiTabungan extends Model
{
    protected $fillable = [
        'tabungan_id',
        'admin_id',
        'tanggal',
        'jenis',
        'nominal',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function tabungan(): BelongsTo
    {
        return $this->belongsTo(Tabungan::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
