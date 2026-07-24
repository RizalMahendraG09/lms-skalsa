<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:255',
        ]);

        $validated['foto'] = $request->file('foto')->store('gallery', 'public');

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('foto')) {
            if ($gallery->foto) {
                Storage::disk('public')->delete($gallery->foto);
            }
            $validated['foto'] = $request->file('foto')->store('gallery', 'public');
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->foto) {
            Storage::disk('public')->delete($gallery->foto);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto berhasil dihapus.');
    }
}
