<x-app-layout>
    <x-slot name="header">Data Kelas</x-slot>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary">+ Tambah Kelas</a>
    </div>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body p-0">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kelasList as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="font-medium">{{ $k->nama_kelas }}</td>
                            <td class="flex gap-2">
                                <a href="{{ route('admin.kelas.edit', $k) }}" class="btn btn-ghost btn-sm">Edit</a>
                                <form action="{{ route('admin.kelas.destroy', $k) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada data kelas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $kelasList->links() }}
    </div>
</x-app-layout>
