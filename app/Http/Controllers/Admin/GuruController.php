<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        $guruList = User::where('role', 'guru')->latest()->paginate(10);
        return view('guru.index', compact('guruList'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(StoreGuruRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil ditambahkan.');
    }

    public function edit(User $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(UpdateGuruRequest $request, User $guru)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $guru->update($data);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil diperbarui.');
    }

    public function destroy(User $guru)
    {
        if ($guru->role !== 'guru') {
            return redirect()->route('admin.guru.index')
                ->with('error', 'User ini bukan guru.');
        }

        $guru->delete();

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil dihapus.');
    }
}
