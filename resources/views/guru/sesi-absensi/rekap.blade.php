<x-app-layout>
    <x-slot name="header">Rekap Absensi</x-slot>

    <div class="space-y-4">
        {{-- Filter --}}
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <form method="GET" action="{{ route('guru.sesi-absensi.rekap') }}" class="flex flex-wrap gap-3 items-end">
                    <div class="form-control">
                        <label class="label label-text">Mata Pelajaran</label>
                        <select name="mata_pelajaran_id" class="select select-bordered">
                            <option value="">Semua Mapel</option>
                            @foreach ($mapelList as $mapel)
                                <option value="{{ $mapel->id }}" {{ request('mata_pelajaran_id') == $mapel->id ? 'selected' : '' }}>
                                    {{ $mapel->nama_mapel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control">
                        <label class="label label-text">Kelas</label>
                        <select name="kelas_id" class="select select-bordered">
                            <option value="">Semua Kelas</option>
                            @foreach ($kelasList as $kelas)
                                <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control">
                        <label class="label label-text">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="input input-bordered" value="{{ request('start_date') }}">
                    </div>

                    <div class="form-control">
                        <label class="label label-text">Tanggal Akhir</label>
                        <input type="date" name="end_date" class="input input-bordered" value="{{ request('end_date') }}">
                    </div>

                    <div class="form-control">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>

                    @if (request()->anyFilled(['mata_pelajaran_id', 'kelas_id', 'start_date', 'end_date']))
                        <div class="form-control">
                            <a href="{{ route('guru.sesi-absensi.rekap') }}" class="btn btn-ghost">Reset</a>
                        </div>
                    @endif

                    <div class="form-control ms-auto">
                        <a href="{{ route('guru.rekap-absensi.pdf', request()->only(['mata_pelajaran_id', 'kelas_id', 'start_date', 'end_date'])) }}" class="btn btn-sm btn-error">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Export PDF
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="card bg-base-100 shadow-xl border border-success/20">
                <div class="card-body text-center">
                    <div class="text-3xl font-bold text-success">{{ $hadir }}</div>
                    <div class="text-sm text-base-content/60">Total Hadir</div>
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl border border-warning/20">
                <div class="card-body text-center">
                    <div class="text-3xl font-bold text-warning">{{ $terlambat }}</div>
                    <div class="text-sm text-base-content/60">Total Terlambat</div>
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl border border-error/20">
                <div class="card-body text-center">
                    <div class="text-3xl font-bold text-error">{{ $tidakHadir }}</div>
                    <div class="text-sm text-base-content/60">Total Tidak Hadir</div>
                </div>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Pertemuan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Waktu Absen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rekapList as $r)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="font-medium">{{ $r->nama_siswa }}</div>
                                        @if ($r->nis)
                                            <div class="text-xs text-base-content/60">{{ $r->nis }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $r->nama_kelas }}</td>
                                    <td>{{ $r->nama_mapel }}</td>
                                    <td>{{ $r->judul_pertemuan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</td>
                                    <td>
                                        @if ($r->absensi_status === 'hadir')
                                            <span class="badge badge-success">Hadir</span>
                                        @elseif ($r->absensi_status === 'terlambat')
                                            <span class="badge badge-warning">Terlambat</span>
                                        @else
                                            <span class="badge badge-error">Tidak Hadir</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($r->waktu_absen)
                                            {{ \Carbon\Carbon::parse($r->waktu_absen)->format('H:i') }}
                                        @else
                                            <span class="text-base-content/40">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data absensi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $rekapList->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
