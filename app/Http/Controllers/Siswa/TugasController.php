<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\JawabanEssay;
use App\Models\JawabanPG;
use App\Models\JawabanSiswa;
use App\Models\SoalEssay;
use App\Models\SoalPG;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function index()
    {
        $kelasId = Auth::user()->kelas_id;

        $tugasList = Tugas::with([
                'mataPelajaran',
                'guru',
                'jawabanSiswa' => fn($q) => $q->where('siswa_id', Auth::id()),
            ])
            ->whereHas('mataPelajaran', function ($q) use ($kelasId) {
                $q->where('kelas_id', $kelasId);
            })
            ->latest()
            ->paginate(10);

        return view('siswa.tugas.index', compact('tugasList'));
    }

    public function show(Tugas $tugas)
    {
        $kelasId = Auth::user()->kelas_id;

        if ($tugas->mataPelajaran->kelas_id !== $kelasId) {
            abort(403);
        }

        $soalPG = SoalPG::where('tugas_id', $tugas->id)->get();
        $soalEssay = SoalEssay::where('tugas_id', $tugas->id)->get();

        $jawaban = JawabanSiswa::where('siswa_id', Auth::id())
            ->where('tugas_id', $tugas->id)
            ->first();

        $jawabanPG = collect();
        $jawabanEssay = collect();
        if ($jawaban) {
            $jawabanPG = JawabanPG::where('jawaban_siswa_id', $jawaban->id)->get()->keyBy('soal_pg_id');
            $jawabanEssay = JawabanEssay::where('jawaban_siswa_id', $jawaban->id)->get()->keyBy('soal_essay_id');
        }

        return view('siswa.tugas.show', compact('tugas', 'soalPG', 'soalEssay', 'jawaban', 'jawabanPG', 'jawabanEssay'));
    }
}
