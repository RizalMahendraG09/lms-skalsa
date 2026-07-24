<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Soal PG: ') }} {{ $tugas->judul }}
            </h2>
            <a href="{{ route('guru.tugas.soal-pg.create', $tugas) }}" class="btn btn-primary">
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
                            <th>Pilihan</th>
                            <th>Jawaban Benar</th>
                            <th>Poin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($soalList as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="font-medium max-w-xs">{{ $s->pertanyaan }}</td>
                                <td class="text-sm space-y-1">
                                    <span class="block {{ $s->jawaban_benar === 'A' ? 'font-semibold text-success' : '' }}">A. {{ $s->opsi_a }}</span>
                                    <span class="block {{ $s->jawaban_benar === 'B' ? 'font-semibold text-success' : '' }}">B. {{ $s->opsi_b }}</span>
                                    <span class="block {{ $s->jawaban_benar === 'C' ? 'font-semibold text-success' : '' }}">C. {{ $s->opsi_c }}</span>
                                    <span class="block {{ $s->jawaban_benar === 'D' ? 'font-semibold text-success' : '' }}">D. {{ $s->opsi_d }}</span>
                                </td>
                                <td class="font-semibold text-success">{{ $s->jawaban_benar }}</td>
                                <td>{{ $s->poin }}</td>
                                <td>
                                    <div class="flex gap-1">
                                        <a href="{{ route('guru.tugas.soal-pg.edit', [$tugas, $s]) }}" class="btn btn-sm">Edit</a>
                                        <form action="{{ route('guru.tugas.soal-pg.destroy', [$tugas, $s]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada soal untuk tugas ini.</td>
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
