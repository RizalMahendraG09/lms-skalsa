<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffProfileController extends Controller
{
    public function index()
    {
        $staffList = StaffProfile::orderBy('urutan', 'asc')->paginate(10);
        return view('admin.staff.index', compact('staffList'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'urutan' => 'required|integer|min:0',
            'status_aktif' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('staff', 'public');
        }

        StaffProfile::create($validated);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff berhasil ditambahkan.');
    }

    public function edit(StaffProfile $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, StaffProfile $staff)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'urutan' => 'required|integer|min:0',
            'status_aktif' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->hasFile('foto')) {
            if ($staff->foto) {
                Storage::disk('public')->delete($staff->foto);
            }
            $validated['foto'] = $request->file('foto')->store('staff', 'public');
        }

        $staff->update($validated);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff berhasil diperbarui.');
    }

    public function destroy(StaffProfile $staff)
    {
        if ($staff->foto) {
            Storage::disk('public')->delete($staff->foto);
        }

        $staff->delete();

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff berhasil dihapus.');
    }
}
