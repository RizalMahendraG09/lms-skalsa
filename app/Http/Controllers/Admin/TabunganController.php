<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSetorRequest;
use App\Http\Requests\StoreTarikRequest;
use App\Http\Requests\UpdateTransaksiTabunganRequest;
use App\Models\Kelas;
use App\Models\Tabungan;
use App\Models\TransaksiTabungan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TabunganController extends Controller
{
    public function init()
    {
        $siswaTanpaTabungan = User::where('role', 'siswa')
            ->whereDoesntHave('tabungan')
            ->get();

        if ($siswaTanpaTabungan->isEmpty()) {
            return redirect()->route('admin.tabungan.index')
                ->with('success', 'Semua siswa sudah memiliki tabungan.');
        }

        foreach ($siswaTanpaTabungan as $siswa) {
            Tabungan::create(['siswa_id' => $siswa->id, 'saldo' => 0]);
        }

        return redirect()->route('admin.tabungan.index')
            ->with('success', 'Berhasil membuat ' . $siswaTanpaTabungan->count() . ' tabungan baru.');
    }

    public function dashboard()
    {
        $totalSiswa = Tabungan::count();
        $totalSaldo = Tabungan::sum('saldo');

        $hariIni = now()->toDateString();

        $setorHariIni = TransaksiTabungan::whereDate('created_at', $hariIni)
            ->where('jenis', 'setor')
            ->sum('nominal');

        $tarikHariIni = TransaksiTabungan::whereDate('created_at', $hariIni)
            ->where('jenis', 'tarik')
            ->sum('nominal');

        $transaksiHariIni = TransaksiTabungan::whereDate('created_at', $hariIni)->count();

        return view('admin.tabungan.dashboard', compact(
            'totalSiswa', 'totalSaldo', 'setorHariIni', 'tarikHariIni', 'transaksiHariIni'
        ));
    }

    public function index(Request $request)
    {
        $query = Tabungan::with('siswa.kelas');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kelas_id')) {
            $query->whereHas('siswa', fn($q) => $q->where('kelas_id', $request->kelas_id));
        }

        $tabunganList = $query->latest()->paginate(10)->withQueryString();
        $kelasList = Kelas::all();

        return view('admin.tabungan.index', compact('tabunganList', 'kelasList'));
    }

    public function show(Tabungan $tabungan)
    {
        $tabungan->load('siswa.kelas');
        $transaksi = $tabungan->transaksi()
            ->with('admin')
            ->latest()
            ->paginate(20);

        return view('admin.tabungan.show', compact('tabungan', 'transaksi'));
    }

    public function createSetor(Tabungan $tabungan)
    {
        $tabungan->load('siswa.kelas');
        return view('admin.tabungan.setor', compact('tabungan'));
    }

    public function storeSetor(StoreSetorRequest $request, Tabungan $tabungan)
    {
        DB::transaction(function () use ($request, $tabungan) {
            TransaksiTabungan::create([
                'tabungan_id' => $tabungan->id,
                'admin_id' => Auth::id(),
                'tanggal' => $request->tanggal,
                'jenis' => 'setor',
                'nominal' => $request->nominal,
                'keterangan' => $request->keterangan,
            ]);

            $tabungan->recalculateSaldo();
        });

        return redirect()->route('admin.tabungan.show', $tabungan)
            ->with('success', 'Setoran berhasil ditambahkan.');
    }

    public function createTarik(Tabungan $tabungan)
    {
        $tabungan->load('siswa.kelas');
        return view('admin.tabungan.tarik', compact('tabungan'));
    }

    public function storeTarik(StoreTarikRequest $request, Tabungan $tabungan)
    {
        DB::transaction(function () use ($request, $tabungan) {
            TransaksiTabungan::create([
                'tabungan_id' => $tabungan->id,
                'admin_id' => Auth::id(),
                'tanggal' => $request->tanggal,
                'jenis' => 'tarik',
                'nominal' => $request->nominal,
                'keterangan' => $request->keterangan,
            ]);

            $tabungan->recalculateSaldo();
        });

        return redirect()->route('admin.tabungan.show', $tabungan)
            ->with('success', 'Penarikan berhasil diproses.');
    }

    public function editTransaksi(Tabungan $tabungan, TransaksiTabungan $transaksi)
    {
        $tabungan->load('siswa.kelas');
        return view('admin.tabungan.edit-transaksi', compact('tabungan', 'transaksi'));
    }

    public function updateTransaksi(UpdateTransaksiTabunganRequest $request, Tabungan $tabungan, TransaksiTabungan $transaksi)
    {
        DB::transaction(function () use ($request, $tabungan, $transaksi) {
            $transaksi->update([
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal,
                'keterangan' => $request->keterangan,
            ]);

            $tabungan->recalculateSaldo();
        });

        return redirect()->route('admin.tabungan.show', $tabungan)
            ->with('success', 'Transaksi berhasil diubah.');
    }

    public function destroyTransaksi(Tabungan $tabungan, TransaksiTabungan $transaksi)
    {
        DB::transaction(function () use ($tabungan, $transaksi) {
            $transaksi->delete();
            $tabungan->recalculateSaldo();
        });

        return redirect()->route('admin.tabungan.show', $tabungan)
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    public function laporan(Request $request)
    {
        $query = TransaksiTabungan::with('tabungan.siswa.kelas', 'admin');

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        if ($request->filled('kelas_id')) {
            $query->whereHas('tabungan.siswa', fn($q) => $q->where('kelas_id', $request->kelas_id));
        }

        if ($request->filled('siswa_id')) {
            $query->whereHas('tabungan', fn($q) => $q->where('siswa_id', $request->siswa_id));
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $transaksiList = $query->latest('tanggal')->latest('created_at')->paginate(20)->withQueryString();

        $totalSetor = (clone $query)->where('jenis', 'setor')->sum('nominal');
        $totalTarik = (clone $query)->where('jenis', 'tarik')->sum('nominal');
        $saldoAkhir = $totalSetor - $totalTarik;

        $kelasList = Kelas::all();
        $siswaList = User::where('role', 'siswa')->orderBy('name')->get();

        return view('admin.tabungan.laporan', compact(
            'transaksiList', 'totalSetor', 'totalTarik', 'saldoAkhir', 'kelasList', 'siswaList'
        ));
    }

    public function exportPdf(Request $request)
    {
        $query = TransaksiTabungan::with('tabungan.siswa.kelas', 'admin');

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        if ($request->filled('kelas_id')) {
            $query->whereHas('tabungan.siswa', fn($q) => $q->where('kelas_id', $request->kelas_id));
        }

        if ($request->filled('siswa_id')) {
            $query->whereHas('tabungan', fn($q) => $q->where('siswa_id', $request->siswa_id));
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $transaksiList = $query->latest('tanggal')->latest('created_at')->get();

        $totalSetor = $transaksiList->where('jenis', 'setor')->sum('nominal');
        $totalTarik = $transaksiList->where('jenis', 'tarik')->sum('nominal');
        $saldoAkhir = $totalSetor - $totalTarik;

        $pdf = Pdf::loadView('pdf.laporan-tabungan', compact(
            'transaksiList', 'totalSetor', 'totalTarik', 'saldoAkhir'
        ));

        return $pdf->download('laporan-tabungan.pdf');
    }

    public function exportExcel(Request $request)
    {
        $query = TransaksiTabungan::with('tabungan.siswa.kelas', 'admin');

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        if ($request->filled('kelas_id')) {
            $query->whereHas('tabungan.siswa', fn($q) => $q->where('kelas_id', $request->kelas_id));
        }

        if ($request->filled('siswa_id')) {
            $query->whereHas('tabungan', fn($q) => $q->where('siswa_id', $request->siswa_id));
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $transaksiList = $query->latest('tanggal')->latest('created_at')->get();

        $totalSetor = $transaksiList->where('jenis', 'setor')->sum('nominal');
        $totalTarik = $transaksiList->where('jenis', 'tarik')->sum('nominal');
        $saldoAkhir = $totalSetor - $totalTarik;

        $filename = 'laporan-tabungan-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($transaksiList, $totalSetor, $totalTarik, $saldoAkhir) {
            $output = fopen('php://output', 'w');

            fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($output, ['No', 'Tanggal', 'NIS', 'Nama Siswa', 'Kelas', 'Jenis', 'Nominal', 'Keterangan', 'Admin']);

            foreach ($transaksiList as $i => $t) {
                fputcsv($output, [
                    $i + 1,
                    $t->tanggal->format('d/m/Y'),
                    $t->tabungan->siswa->nis ?? '-',
                    $t->tabungan->siswa->name,
                    $t->tabungan->siswa->kelas->nama_kelas ?? '-',
                    ucfirst($t->jenis),
                    number_format($t->nominal, 0, ',', '.'),
                    $t->keterangan ?? '-',
                    $t->admin->name,
                ]);
            }

            fputcsv($output, []);
            fputcsv($output, ['Total Setoran', 'Rp ' . number_format($totalSetor, 0, ',', '.')]);
            fputcsv($output, ['Total Penarikan', 'Rp ' . number_format($totalTarik, 0, ',', '.')]);
            fputcsv($output, ['Saldo Akhir', 'Rp ' . number_format($saldoAkhir, 0, ',', '.')]);

            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }
}
