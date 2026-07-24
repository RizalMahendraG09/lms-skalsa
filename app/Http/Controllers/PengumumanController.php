<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        $search = request('search');

        $pengumumanList = Pengumuman::published()
            ->when($search, fn($q) => $q->where('judul', 'like', "%{$search}%"))
            ->orderBy('tanggal_publish', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('pengumuman.index', compact('pengumumanList', 'search'));
    }

    public function show($slug)
    {
        $pengumuman = Pengumuman::where('slug', $slug)
            ->where('status_publish', 'published')
            ->firstOrFail();

        $recent = Pengumuman::published()
            ->where('id', '!=', $pengumuman->id)
            ->orderBy('tanggal_publish', 'desc')
            ->take(5)
            ->get();

        return view('pengumuman.show', compact('pengumuman', 'recent'));
    }
}
