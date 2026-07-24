<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExportPdfController extends Controller
{
    public function rekapNilai(Request $request)
    {
        $isGuru = Auth::user()->role === 'guru';
        $guruId = Auth::id();
        $namaGuru = $isGuru ? Auth::user()->name : null;

        $query = DB::table('jawaban_siswa')
            ->join('users as siswa', 'jawaban_siswa.siswa_id', '=', 'siswa.id')
            ->join('tugas', 'jawaban_siswa.tugas_id', '=', 'tugas.id')
            ->join('mata_pelajarans', 'tugas.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->where('siswa.role', 'siswa')
            ->when($isGuru, fn($q) => $q->where('tugas.guru_id', $guruId))
            ->when($request->filled('mata_pelajaran_id'), fn($q) => $q->where('tugas.mata_pelajaran_id', $request->mata_pelajaran_id))
            ->when($request->filled('kelas_id'), fn($q) => $q->where('siswa.kelas_id', $request->kelas_id))
            ->select(
                'siswa.name as nama_siswa',
                'siswa.nis',
                'kelas.nama_kelas',
                'mata_pelajarans.nama_mapel',
                'tugas.judul as tugas_judul',
                'jawaban_siswa.nilai_pg',
                'jawaban_siswa.nilai_essay',
                'jawaban_siswa.nilai_akhir',
                'jawaban_siswa.status as jawaban_status',
            )
            ->orderBy('siswa.name')
            ->orderBy('mata_pelajarans.nama_mapel')
            ->orderBy('tugas.judul')
            ->get();

        $pdf = Pdf::loadView('pdf.rekap-nilai', compact('query', 'namaGuru'));
        return $pdf->download('rekap-nilai.pdf');
    }

    public function rekapAbsensi(Request $request)
    {
        $isGuru = Auth::user()->role === 'guru';
        $guruId = Auth::id();
        $namaGuru = $isGuru ? Auth::user()->name : null;

        $query = DB::table('pertemuan')
            ->join('mata_pelajarans', 'pertemuan.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->join('users as siswa', 'mata_pelajarans.kelas_id', '=', 'siswa.kelas_id')
            ->leftJoin('absensi_siswa', function ($join) {
                $join->on('pertemuan.id', '=', 'absensi_siswa.pertemuan_id')
                     ->on('siswa.id', '=', 'absensi_siswa.siswa_id');
            })
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->where('siswa.role', 'siswa')
            ->when($isGuru, fn($q) => $q->where('pertemuan.guru_id', $guruId))
            ->when($request->filled('mata_pelajaran_id'), fn($q) => $q->where('pertemuan.mata_pelajaran_id', $request->mata_pelajaran_id))
            ->when($request->filled('kelas_id'), fn($q) => $q->where('siswa.kelas_id', $request->kelas_id))
            ->when($request->filled('start_date'), fn($q) => $q->where('pertemuan.tanggal', '>=', $request->start_date))
            ->when($request->filled('end_date'), fn($q) => $q->where('pertemuan.tanggal', '<=', $request->end_date))
            ->select(
                'siswa.name as nama_siswa',
                'siswa.nis',
                'kelas.nama_kelas',
                'mata_pelajarans.nama_mapel',
                'pertemuan.judul_pertemuan',
                'pertemuan.tanggal',
                'pertemuan.jam_mulai',
                'pertemuan.jam_selesai',
                'absensi_siswa.status as absensi_status',
                'absensi_siswa.waktu_absen',
            )
            ->orderBy('pertemuan.tanggal', 'desc')
            ->orderBy('pertemuan.jam_mulai', 'desc')
            ->orderBy('siswa.name')
            ->get();

        $hadir = $query->where('absensi_status', 'hadir')->count();
        $terlambat = $query->where('absensi_status', 'terlambat')->count();
        $tidakHadir = $query->whereNull('absensi_status')->count();

        $pdf = Pdf::loadView('pdf.rekap-absensi', compact('query', 'hadir', 'terlambat', 'tidakHadir', 'namaGuru'));
        return $pdf->download('rekap-absensi.pdf');
    }
}
