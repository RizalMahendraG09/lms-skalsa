<x-app-layout>
    <x-slot name="header">Absensi</x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mapel</th>
                            <th>Pertemuan</th>
                            <th>Guru</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sesiList as $s)
                            @php
                                $sudahAbsen = $s->absensiSiswa->isNotEmpty();
                                $tanggal = $s->tanggal->format('Y-m-d');
                                $mulai = \Carbon\Carbon::parse($tanggal . ' ' . $s->jam_mulai->format('H:i'));
                                $selesai = \Carbon\Carbon::parse($tanggal . ' ' . $s->jam_selesai->format('H:i'));
                                $now = \Carbon\Carbon::now();
                                $bisaAbsen = !$sudahAbsen && $now->between($mulai, $selesai);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->mataPelajaran->nama_mapel }}</td>
                                <td class="font-medium">{{ $s->judul_pertemuan }}</td>
                                <td>{{ $s->guru->name }}</td>
                                <td>
                                    {{ $s->tanggal->format('d M Y') }}
                                    <br>
                                    <span class="text-sm text-base-content/60">
                                        {{ $s->jam_mulai->format('H:i') }} - {{ $s->jam_selesai->format('H:i') }}
                                    </span>
                                </td>
                                <td>
                                    @if ($sudahAbsen)
                                        @php $abs = $s->absensiSiswa->first(); @endphp
                                        @if ($abs->status === 'hadir')
                                            <span class="badge badge-success">Hadir</span>
                                        @elseif ($abs->status === 'terlambat')
                                            <span class="badge badge-warning">Terlambat</span>
                                        @else
                                            <span class="badge badge-error">Tidak Hadir</span>
                                        @endif
                                    @else
                                        <span class="badge badge-ghost">Belum Absen</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($bisaAbsen)
                                        <form action="{{ route('siswa.absensi.store') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="pertemuan_id" value="{{ $s->id }}">
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                onclick="return confirm('Hadirkan diri Anda pada sesi ini?')">
                                                Hadir
                                            </button>
                                        </form>
                                    @elseif (!$sudahAbsen)
                                        <span class="text-sm text-base-content/40">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Tidak ada sesi absensi aktif untuk kelas Anda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a href="{{ route('siswa.dashboard') }}" class="btn btn-ghost">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
