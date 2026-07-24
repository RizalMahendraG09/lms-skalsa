<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Tugas') }}
            </h2>
            <a href="{{ route('guru.tugas.create') }}" class="btn btn-primary">
                + Tambah Tugas
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

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
                                <td>{{ $t->deadline->format('d M Y H:i') }}</td>
                                <td>
                                    @if ($t->deadline->isPast())
                                        <span class="badge badge-error">Lewat</span>
                                    @else
                                        <span class="badge badge-success">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex gap-1 flex-wrap">
                                        <a href="{{ route('guru.tugas.soal-pg.index', $t) }}" class="btn btn-sm">PG</a>
                                        <a href="{{ route('guru.tugas.soal-essay.index', $t) }}" class="btn btn-sm">Essay</a>
                                        <a href="{{ route('guru.tugas.nilai', $t) }}" class="btn btn-sm">Nilai</a>
                                        <a href="{{ route('guru.tugas.edit', $t) }}" class="btn btn-sm">Edit</a>
                                        <form action="{{ route('guru.tugas.destroy', $t) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada tugas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $tugasList->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
