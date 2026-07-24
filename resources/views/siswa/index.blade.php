<x-app-layout>
    <x-slot name="header">Data Siswa</x-slot>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary">+ Tambah Siswa</a>
    </div>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body p-0">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswaList as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->nis ?? '-' }}</td>
                            <td class="font-medium">{{ $s->name }}</td>
                            <td>{{ $s->email }}</td>
                            <td>{{ $s->kelas?->nama_kelas ?? '-' }}</td>
                            <td class="flex gap-2">
                                <a href="{{ route('admin.siswa.edit', $s) }}" class="btn btn-ghost btn-sm">Edit</a>
                                <form action="{{ route('admin.siswa.destroy', $s) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $siswaList->links() }}
    </div>
</x-app-layout>
