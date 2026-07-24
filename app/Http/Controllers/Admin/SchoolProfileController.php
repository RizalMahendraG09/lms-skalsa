<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    public function index()
    {
        $profil = SchoolProfile::first();

        if ($profil) {
            return view('admin.profil-sekolah.index', compact('profil'));
        }

        return view('admin.profil-sekolah.create');
    }

    public function create()
    {
        return view('admin.profil-sekolah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'website' => 'nullable|string|max:255',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'sejarah' => 'required|string',
            'kepala_sekolah' => 'required|string|max:255',
            'foto_kepala_sekolah' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('school', 'public');
        }

        if ($request->hasFile('foto_kepala_sekolah')) {
            $validated['foto_kepala_sekolah'] = $request->file('foto_kepala_sekolah')->store('school', 'public');
        }

        SchoolProfile::create($validated);

        return redirect()->route('admin.profil-sekolah.index')
            ->with('success', 'Profil sekolah berhasil dibuat.');
    }

    public function edit()
    {
        $profil = SchoolProfile::firstOrFail();
        return view('admin.profil-sekolah.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $profil = SchoolProfile::firstOrFail();

        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'website' => 'nullable|string|max:255',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'sejarah' => 'required|string',
            'kepala_sekolah' => 'required|string|max:255',
            'foto_kepala_sekolah' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($profil->logo) {
                Storage::disk('public')->delete($profil->logo);
            }
            $validated['logo'] = $request->file('logo')->store('school', 'public');
        }

        if ($request->hasFile('foto_kepala_sekolah')) {
            if ($profil->foto_kepala_sekolah) {
                Storage::disk('public')->delete($profil->foto_kepala_sekolah);
            }
            $validated['foto_kepala_sekolah'] = $request->file('foto_kepala_sekolah')->store('school', 'public');
        }

        $profil->update($validated);

        return redirect()->route('admin.profil-sekolah.index')
            ->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}
