<x-app-layout>
    <x-slot name="header">Semua Materi</x-slot>

    <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Mapel</th>
                                    <th>Guru</th>
                                    <th>Tanggal</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($materiList as $m)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="font-medium">{{ $m->judul }}</td>
                                        <td>{{ $m->mataPelajaran->nama_mapel }}</td>
                                        <td>{{ $m->guru->name }}</td>
                                        <td>{{ $m->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ asset('storage/' . $m->file_pdf) }}" target="_blank" class="btn btn-primary btn-sm">
                                                Download
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            Belum ada materi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $materiList->links() }}
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">Kembali</a>
                    </div>
                </div>
            </div>
    </div>
</x-app-layout>
