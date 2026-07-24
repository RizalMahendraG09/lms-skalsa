<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMateriRequest;
use App\Http\Requests\UpdateMateriRequest;
use App\Models\MataPelajaran;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $guruId = Auth::id();
        $materiList = Materi::with('mataPelajaran', 'guru')
            ->where('guru_id', $guruId)
            ->latest()
            ->paginate(10);

        return view('guru.materi.index', compact('materiList'));
    }

    public function create()
    {
        $guruId = Auth::id();
        $mapelList = MataPelajaran::where('guru_id', $guruId)->get();
        return view('guru.materi.create', compact('mapelList'));
    }

    public function store(StoreMateriRequest $request)
    {
        $file = $request->file('file_pdf');
        $path = $file->store('materi', 'public');

        Materi::create([
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'guru_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_pdf' => $path,
        ]);

        return redirect()->route('guru.materi.index')
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(Materi $materi)
    {
        if ($materi->guru_id !== Auth::id()) {
            abort(403);
        }

        $guruId = Auth::id();
        $mapelList = MataPelajaran::where('guru_id', $guruId)->get();
        return view('guru.materi.edit', compact('materi', 'mapelList'));
    }

    public function update(UpdateMateriRequest $request, Materi $materi)
    {
        if ($materi->guru_id !== Auth::id()) {
            abort(403);
        }

        $data = [
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('file_pdf')) {
            Storage::disk('public')->delete($materi->file_pdf);
            $data['file_pdf'] = $request->file('file_pdf')->store('materi', 'public');
        }

        $materi->update($data);

        return redirect()->route('guru.materi.index')
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->guru_id !== Auth::id()) {
            abort(403);
        }

        Storage::disk('public')->delete($materi->file_pdf);
        $materi->delete();

        return redirect()->route('guru.materi.index')
            ->with('success', 'Materi berhasil dihapus.');
    }
}
