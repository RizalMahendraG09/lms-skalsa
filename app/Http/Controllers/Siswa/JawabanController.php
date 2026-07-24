<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\JawabanEssay;
use App\Models\JawabanPG;
use App\Models\JawabanSiswa;
use App\Models\SoalEssay;
use App\Models\SoalPG;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JawabanController extends Controller
{
    public function submit(Request $request, Tugas $tugas)
    {
        $kelasId = Auth::user()->kelas_id;

        if ($tugas->mataPelajaran->kelas_id !== $kelasId) {
            abort(403);
        }

        $siswaId = Auth::id();

        $soalPG = SoalPG::where('tugas_id', $tugas->id)->get();
        $soalEssay = SoalEssay::where('tugas_id', $tugas->id)->get();

        $rules = [];
        foreach ($soalPG as $s) {
            $rules["pg.{$s->id}"] = ['required', 'in:A,B,C,D'];
        }
        foreach ($soalEssay as $s) {
            $rules["essay.{$s->id}"] = ['required', 'string'];
        }

        $request->validate($rules, [
            'pg.*.required' => 'Semua soal PG wajib dijawab.',
            'pg.*.in' => 'Jawaban PG tidak valid.',
            'essay.*.required' => 'Semua soal essay wajib diisi.',
        ]);

        DB::transaction(function () use ($tugas, $siswaId, $soalPG, $soalEssay, $request) {
            $jawaban = JawabanSiswa::where('siswa_id', $siswaId)
                ->where('tugas_id', $tugas->id)
                ->first();

            if (!$jawaban) {
                $jawaban = JawabanSiswa::create([
                    'siswa_id' => $siswaId,
                    'tugas_id' => $tugas->id,
                ]);
            }

            $jawaban->jawabanPG()->delete();
            $jawaban->jawabanEssay()->delete();

            $totalNilaiPG = 0;
            $maksNilaiPG = 0;

            foreach ($soalPG as $s) {
                $jawabanSiswa = $request->input("pg.{$s->id}");
                $benar = $jawabanSiswa === $s->jawaban_benar;
                $poinDidapat = $benar ? $s->poin : 0;

                JawabanPG::create([
                    'jawaban_siswa_id' => $jawaban->id,
                    'soal_pg_id' => $s->id,
                    'jawaban_siswa' => $jawabanSiswa,
                    'benar' => $benar,
                    'poin_didapat' => $poinDidapat,
                ]);

                $totalNilaiPG += $poinDidapat;
                $maksNilaiPG += $s->poin;
            }

            foreach ($soalEssay as $s) {
                JawabanEssay::create([
                    'jawaban_siswa_id' => $jawaban->id,
                    'soal_essay_id' => $s->id,
                    'jawaban' => $request->input("essay.{$s->id}"),
                ]);
            }

            $nilaiPG = $maksNilaiPG > 0 ? round(($totalNilaiPG / $maksNilaiPG) * 100) : 0;

            $jawaban->update([
                'nilai_pg' => $nilaiPG,
                'status' => 'submitted',
                'submitted_at' => now(),
            ]);
        });

        return redirect()->route('siswa.tugas.kerjakan', $tugas)
            ->with('success', 'Tugas berhasil dikumpulkan.');
    }
}
