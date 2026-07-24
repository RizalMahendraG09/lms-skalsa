<x-app-layout>
    <x-slot name="header">Rekap Absensi</x-slot>

    <div class="space-y-4">
        {{-- Statistik --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body text-center">
                    <div class="text-3xl font-bold text-primary">{{ $persentase }}%</div>
                    <div class="text-sm text-base-content/60">Kehadiran</div>
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl border border-success/20">
                <div class="card-body text-center">
                    <div class="text-3xl font-bold text-success">{{ $hadir }}</div>
                    <div class="text-sm text-base-content/60">Hadir</div>
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl border border-warning/20">
                <div class="card-body text-center">
                    <div class="text-3xl font-bold text-warning">{{ $terlambat }}</div>
                    <div class="text-sm text-base-content/60">Terlambat</div>
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl border border-error/20">
                <div class="card-body text-center">
                    <div class="text-3xl font-bold text-error">{{ $tidakHadir }}</div>
                    <div class="text-sm text-base-content/60">Tidak Hadir</div>
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
                                    <td>{{ $r->nama_mapel }}</td>
                                    <td class="font-medium">{{ $r->judul_pertemuan }}</td>
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
                                    <td colspan="6" class="text-center">Belum ada data absensi.</td>
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
