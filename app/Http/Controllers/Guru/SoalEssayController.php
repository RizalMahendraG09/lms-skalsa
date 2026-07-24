<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSoalEssayRequest;
use App\Http\Requests\UpdateSoalEssayRequest;
use App\Models\SoalEssay;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;

class SoalEssayController extends Controller
{
    public function index(Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        $soalList = SoalEssay::where('tugas_id', $tugas->id)->get();

        return view('guru.soal-essay.index', compact('tugas', 'soalList'));
    }

    public function create(Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        return view('guru.soal-essay.create', compact('tugas'));
    }

    public function store(StoreSoalEssayRequest $request, Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        SoalEssay::create([
            'tugas_id' => $tugas->id,
            'pertanyaan' => $request->pertanyaan,
            'poin' => $request->poin,
        ]);

        return redirect()->route('guru.tugas.soal-essay.index', $tugas)
            ->with('success', 'Soal essay berhasil ditambahkan.');
    }

    public function edit(Tugas $tugas, SoalEssay $soalEssay)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        if ($soalEssay->tugas_id !== $tugas->id) {
            abort(404);
        }

        return view('guru.soal-essay.edit', compact('tugas', 'soalEssay'));
    }

    public function update(UpdateSoalEssayRequest $request, Tugas $tugas, SoalEssay $soalEssay)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        if ($soalEssay->tugas_id !== $tugas->id) {
            abort(404);
        }

        $soalEssay->update([
            'pertanyaan' => $request->pertanyaan,
            'poin' => $request->poin,
        ]);

        return redirect()->route('guru.tugas.soal-essay.index', $tugas)
            ->with('success', 'Soal essay berhasil diperbarui.');
    }

    public function destroy(Tugas $tugas, SoalEssay $soalEssay)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        if ($soalEssay->tugas_id !== $tugas->id) {
            abort(404);
        }

        $soalEssay->delete();

        return redirect()->route('guru.tugas.soal-essay.index', $tugas)
            ->with('success', 'Soal essay berhasil dihapus.');
    }
}
