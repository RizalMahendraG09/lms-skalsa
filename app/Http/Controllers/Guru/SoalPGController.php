<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSoalPGRequest;
use App\Http\Requests\UpdateSoalPGRequest;
use App\Models\SoalPG;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;

class SoalPGController extends Controller
{
    public function index(Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        $soalList = SoalPG::where('tugas_id', $tugas->id)->get();

        return view('guru.soal-pg.index', compact('tugas', 'soalList'));
    }

    public function create(Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        return view('guru.soal-pg.create', compact('tugas'));
    }

    public function store(StoreSoalPGRequest $request, Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        SoalPG::create([
            'tugas_id' => $tugas->id,
            'pertanyaan' => $request->pertanyaan,
            'opsi_a' => $request->opsi_a,
            'opsi_b' => $request->opsi_b,
            'opsi_c' => $request->opsi_c,
            'opsi_d' => $request->opsi_d,
            'jawaban_benar' => $request->jawaban_benar,
            'poin' => $request->poin,
        ]);

        return redirect()->route('guru.tugas.soal-pg.index', $tugas)
            ->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit(Tugas $tugas, SoalPG $soalPg)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        if ($soalPg->tugas_id !== $tugas->id) {
            abort(404);
        }

        return view('guru.soal-pg.edit', compact('tugas', 'soalPg'));
    }

    public function update(UpdateSoalPGRequest $request, Tugas $tugas, SoalPG $soalPg)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        if ($soalPg->tugas_id !== $tugas->id) {
            abort(404);
        }

        $soalPg->update([
            'pertanyaan' => $request->pertanyaan,
            'opsi_a' => $request->opsi_a,
            'opsi_b' => $request->opsi_b,
            'opsi_c' => $request->opsi_c,
            'opsi_d' => $request->opsi_d,
            'jawaban_benar' => $request->jawaban_benar,
            'poin' => $request->poin,
        ]);

        return redirect()->route('guru.tugas.soal-pg.index', $tugas)
            ->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Tugas $tugas, SoalPG $soalPg)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        if ($soalPg->tugas_id !== $tugas->id) {
            abort(404);
        }

        $soalPg->delete();

        return redirect()->route('guru.tugas.soal-pg.index', $tugas)
            ->with('success', 'Soal berhasil dihapus.');
    }
}
