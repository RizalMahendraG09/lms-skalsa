<x-app-layout>
    <x-slot name="header">Data Guru</x-slot>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.guru.create') }}" class="btn btn-primary">+ Tambah Guru</a>
    </div>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body p-0">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($guruList as $g)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $g->nip ?? '-' }}</td>
                            <td class="font-medium">{{ $g->name }}</td>
                            <td>{{ $g->email }}</td>
                            <td class="flex gap-2">
                                <a href="{{ route('admin.guru.edit', $g) }}" class="btn btn-ghost btn-sm">Edit</a>
                                <form action="{{ route('admin.guru.destroy', $g) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus guru ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data guru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $guruList->links() }}
    </div>
</x-app-layout>
