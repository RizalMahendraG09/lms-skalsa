<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class GaleriController extends Controller
{
    public function index()
    {
        $kategoriList = Gallery::select('kategori')
            ->whereNotNull('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        $kategoriAktif = request('kategori');
        $galleries = Gallery::latest()
            ->when($kategoriAktif, fn($q) => $q->byKategori($kategoriAktif))
            ->paginate(12);

        return view('galeri.index', compact('galleries', 'kategoriList', 'kategoriAktif'));
    }
}
