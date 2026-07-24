<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Materi Pembelajaran') }}
            </h2>
            <a href="{{ route('guru.materi.create') }}" class="btn btn-primary">
                + Tambah Materi
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
                            <th>Judul</th>
                            <th>Mapel</th>
                            <th>File</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($materiList as $m)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="font-medium">{{ $m->judul }}</td>
                                <td>{{ $m->mataPelajaran->nama_mapel }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $m->file_pdf) }}" target="_blank" class="link link-primary">
                                        Lihat File
                                    </a>
                                </td>
                                <td>{{ $m->created_at->format('d M Y') }}</td>
                                <td class="flex gap-2">
                                    <a href="{{ route('guru.materi.edit', $m) }}" class="btn btn-sm">Edit</a>
                                    <form action="{{ route('guru.materi.destroy', $m) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus materi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada materi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $materiList->links() }}
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('guru.dashboard') }}" class="btn btn-ghost">← Kembali ke Dashboard</a>
    </div>
</x-app-layout>
