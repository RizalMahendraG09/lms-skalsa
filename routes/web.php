<?php

use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\MateriController as AdminMateriController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\TugasController as AdminTugasController;
use App\Http\Controllers\Guru\MateriController as GuruMateriController;
use App\Http\Controllers\Guru\SoalPGController as GuruSoalPGController;
use App\Http\Controllers\Guru\SoalEssayController as GuruSoalEssayController;
use App\Http\Controllers\Guru\TugasController as GuruTugasController;
use App\Http\Controllers\Guru\NilaiController as GuruNilaiController;
use App\Http\Controllers\Guru\SesiAbsensiController as GuruSesiAbsensiController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumumanController;
use App\Http\Controllers\Admin\SchoolProfileController as AdminSchoolProfileController;
use App\Http\Controllers\Admin\StaffProfileController as AdminStaffProfileController;
use App\Http\Controllers\Admin\TabunganController as AdminTabunganController;
use App\Http\Controllers\ExportPdfController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Siswa\JawabanController as SiswaJawabanController;
use App\Http\Controllers\Siswa\MateriController as SiswaMateriController;
use App\Http\Controllers\Siswa\NilaiController as SiswaNilaiController;
use App\Http\Controllers\Siswa\AbsensiController as SiswaAbsensiController;
use App\Http\Controllers\Siswa\TugasController as SiswaTugasController;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Materi;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', [PublicController::class, 'home'])->name('public.home');
Route::get('kontak', [PublicController::class, 'kontak'])->name('public.kontak');

