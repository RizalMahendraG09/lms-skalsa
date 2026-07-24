<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tugas;

class TugasController extends Controller
{
    public function index()
    {
        $tugasList = Tugas::with('mataPelajaran', 'guru', 'mataPelajaran.kelas')
            ->latest()
            ->paginate(10);

        return view('admin.tugas.index', compact('tugasList'));
    }
}
