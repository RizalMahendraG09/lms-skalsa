<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\JawabanSiswa;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $nilaiList = JawabanSiswa::with('tugas.mataPelajaran')
            ->where('siswa_id', Auth::id())
            ->orderByRaw("FIELD(status, 'dinilai', 'submitted', 'draft')")
            ->latest('updated_at')
            ->paginate(20);

        return view('siswa.nilai.index', compact('nilaiList'));
    }
}
