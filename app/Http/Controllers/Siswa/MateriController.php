<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function index()
    {
        $kelasId = Auth::user()->kelas_id;

        $materiList = Materi::with('mataPelajaran', 'guru')
            ->whereHas('mataPelajaran', function ($q) use ($kelasId) {
                $q->where('kelas_id', $kelasId);
            })
            ->latest()
            ->paginate(10);

        return view('siswa.materi.index', compact('materiList'));
    }
}
