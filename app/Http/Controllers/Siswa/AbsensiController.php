<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAbsensiRequest;
use App\Models\AbsensiSiswa;
use App\Models\MataPelajaran;
use App\Models\Pertemuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function index()
    {
        $kelasId = Auth::user()->kelas_id;
        $siswaId = Auth::id();

        $sesiList = Pertemuan::with([
                'mataPelajaran',
                'guru',
                'absensiSiswa' => fn($q) => $q->where('siswa_id', $siswaId),
            ])
            ->where('status', 'aktif')
            ->whereHas('mataPelajaran', function ($q) use ($kelasId) {
                $q->where('kelas_id', $kelasId);
            })
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        return view('siswa.absensi.index', compact('sesiList'));
    }

    public function store(StoreAbsensiRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $pertemuan = Pertemuan::findOrFail($request->pertemuan_id);
            $tanggal = $pertemuan->tanggal->format('Y-m-d');
            $mulai = Carbon::parse($tanggal . ' ' . $pertemuan->jam_mulai->format('H:i'));
            $now = Carbon::now();

            $diffMinutes = (int) $mulai->diffInMinutes($now);
            $status = $diffMinutes <= 15 ? 'hadir' : 'terlambat';

            AbsensiSiswa::create([
                'pertemuan_id' => $pertemuan->id,
                'siswa_id' => Auth::id(),
                'status' => $status,
                'waktu_absen' => $now,
            ]);

            $label = $status === 'hadir' ? 'Hadir' : 'Terlambat';

            return redirect()->route('siswa.absensi.index')
                ->with('success', "Absensi berhasil dicatat sebagai {$label}.");
        });
    }

    public function rekap(Request $request)
    {
        $siswaId = Auth::id();
        $kelasId = Auth::user()->kelas_id;

        $query = DB::table('pertemuan')
            ->join('mata_pelajarans', 'pertemuan.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->leftJoin('absensi_siswa', function ($join) use ($siswaId) {
                $join->on('pertemuan.id', '=', 'absensi_siswa.pertemuan_id')
                     ->where('absensi_siswa.siswa_id', '=', $siswaId);
            })
            ->where('mata_pelajarans.kelas_id', $kelasId)
            ->select(
                'pertemuan.judul_pertemuan',
                'pertemuan.tanggal',
                'pertemuan.jam_mulai',
                'pertemuan.jam_selesai',
                'mata_pelajarans.nama_mapel',
                'absensi_siswa.status as absensi_status',
                'absensi_siswa.waktu_absen',
            )
            ->orderBy('pertemuan.tanggal', 'desc')
            ->orderBy('pertemuan.jam_mulai', 'desc');

        $rekapList = $query->paginate(15)->withQueryString();

        $hadir = (clone $query)->where('absensi_siswa.status', 'hadir')->count();
        $terlambat = (clone $query)->where('absensi_siswa.status', 'terlambat')->count();
        $tidakHadir = (clone $query)->whereNull('absensi_siswa.status')->count();
        $total = $hadir + $terlambat + $tidakHadir;
        $persentase = $total > 0 ? round(($hadir / $total) * 100, 1) : 0;

        return view('siswa.absensi.rekap', compact(
            'rekapList', 'hadir', 'terlambat', 'tidakHadir', 'total', 'persentase'
        ));
    }
}
