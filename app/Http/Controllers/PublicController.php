<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\MataPelajaran;
use App\Models\Pengumuman;
use App\Models\SchoolProfile;
use App\Models\StaffProfile;
use App\Models\User;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function home()
    {
        $profil = SchoolProfile::first();
        $totalGuru = User::where('role', 'guru')->count();
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalMapel = MataPelajaran::count();
        $guruList = User::where('role', 'guru')->take(4)->get();
        $staffList = StaffProfile::aktif()->urut()->take(4)->get();
        $pengumumanList = Pengumuman::published()
            ->latest('tanggal_publish')
            ->latest('created_at')
            ->take(6)
            ->get();
        $galeriList = Gallery::latest()->take(8)->get();

        $sejarahRingkas = $profil ? Str::limit(strip_tags($profil->sejarah), 300) : null;

        return view('public.home', compact(
            'profil', 'totalGuru', 'totalSiswa', 'totalMapel',
            'guruList', 'staffList', 'sejarahRingkas',
            'pengumumanList', 'galeriList'
        ));
    }

    public function profilSekolah()
    {
        $profil = SchoolProfile::first();

        if (!$profil) {
            return view('public.profil-sekolah', ['profil' => null]);
        }

        $visiList = array_filter(array_map('trim', explode("\n", $profil->visi)));
        $misiList = array_filter(array_map('trim', explode("\n", $profil->misi)));

        return view('public.profil-sekolah', compact('profil', 'visiList', 'misiList'));
    }

    public function guruStaff()
    {
        $guruList = User::where('role', 'guru')->orderBy('name')->paginate(12);
        $staffList = StaffProfile::aktif()->urut()->get();

        return view('public.guru-staff', compact('guruList', 'staffList'));
    }

    public function kontak()
    {
        $profil = SchoolProfile::first();
        return view('public.kontak', compact('profil'));
    }
}
