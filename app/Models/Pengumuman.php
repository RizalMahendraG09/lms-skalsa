<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Pengumuman extends Model
{
    protected $table = 'pengumumans';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar_thumbnail',
        'status_publish',
        'tanggal_publish',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_publish' => 'datetime',
        ];
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->gambar_thumbnail ? Storage::url($this->gambar_thumbnail) : null;
    }

    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->isi), 150);
    }

    public function scopePublished($query)
    {
        return $query->where('status_publish', 'published');
    }

    public function scopeTerbaru($query)
    {
        return $query->where('status_publish', 'published')
            ->orderBy('tanggal_publish', 'desc')
            ->orderBy('created_at', 'desc');
    }
}
