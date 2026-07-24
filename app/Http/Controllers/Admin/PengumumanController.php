<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumanList = Pengumuman::latest()->paginate(10);
        return view('admin.pengumuman.index', compact('pengumumanList'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status_publish' => 'required|in:draft,published',
            'tanggal_publish' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['judul']);

        $baseSlug = $validated['slug'];
        $counter = 1;
        while (Pengumuman::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $baseSlug . '-' . $counter++;
        }

        if ($request->hasFile('gambar_thumbnail')) {
            $validated['gambar_thumbnail'] = $request->file('gambar_thumbnail')->store('pengumuman', 'public');
        }

        if ($validated['status_publish'] === 'published' && !$validated['tanggal_publish']) {
            $validated['tanggal_publish'] = now();
        }

        Pengumuman::create($validated);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status_publish' => 'required|in:draft,published',
            'tanggal_publish' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['judul']);

        $baseSlug = $validated['slug'];
        $counter = 1;
        while (Pengumuman::where('slug', $validated['slug'])->where('id', '!=', $pengumuman->id)->exists()) {
            $validated['slug'] = $baseSlug . '-' . $counter++;
        }

        if ($request->hasFile('gambar_thumbnail')) {
            if ($pengumuman->gambar_thumbnail) {
                Storage::disk('public')->delete($pengumuman->gambar_thumbnail);
            }
            $validated['gambar_thumbnail'] = $request->file('gambar_thumbnail')->store('pengumuman', 'public');
        }

        if ($validated['status_publish'] === 'published' && !$validated['tanggal_publish']) {
            $validated['tanggal_publish'] = now();
        }

        $pengumuman->update($validated);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->gambar_thumbnail) {
            Storage::disk('public')->delete($pengumuman->gambar_thumbnail);
        }

        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
