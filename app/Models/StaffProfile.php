<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class StaffProfile extends Model
{
    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'email',
        'telepon',
        'urutan',
        'status_aktif',
    ];

    protected function casts(): array
    {
        return [
            'urutan' => 'integer',
        ];
    }

    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto ? Storage::url($this->foto) : null;
    }

    public function scopeAktif($query)
    {
        return $query->where('status_aktif', 'aktif');
    }

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}
