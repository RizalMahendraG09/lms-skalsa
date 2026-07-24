<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JawabanEssay;
use App\Models\JawabanPG;
use App\Models\JawabanSiswa;
use App\Models\MataPelajaran;
use App\Models\NilaiEssayDetail;
use App\Models\SoalEssay;
use App\Models\SoalPG;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index(Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        $kelasId = $tugas->mataPelajaran->kelas_id;

        $siswaList = User::where('role', 'siswa')
            ->where('kelas_id', $kelasId)
            ->with(['jawabanSiswa' => fn($q) => $q->where('tugas_id', $tugas->id)])
            ->orderBy('name')
            ->get();

        return view('guru.nilai.index', compact('tugas', 'siswaList'));
    }

    public function show(Tugas $tugas, JawabanSiswa $jawabanSiswa)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        if ($jawabanSiswa->tugas_id !== $tugas->id) {
            abort(404);
        }

        $soalPG = SoalPG::where('tugas_id', $tugas->id)->get();
        $soalEssays = SoalEssay::where('tugas_id', $tugas->id)->get();

        $jawabanPG = JawabanPG::with('soalPG')
            ->where('jawaban_siswa_id', $jawabanSiswa->id)
            ->get()
            ->keyBy('soal_pg_id');

        $jawabanEssays = JawabanEssay::with('nilaiEssayDetail')
            ->where('jawaban_siswa_id', $jawabanSiswa->id)
            ->get()
            ->keyBy('soal_essay_id');

        return view('guru.nilai.show', compact('tugas', 'jawabanSiswa', 'soalPG', 'soalEssays', 'jawabanPG', 'jawabanEssays'));
    }

    public function store(Request $request, Tugas $tugas, JawabanSiswa $jawabanSiswa)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        if ($jawabanSiswa->tugas_id !== $tugas->id) {
            abort(404);
        }

        $soalEssays = SoalEssay::where('tugas_id', $tugas->id)->get();

        $rules = [];
        foreach ($soalEssays as $soal) {
            $rules["nilai_{$soal->id}"] = 'required|integer|min:0|max:' . $soal->poin;
            $rules["catatan_{$soal->id}"] = 'nullable|string|max:500';
        }

        $request->validate($rules);

        DB::transaction(function () use ($request, $jawabanSiswa, $soalEssays) {
            $totalNilai = 0;
            $totalMaks = 0;

            foreach ($soalEssays as $soal) {
                $jawabanEssay = JawabanEssay::where('jawaban_siswa_id', $jawabanSiswa->id)
                    ->where('soal_essay_id', $soal->id)
                    ->first();

                if (!$jawabanEssay) {
                    continue;
                }

                $nilai = (int) $request->input("nilai_{$soal->id}");
                $catatan = $request->input("catatan_{$soal->id}");

                NilaiEssayDetail::updateOrCreate(
                    ['jawaban_essay_id' => $jawabanEssay->id],
                    ['nilai' => $nilai, 'catatan' => $catatan]
                );

                $totalNilai += $nilai;
                $totalMaks += $soal->poin;
            }

            $nilaiEssay = $totalMaks > 0 ? round(($totalNilai / $totalMaks) * 100) : 0;
            $nilaiAkhir = ($jawabanSiswa->nilai_pg ?? 0) + $nilaiEssay;

            $jawabanSiswa->update([
                'nilai_essay' => $nilaiEssay,
                'nilai_akhir' => $nilaiAkhir,
                'status' => 'dinilai',
            ]);
        });

        return redirect()->route('guru.tugas.nilai', $tugas)
            ->with('success', 'Nilai essay berhasil disimpan.');
    }

    public function finalize(Tugas $tugas, JawabanSiswa $jawabanSiswa)
    {
        if ($tugas->guru_id !== Auth::id()) {
            abort(403);
        }

        if ($jawabanSiswa->tugas_id !== $tugas->id) {
            abort(404);
        }

        $jawabanSiswa->update([
            'nilai_akhir' => $jawabanSiswa->nilai_pg ?? 0,
            'status' => 'dinilai',
        ]);

        return redirect()->route('guru.tugas.nilai', $tugas)
            ->with('success', 'Nilai berhasil dikonfirmasi.');
    }

    public function rekap()
    {
        $guruId = Auth::id();

        $tugasList = Tugas::with('mataPelajaran')
            ->where('guru_id', $guruId)
            ->withCount(['jawabanSiswa as total_submit' => fn($q) => $q->whereIn('status', ['submitted', 'dinilai'])])
            ->withCount(['jawabanSiswa as total_dinilai' => fn($q) => $q->where('status', 'dinilai')])
            ->latest()
            ->paginate(20);

        return view('guru.nilai.rekap', compact('tugasList'));
    }
}
