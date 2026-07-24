<x-app-layout>
    <x-slot name="header">Rekap Nilai</x-slot>

    <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Tugas</th>
                                    <th>Nilai PG</th>
                                    <th>Nilai Essay</th>
                                    <th>Nilai Akhir</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($nilaiList as $n)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $n->tugas->mataPelajaran->nama_mapel ?? '-' }}</td>
                                        <td class="font-medium">{{ $n->tugas->judul }}</td>
                                        <td>{{ $n->nilai_pg ?? '-' }}</td>
                                        <td>{{ $n->nilai_essay ?? '-' }}</td>
                                        <td>
                                            @if ($n->status === 'dinilai')
                                                <strong class="text-success">{{ $n->nilai_akhir }}</strong>
                                            @else
                                                <span class="opacity-50">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($n->status === 'dinilai')
                                                <span class="badge badge-success">Dinilai</span>
                                            @elseif ($n->status === 'submitted')
                                                <span class="badge badge-warning">Menunggu</span>
                                            @else
                                                <span class="badge badge-info">Draft</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('siswa.tugas.kerjakan', $n->tugas) }}" class="btn btn-sm btn-ghost">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            Belum ada nilai atau tugas yang dikerjakan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $nilaiList->links() }}
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('siswa.dashboard') }}" class="btn btn-ghost">Kembali</a>
                    </div>
                </div>
            </div>
    </div>
</x-app-layout>
