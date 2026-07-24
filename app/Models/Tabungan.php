<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tabungan extends Model
{
    protected $fillable = [
        'siswa_id',
        'saldo',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(TransaksiTabungan::class);
    }

    public function recalculateSaldo(): void
    {
        $totalSetor = $this->transaksi()->where('jenis', 'setor')->sum('nominal');
        $totalTarik = $this->transaksi()->where('jenis', 'tarik')->sum('nominal');
        $this->update(['saldo' => $totalSetor - $totalTarik]);
    }
}
