<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materi;

class MateriController extends Controller
{
    public function index()
    {
        $materiList = Materi::with('mataPelajaran', 'guru', 'mataPelajaran.kelas')
            ->latest()
            ->paginate(10);

        return view('admin.materi.index', compact('materiList'));
    }
}
