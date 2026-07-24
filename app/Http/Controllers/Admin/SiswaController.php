<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $siswaList = User::with('kelas')->where('role', 'siswa')->latest()->paginate(10);
        return view('siswa.index', compact('siswaList'));
    }

    public function create()
    {
        $kelasList = Kelas::all();
        return view('siswa.create', compact('kelasList'));
    }

    public function store(StoreSiswaRequest $request)
    {
        User::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit(User $siswa)
    {
        $kelasList = Kelas::all();
        return view('siswa.edit', compact('siswa', 'kelasList'));
    }

    public function update(UpdateSiswaRequest $request, User $siswa)
    {
        $data = [
            'name' => $request->name,
            'nis' => $request->nis,
            'email' => $request->email,
            'kelas_id' => $request->kelas_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy(User $siswa)
    {
        if ($siswa->role !== 'siswa') {
            return redirect()->route('admin.siswa.index')
                ->with('error', 'User ini bukan siswa.');
        }

        $siswa->delete();

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Siswa berhasil dihapus.');
    }
}
