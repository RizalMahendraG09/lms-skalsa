<?php

namespace App\Http\Controllers;

use App\Models\SchoolProfile;
use App\Models\StaffProfile;
use App\Models\User;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = SchoolProfile::first();

        if (!$profil) {
            abort(404, 'Profil sekolah belum tersedia.');
        }

        $visiList = array_filter(array_map('trim', explode("\n", $profil->visi)));
        $misiList = array_filter(array_map('trim', explode("\n", $profil->misi)));

        return view('profil-sekolah.index', compact('profil', 'visiList', 'misiList'));
    }

    public function guruStaff()
    {
        $guruList = User::where('role', 'guru')
            ->orderBy('name')
            ->paginate(12);

        $staffList = StaffProfile::aktif()->urut()->get();

        return view('guru-staff.index', compact('guruList', 'staffList'));
    }
}
