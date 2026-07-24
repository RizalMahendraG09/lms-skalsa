<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Soal Essay: ') }} {{ $tugas->judul }}
            </h2>
            <a href="{{ route('guru.tugas.soal-essay.create', $tugas) }}" class="btn btn-primary">
                + Tambah Soal
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
                            <th>Pertanyaan</th>
                            <th>Poin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($soalList as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="font-medium">{{ $s->pertanyaan }}</td>
                                <td>{{ $s->poin }}</td>
                                <td>
                                    <div class="flex gap-1">
                                        <a href="{{ route('guru.tugas.soal-essay.edit', [$tugas, $s]) }}" class="btn btn-sm">Edit</a>
                                        <form action="{{ route('guru.tugas.soal-essay.destroy', [$tugas, $s]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada soal essay untuk tugas ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a href="{{ route('guru.tugas.index') }}" class="btn btn-ghost">← Kembali ke daftar tugas</a>
            </div>
        </div>
    </div>
</x-app-layout>
