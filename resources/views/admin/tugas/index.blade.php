<x-app-layout>
    <x-slot name="header">Semua Tugas</x-slot>

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
                                    <th>Deadline</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tugasList as $t)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="font-medium">{{ $t->judul }}</td>
                                        <td>{{ $t->mataPelajaran->nama_mapel }}</td>
                                        <td>{{ $t->guru->name }}</td>
                                        <td class="{{ $t->deadline->isPast() ? 'text-error font-medium' : '' }}">
                                            {{ $t->deadline->format('d M Y H:i') }}
                                        </td>
                                        <td>
                                            @if ($t->deadline->isPast())
                                                <span class="badge badge-error">Lewat</span>
                                            @else
                                                <span class="badge badge-success">Aktif</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            Belum ada tugas.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $tugasList->links() }}
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">Kembali</a>
                    </div>
                </div>
            </div>
    </div>
</x-app-layout>
