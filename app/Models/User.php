<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'nis',
        'email',
        'foto',
        'password',
        'role',
        'kelas_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'string',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isGuru(): bool
    {
        return $this->role === 'guru';
    }

    public function isSiswa(): bool
    {
        return $this->role === 'siswa';
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mataPelajarans(): HasMany
    {
        return $this->hasMany(MataPelajaran::class, 'guru_id');
    }

    public function jawabanSiswa(): HasMany
    {
        return $this->hasMany(JawabanSiswa::class, 'siswa_id');
    }

    public function pertemuans(): HasMany
    {
        return $this->hasMany(Pertemuan::class, 'guru_id');
    }

    public function absensiSiswa(): HasMany
    {
        return $this->hasMany(AbsensiSiswa::class, 'siswa_id');
    }

    public function tabungan(): HasOne
    {
        return $this->hasOne(Tabungan::class, 'siswa_id');
    }
}
