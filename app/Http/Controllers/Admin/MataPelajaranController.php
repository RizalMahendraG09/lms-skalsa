<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMataPelajaranRequest;
use App\Http\Requests\UpdateMataPelajaranRequest;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\User;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mapelList = MataPelajaran::with('guru', 'kelas')->latest()->paginate(10);
        return view('mata-pelajaran.index', compact('mapelList'));
    }

    public function create()
    {
        $guruList = User::where('role', 'guru')->get();
        $kelasList = Kelas::all();
        return view('mata-pelajaran.create', compact('guruList', 'kelasList'));
    }

    public function store(StoreMataPelajaranRequest $request)
    {
        MataPelajaran::create($request->validated());

        return redirect()->route('admin.mata-pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function edit(MataPelajaran $mataPelajaran)
    {
        $guruList = User::where('role', 'guru')->get();
        $kelasList = Kelas::all();
        return view('mata-pelajaran.edit', compact('mataPelajaran', 'guruList', 'kelasList'));
    }

    public function update(UpdateMataPelajaranRequest $request, MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->update($request->validated());

        return redirect()->route('admin.mata-pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy(MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->delete();

        return redirect()->route('admin.mata-pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
