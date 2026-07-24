<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Hasil Tugas: ') }} {{ $tugas->judul }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th>Nilai PG</th>
                            <th>Nilai Essay</th>
                            <th>Nilai Akhir</th>
                            <th>Status</th>
                            <th>Aksi</th>
                            <th>Dikumpulkan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswaList as $s)
                            @php $jwb = $s->jawabanSiswa->first(); @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="font-medium">{{ $s->name }}</td>
                                @if ($jwb)
                                    <td>{{ $jwb->nilai_pg ?? '-' }}</td>
                                    <td>{{ $jwb->nilai_essay ?? '-' }}</td>
                                    <td>{{ $jwb->nilai_akhir ?? '-' }}</td>
                                    <td>
                                        @if ($jwb->status === 'submitted')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif ($jwb->status === 'dinilai')
                                            <span class="badge badge-success">Dinilai</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($tugas->soalEssay->isNotEmpty())
                                            <a href="{{ route('guru.tugas.nilai.show', [$tugas, $jwb]) }}" class="btn btn-sm">Nilai Essay</a>
                                        @elseif ($jwb->status === 'submitted')
                                            <form action="{{ route('guru.tugas.nilai.finalize', [$tugas, $jwb]) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary"
                                                    onclick="return confirm('Konfirmasi nilai akhir untuk siswa ini?')">
                                                    Konfirmasi Nilai
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('guru.tugas.nilai.show', [$tugas, $jwb]) }}" class="btn btn-sm btn-ghost">Lihat</a>
                                        @endif
                                    </td>
                                    <td>{{ $jwb->submitted_at ? $jwb->submitted_at->format('d M Y H:i') : '-' }}</td>
                                @else
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td><span class="badge badge-ghost">Belum mengumpulkan</span></td>
                                    <td>-</td>
                                    <td>-</td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada siswa di kelas ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a href="{{ route('guru.rekap-nilai.index') }}" class="btn btn-ghost">← Kembali ke rekap nilai</a>
            </div>
        </div>
    </div>
</x-app-layout>
