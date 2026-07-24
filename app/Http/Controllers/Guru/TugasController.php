<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTugasRequest;
use App\Http\Requests\UpdateTugasRequest;
use App\Models\MataPelajaran;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function index()
    {
        $guruId = Auth::id();
        $tugasList = Tugas::with('mataPelajaran', 'mataPelajaran.kelas')
            ->where('guru_id', $guruId)
            ->latest()
            ->paginate(10);

        return view('guru.tugas.index', compact('tugasList'));
    }

    public function create()
    {
        $guruId = Auth::id();
        $mapelList = MataPelajaran::where('guru_id', $guruId)->get();
        return view('guru.tugas.create', compact('mapelList'));
    }

    public function store(StoreTugasRequest $request)
    {
        Tugas::create([
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'guru_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('guru.tugas.index')
            ->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function edit(Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        $guruId = Auth::id();
        $mapelList = MataPelajaran::where('guru_id', $guruId)->get();
        return view('guru.tugas.edit', compact('tugas', 'mapelList'));
    }

    public function update(UpdateTugasRequest $request, Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        $tugas->update([
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('guru.tugas.index')
            ->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        $tugas->delete();

        return redirect()->route('guru.tugas.index')
            ->with('success', 'Tugas berhasil dihapus.');
    }
}
