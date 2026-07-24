<x-app-layout>
    <x-slot name="header">Data Mata Pelajaran</x-slot>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.mata-pelajaran.create') }}" class="btn btn-primary">+ Tambah Mapel</a>
    </div>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body p-0">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mapel</th>
                        <th>Guru Pengampu</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mapelList as $m)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="font-medium">{{ $m->nama_mapel }}</td>
                            <td>{{ $m->guru->name }}</td>
                            <td>{{ $m->kelas->nama_kelas }}</td>
                            <td class="flex gap-2">
                                <a href="{{ route('admin.mata-pelajaran.edit', $m) }}" class="btn btn-ghost btn-sm">Edit</a>
                                <form action="{{ route('admin.mata-pelajaran.destroy', $m) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data mata pelajaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $mapelList->links() }}
    </div>
</x-app-layout>
