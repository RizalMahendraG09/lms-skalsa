<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AbsensiSiswa extends Model
{
    protected $table = 'absensi_siswa';

    protected $fillable = [
        'pertemuan_id',
        'siswa_id',
        'status',
        'waktu_absen',
    ];

    protected function casts(): array
    {
        return [
            'waktu_absen' => 'datetime',
        ];
    }

    public function pertemuan(): BelongsTo
    {
        return $this->belongsTo(Pertemuan::class);
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
