<x-app-layout>
    <x-slot name="header">Tugas</x-slot>

    <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Mapel</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tugasList as $t)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="font-medium">{{ $t->judul }}</td>
                                        <td>{{ $t->mataPelajaran->nama_mapel }}</td>
                                        <td>
                                            <span class="{{ $t->deadline->isPast() ? 'text-error font-medium' : '' }}">
                                                {{ $t->deadline->format('d M Y H:i') }}
                                            </span>
                                        </td>
                                        <td>
                                            @php $jwb = $t->jawabanSiswa->first(); @endphp
                                            @if (!$jwb && $t->deadline->isPast())
                                                <span class="badge badge-error">Lewat</span>
                                            @elseif ($jwb && $jwb->status === 'dinilai')
                                                <span class="badge badge-success">Dinilai</span>
                                            @elseif ($jwb && $jwb->status === 'submitted')
                                                <span class="badge badge-warning">Menunggu</span>
                                            @elseif ($jwb)
                                                <span class="badge badge-info">Draft</span>
                                            @else
                                                <span class="badge badge-ghost">Belum</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($jwb && $jwb->status === 'dinilai')
                                                <a href="{{ route('siswa.tugas.kerjakan', $t) }}" class="btn btn-sm btn-success">Lihat Nilai</a>
                                            @elseif ($jwb)
                                                <a href="{{ route('siswa.tugas.kerjakan', $t) }}" class="btn btn-sm btn-ghost">Lihat</a>
                                            @elseif ($t->deadline->isPast())
                                                <span class="text-sm text-error">Tidak bisa dikerjakan</span>
                                            @else
                                                <a href="{{ route('siswa.tugas.kerjakan', $t) }}" class="btn btn-sm btn-primary">Kerjakan</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            Belum ada tugas untuk kelas Anda.
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
    </div>
</x-app-layout>
