<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Sesi Absensi') }}
            </h2>
            <a href="{{ route('guru.sesi-absensi.create') }}" class="btn btn-primary">
                + Tambah Sesi
            </a>
        </div>
    </x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Judul Pertemuan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sesiAbsensiList as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->mataPelajaran->nama_mapel }}</td>
                                <td class="font-medium">{{ $s->judul_pertemuan }}</td>
                                <td>{{ $s->tanggal->format('d M Y') }}</td>
                                <td>{{ $s->jam_mulai->format('H:i') }} - {{ $s->jam_selesai->format('H:i') }}</td>
                                <td>
                                    @if ($s->status === 'aktif')
                                        <span class="badge badge-success">Aktif</span>
                                    @elseif ($s->status === 'selesai')
                                        <span class="badge badge-ghost">Selesai</span>
                                    @else
                                        <span class="badge badge-ghost">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex gap-1 flex-wrap">
                                        <a href="{{ route('guru.sesi-absensi.edit', $s) }}" class="btn btn-sm">Edit</a>
                                        <form action="{{ route('guru.sesi-absensi.destroy', $s) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus sesi absensi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada sesi absensi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $sesiAbsensiList->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
