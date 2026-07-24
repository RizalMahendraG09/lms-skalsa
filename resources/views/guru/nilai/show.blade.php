<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ $soalEssays->isNotEmpty() ? __('Nilai Essay: ') : __('Detail Jawaban: ') }} {{ $jawabanSiswa->siswa->name }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="mb-6 p-4 bg-base-200 rounded-lg">
                <p class="text-sm">Tugas: <strong>{{ $tugas->judul }}</strong></p>
                <p class="text-sm">Siswa: <strong>{{ $jawabanSiswa->siswa->name }}</strong></p>
                <p class="text-sm">Nilai PG: <strong>{{ $jawabanSiswa->nilai_pg ?? '-' }}</strong></p>
                @if ($jawabanSiswa->nilai_essay !== null)
                    <p class="text-sm text-success">Nilai Essay: <strong>{{ $jawabanSiswa->nilai_essay }}</strong></p>
                @endif
                @if ($jawabanSiswa->status === 'dinilai')
                    <p class="text-sm font-semibold">Nilai Akhir: <strong class="text-success">{{ $jawabanSiswa->nilai_akhir }}</strong></p>
                @endif
            </div>

            @if ($soalPG->isNotEmpty())
                <div class="mb-6">
                    <h4 class="card-title text-lg mb-4">Jawaban Pilihan Ganda</h4>
                    @foreach ($soalPG as $i => $s)
                        @php $jawab = $jawabanPG->get($s->id); @endphp
                        <div class="p-4 border border-base-300 rounded-lg mb-4">
                            <p class="font-medium mb-2">{{ $i + 1 }}. {{ $s->pertanyaan }}</p>
                            <p class="text-xs text-base-content/50 mb-2">Poin: {{ $s->poin }}</p>
                            @foreach (['A', 'B', 'C', 'D'] as $opsi)
                                @php
                                    $isJawabanSiswa = $jawab && $jawab->jawaban_siswa === $opsi;
                                    $isKunci = $s->jawaban_benar === $opsi;
                                @endphp
                                <div class="flex items-center gap-2 p-1 text-sm rounded
                                    {{ $isKunci ? 'bg-success/20' : '' }}
                                    {{ $isJawabanSiswa && !$isKunci ? 'bg-error/20' : '' }}">
                                    <input type="radio" disabled {{ $isJawabanSiswa ? 'checked' : '' }} class="radio radio-sm">
                                    <span class="{{ $isKunci ? 'font-semibold text-success' : '' }}">
                                        {{ $opsi }}. {{ $s->{'opsi_' . strtolower($opsi)} }}
                                        @if ($isKunci) <span class="text-xs text-success">(kunci)</span> @endif
                                        @if ($isJawabanSiswa) <span class="text-xs">(jawaban siswa)</span> @endif
                                    </span>
                                </div>
                            @endforeach
                            @if ($jawab)
                                <p class="text-xs mt-1 {{ $jawab->benar ? 'text-success' : 'text-error' }}">
                                    {{ $jawab->benar ? 'Benar (+' . $s->poin . ' poin)' : 'Salah (0 poin)' }}
                                </p>
                            @else
                                <p class="text-xs text-warning mt-1">Tidak dijawab</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            @if ($soalEssays->isNotEmpty())
                <form action="{{ route('guru.tugas.nilai.store', [$tugas, $jawabanSiswa]) }}" method="POST">
                    @csrf

                    <h4 class="card-title text-lg mb-4">Penilaian Essay</h4>

                    @forelse ($soalEssays as $soal)
                        @php
                            $jawab = $jawabanEssays->get($soal->id);
                            $existing = $jawab?->nilaiEssayDetail;
                        @endphp
                        <div class="mb-6 p-4 border border-base-300 rounded-lg">
                            <div class="mb-3">
                                <p class="font-medium">Soal {{ $loop->iteration }}</p>
                                <p class="mt-1 whitespace-pre-wrap">{{ $soal->pertanyaan }}</p>
                                <p class="mt-1 text-xs text-base-content/50">Poin maksimal: {{ $soal->poin }}</p>
                            </div>

                            @if ($jawab)
                                <div class="mb-3 p-3 bg-base-200 rounded">
                                    <p class="text-sm font-medium">Jawaban siswa:</p>
                                    <p class="mt-1 whitespace-pre-wrap">{{ $jawab->jawaban }}</p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="form-control">
                                        <label class="label" for="nilai_{{ $soal->id }}">
                                            <span class="label-text">Nilai</span>
                                        </label>
                                        <input type="number" name="nilai_{{ $soal->id }}" id="nilai_{{ $soal->id }}"
                                            value="{{ old('nilai_' . $soal->id, $existing?->nilai) }}"
                                            min="0" max="{{ $soal->poin }}" class="input input-bordered">
                                        @error("nilai_{$soal->id}")
                                            <span class="text-error text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-control">
                                        <label class="label" for="catatan_{{ $soal->id }}">
                                            <span class="label-text">Catatan</span>
                                        </label>
                                        <textarea name="catatan_{{ $soal->id }}" id="catatan_{{ $soal->id }}" rows="2" class="textarea textarea-bordered">{{ old('catatan_' . $soal->id, $existing?->catatan) }}</textarea>
                                        @error("catatan_{$soal->id}")
                                            <span class="text-error text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                <p class="text-sm text-warning">Siswa tidak menjawab soal ini.</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-base-content/50">Tidak ada soal essay.</p>
                    @endforelse

                    @if ($soalEssays->isNotEmpty())
                        <div class="flex items-center gap-4">
                            <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                            <a href="{{ route('guru.tugas.nilai', $tugas) }}" class="btn btn-ghost">← Kembali</a>
                        </div>
                    @endif
                </form>
            @elseif ($soalPG->isNotEmpty() && $jawabanSiswa->status !== 'dinilai')
                <div class="flex items-center gap-4 mt-4">
                    <form action="{{ route('guru.tugas.nilai.finalize', [$tugas, $jawabanSiswa]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirm('Konfirmasi nilai akhir={{ $jawabanSiswa->nilai_pg ?? 0 }} untuk siswa ini?')">
                            Konfirmasi Nilai Akhir
                        </button>
                    </form>
                    <a href="{{ route('guru.tugas.nilai', $tugas) }}" class="btn btn-ghost">← Kembali</a>
                </div>
            @else
                <div class="mt-4">
                    <a href="{{ route('guru.tugas.nilai', $tugas) }}" class="btn btn-ghost">← Kembali</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
