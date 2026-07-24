<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSesiAbsensiRequest;
use App\Http\Requests\UpdateSesiAbsensiRequest;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Pertemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SesiAbsensiController extends Controller
{
    public function index()
    {
        $guruId = Auth::id();
        $sesiAbsensiList = Pertemuan::with('mataPelajaran')
            ->where('guru_id', $guruId)
            ->latest()
            ->paginate(10);

        return view('guru.sesi-absensi.index', compact('sesiAbsensiList'));
    }

    public function create()
    {
        $guruId = Auth::id();
        $mapelList = MataPelajaran::where('guru_id', $guruId)->get();

        return view('guru.sesi-absensi.create', compact('mapelList'));
    }

    public function store(StoreSesiAbsensiRequest $request)
    {
        Pertemuan::create([
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'guru_id' => Auth::id(),
            'judul_pertemuan' => $request->judul_pertemuan,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status ?? 'draft',
        ]);

        return redirect()->route('guru.sesi-absensi.index')
            ->with('success', 'Sesi absensi berhasil ditambahkan.');
    }

    public function edit(Pertemuan $sesiAbsensi)
    {
        if ($sesiAbsensi->guru_id !== Auth::id()) {
            abort(403);
        }

        $guruId = Auth::id();
        $mapelList = MataPelajaran::where('guru_id', $guruId)->get();

        return view('guru.sesi-absensi.edit', compact('sesiAbsensi', 'mapelList'));
    }

    public function update(UpdateSesiAbsensiRequest $request, Pertemuan $sesiAbsensi)
    {
        if ($sesiAbsensi->guru_id !== Auth::id()) {
            abort(403);
        }

        $sesiAbsensi->update([
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'judul_pertemuan' => $request->judul_pertemuan,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('guru.sesi-absensi.index')
            ->with('success', 'Sesi absensi berhasil diperbarui.');
    }

    public function destroy(Pertemuan $sesiAbsensi)
    {
        if ($sesiAbsensi->guru_id !== Auth::id()) {
            abort(403);
        }

        $sesiAbsensi->delete();

        return redirect()->route('guru.sesi-absensi.index')
            ->with('success', 'Sesi absensi berhasil dihapus.');
    }

    public function rekap(Request $request)
    {
        $guruId = Auth::id();

        $mapelList = MataPelajaran::where('guru_id', $guruId)->get();
        $kelasList = Kelas::orderBy('nama_kelas')->get();

        $query = DB::table('pertemuan')
            ->join('mata_pelajarans', 'pertemuan.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->join('users as siswa', 'mata_pelajarans.kelas_id', '=', 'siswa.kelas_id')
            ->leftJoin('absensi_siswa', function ($join) {
                $join->on('pertemuan.id', '=', 'absensi_siswa.pertemuan_id')
                     ->on('siswa.id', '=', 'absensi_siswa.siswa_id');
            })
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->where('pertemuan.guru_id', $guruId)
            ->where('siswa.role', 'siswa')
            ->select(
                'pertemuan.id as pertemuan_id',
                'pertemuan.judul_pertemuan',
                'pertemuan.tanggal',
                'pertemuan.jam_mulai',
                'pertemuan.jam_selesai',
                'mata_pelajarans.nama_mapel',
                'mata_pelajarans.id as mata_pelajaran_id',
                'siswa.id as siswa_id',
                'siswa.name as nama_siswa',
                'siswa.nis',
                'kelas.id as kelas_id',
                'kelas.nama_kelas',
                'absensi_siswa.status as absensi_status',
                'absensi_siswa.waktu_absen',
            );

        $query->when($request->filled('mata_pelajaran_id'), function ($q) use ($request) {
            return $q->where('pertemuan.mata_pelajaran_id', $request->mata_pelajaran_id);
        });

        $query->when($request->filled('kelas_id'), function ($q) use ($request) {
            return $q->where('siswa.kelas_id', $request->kelas_id);
        });

        $query->when($request->filled('start_date'), function ($q) use ($request) {
            return $q->where('pertemuan.tanggal', '>=', $request->start_date);
        });

        $query->when($request->filled('end_date'), function ($q) use ($request) {
            return $q->where('pertemuan.tanggal', '<=', $request->end_date);
        });

        $query->orderBy('pertemuan.tanggal', 'desc')
            ->orderBy('pertemuan.jam_mulai', 'desc')
            ->orderBy('siswa.name');

        $rekapList = $query->paginate(15)->withQueryString();

        $hadir = (clone $query)->where('absensi_siswa.status', 'hadir')->count();
        $terlambat = (clone $query)->where('absensi_siswa.status', 'terlambat')->count();
        $tidakHadir = (clone $query)->whereNull('absensi_siswa.status')->count();

        return view('guru.sesi-absensi.rekap', compact(
            'rekapList', 'mapelList', 'kelasList', 'hadir', 'terlambat', 'tidakHadir'
        ));
    }
}