Route::get('/dashboard', function () {
    $role = Auth::user()->role;
    return redirect()->route("{$role}.dashboard");
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('profil-sekolah', [PublicController::class, 'profilSekolah'])->name('public.profil-sekolah');
Route::get('guru-staff', [PublicController::class, 'guruStaff'])->name('public.guru-staff');
Route::get('pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::get('pengumuman/{slug}', [PengumumanController::class, 'show'])->name('pengumuman.show');
Route::get('galeri', [GaleriController::class, 'index'])->name('galeri.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            $totalGuru = User::where('role', 'guru')->count();
            $totalSiswa = User::where('role', 'siswa')->count();
            $totalKelas = Kelas::count();
            $totalMapel = MataPelajaran::count();
            $totalMateri = Materi::count();
            $totalPengumuman = App\Models\Pengumuman::published()->count();
            return view('dashboard-admin', compact(
                'totalGuru', 'totalSiswa', 'totalKelas', 'totalMapel', 'totalMateri', 'totalPengumuman'
            ));
        })->name('dashboard');

        Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas']);
        Route::resource('guru', GuruController::class)->parameters(['guru' => 'guru'])->except(['show']);
        Route::resource('siswa', SiswaController::class)->parameters(['siswa' => 'siswa'])->except(['show']);
        Route::resource('mata-pelajaran', MataPelajaranController::class)->except(['show']);
        Route::resource('materi', AdminMateriController::class)->only(['index']);
        Route::resource('tugas', AdminTugasController::class)->only(['index']);

        Route::get('rekap-nilai/pdf', [ExportPdfController::class, 'rekapNilai'])->name('rekap-nilai.pdf');
        Route::get('rekap-absensi/pdf', [ExportPdfController::class, 'rekapAbsensi'])->name('rekap-absensi.pdf');

        Route::get('profil-sekolah', [AdminSchoolProfileController::class, 'index'])->name('profil-sekolah.index');
        Route::get('profil-sekolah/create', [AdminSchoolProfileController::class, 'create'])->name('profil-sekolah.create');
        Route::post('profil-sekolah', [AdminSchoolProfileController::class, 'store'])->name('profil-sekolah.store');
        Route::get('profil-sekolah/edit', [AdminSchoolProfileController::class, 'edit'])->name('profil-sekolah.edit');
        Route::put('profil-sekolah', [AdminSchoolProfileController::class, 'update'])->name('profil-sekolah.update');

        Route::resource('staff', AdminStaffProfileController::class)->parameters(['staff' => 'staff']);

        Route::resource('pengumuman', AdminPengumumanController::class)->parameters(['pengumuman' => 'pengumuman']);

        Route::resource('gallery', AdminGalleryController::class)->parameters(['gallery' => 'gallery']);

        Route::prefix('tabungan')->name('tabungan.')->group(function () {
            Route::get('init', [AdminTabunganController::class, 'init'])->name('init');
            Route::get('dashboard', [AdminTabunganController::class, 'dashboard'])->name('dashboard');
            Route::get('/', [AdminTabunganController::class, 'index'])->name('index');

            Route::get('laporan', [AdminTabunganController::class, 'laporan'])->name('laporan');
            Route::get('laporan/pdf', [AdminTabunganController::class, 'exportPdf'])->name('laporan.pdf');
            Route::get('laporan/excel', [AdminTabunganController::class, 'exportExcel'])->name('laporan.excel');

            Route::get('{tabungan}', [AdminTabunganController::class, 'show'])->name('show');
            Route::get('{tabungan}/setor', [AdminTabunganController::class, 'createSetor'])->name('setor');
            Route::post('{tabungan}/setor', [AdminTabunganController::class, 'storeSetor'])->name('setor.store');
            Route::get('{tabungan}/tarik', [AdminTabunganController::class, 'createTarik'])->name('tarik');
            Route::post('{tabungan}/tarik', [AdminTabunganController::class, 'storeTarik'])->name('tarik.store');
            Route::get('{tabungan}/transaksi/{transaksi}/edit', [AdminTabunganController::class, 'editTransaksi'])->name('transaksi.edit');
            Route::put('{tabungan}/transaksi/{transaksi}', [AdminTabunganController::class, 'updateTransaksi'])->name('transaksi.update');
            Route::delete('{tabungan}/transaksi/{transaksi}', [AdminTabunganController::class, 'destroyTransaksi'])->name('transaksi.destroy');
        });
    });

    Route::middleware('role:guru')->prefix('guru')->name('guru.')->group(function () {
        Route::get('/dashboard', function () {
            $totalMapel = MataPelajaran::where('guru_id', Auth::id())->count();
            $totalMateri = Materi::where('guru_id', Auth::id())->count();
            $totalTugas = Tugas::where('guru_id', Auth::id())->count();
            $pengumumanTerbaru = App\Models\Pengumuman::terbaru()->take(3)->get();
            return view('dashboard-guru', compact('totalMapel', 'totalMateri', 'totalTugas', 'pengumumanTerbaru'));
        })->name('dashboard');

        Route::resource('materi', GuruMateriController::class)->parameters(['materi' => 'materi'])->except(['show']);
        Route::resource('tugas', GuruTugasController::class)->parameters(['tugas' => 'tugas'])->except(['show']);
        Route::resource('tugas.soal-pg', GuruSoalPGController::class)->parameters(['tugas' => 'tugas', 'soal_pg' => 'soal_pg'])->except(['show']);
        Route::resource('tugas.soal-essay', GuruSoalEssayController::class)->parameters(['tugas' => 'tugas', 'soal_essay' => 'soal_essay'])->except(['show']);
        Route::get('tugas/{tugas}/nilai', [GuruNilaiController::class, 'index'])->name('tugas.nilai');
        Route::get('tugas/{tugas}/nilai/{jawabanSiswa}', [GuruNilaiController::class, 'show'])->name('tugas.nilai.show');
        Route::post('tugas/{tugas}/nilai/{jawabanSiswa}', [GuruNilaiController::class, 'store'])->name('tugas.nilai.store');
        Route::post('tugas/{tugas}/nilai/{jawabanSiswa}/finalize', [GuruNilaiController::class, 'finalize'])->name('tugas.nilai.finalize');

        Route::get('rekap-nilai', [GuruNilaiController::class, 'rekap'])->name('rekap-nilai.index');
        Route::get('rekap-nilai/pdf', [ExportPdfController::class, 'rekapNilai'])->name('rekap-nilai.pdf');

        Route::resource('sesi-absensi', GuruSesiAbsensiController::class)->except(['show']);
        Route::get('rekap-absensi', [GuruSesiAbsensiController::class, 'rekap'])->name('sesi-absensi.rekap');
        Route::get('rekap-absensi/pdf', [ExportPdfController::class, 'rekapAbsensi'])->name('rekap-absensi.pdf');
    });

    Route::middleware('role:siswa')->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', function () {
            $mapelIds = MataPelajaran::where('kelas_id', Auth::user()->kelas_id)->pluck('id');
            $totalMapel = $mapelIds->count();
            $totalMateri = Materi::whereIn('mata_pelajaran_id', $mapelIds)->count();
            $totalTugas = Tugas::whereIn('mata_pelajaran_id', $mapelIds)->count();
            $materiTerbaru = Materi::whereIn('mata_pelajaran_id', $mapelIds)
                ->with('mataPelajaran')->latest()->take(5)->get();
            $pengumumanTerbaru = App\Models\Pengumuman::terbaru()->take(3)->get();
            return view('dashboard-siswa', compact(
                'totalMapel', 'totalMateri', 'totalTugas', 'materiTerbaru', 'pengumumanTerbaru'
            ));
        })->name('dashboard');

        Route::resource('materi', SiswaMateriController::class)->only(['index']);
        Route::resource('tugas', SiswaTugasController::class)->parameters(['tugas' => 'tugas'])->only(['index', 'show']);
        Route::get('tugas/{tugas}/kerjakan', [SiswaTugasController::class, 'show'])->name('tugas.kerjakan');
        Route::post('tugas/{tugas}/submit', [SiswaJawabanController::class, 'submit'])->name('tugas.submit');

        Route::get('absensi', [SiswaAbsensiController::class, 'index'])->name('absensi.index');
        Route::post('absensi', [SiswaAbsensiController::class, 'store'])->name('absensi.store');
        Route::get('rekap-absensi', [SiswaAbsensiController::class, 'rekap'])->name('absensi.rekap');

        Route::get('rekap-nilai', [SiswaNilaiController::class, 'index'])->name('rekap-nilai.index');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
 

Route::get('/debug', function (Request $request) {
    return response()->json([
        'isSecure' => $request->isSecure(),
        'scheme' => $request->getScheme(),
        'url' => url('/'),
        'asset' => asset('build/manifest.json'),
        'headers' => [
            'x-forwarded-proto' => $request->header('x-forwarded-proto'),
            'host' => $request->header('host'),
        ],
    ]);
});