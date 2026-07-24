<x-app-layout>
    <x-slot name="header">Kerjakan Tugas</x-slot>

    @if (session('success'))
        <div class="alert alert-success mb-6">
            <span>{{ session('success') }}</span>
        </div>
    @endif

            @php
                if (!isset($jawaban)) {
                    $jawaban = \App\Models\JawabanSiswa::where('siswa_id', Auth::id())
                        ->where('tugas_id', $tugas->id)
                        ->first();
                }
            @endphp

            <div class="card bg-base-100 shadow-xl mb-6">
                <div class="card-body">
                    <h3 class="card-title">{{ $tugas->judul }}</h3>
                    <p>{{ $tugas->deskripsi }}</p>
                    <div class="flex flex-wrap gap-4 text-sm mt-2">
                        <span>Mapel: <strong>{{ $tugas->mataPelajaran->nama_mapel }}</strong></span>
                        <span>Guru: <strong>{{ $tugas->guru->name }}</strong></span>
                        <span class="{{ $tugas->deadline->isPast() ? 'text-error' : '' }}">
                            Deadline: <strong>{{ $tugas->deadline->format('d M Y H:i') }}</strong>
                            @if ($tugas->deadline->isPast()) (lewat) @endif
                        </span>
                    </div>
                    @if ($jawaban)
                        <div class="mt-3 flex flex-wrap items-center gap-4">
                            @if ($jawaban->status === 'submitted')
                                <span class="badge badge-warning">Menunggu Dinilai</span>
                                <span class="text-sm">Nilai PG: <strong>{{ $jawaban->nilai_pg ?? '-' }}</strong></span>
                            @elseif ($jawaban->status === 'dinilai')
                                <span class="badge badge-success">Selesai Dinilai</span>
                                <span class="text-sm">Nilai PG: <strong>{{ $jawaban->nilai_pg ?? '-' }}</strong></span>
                                @if ($jawaban->nilai_essay !== null)
                                    <span class="text-sm">Nilai Essay: <strong>{{ $jawaban->nilai_essay }}</strong></span>
                                @endif
                                <span class="text-sm font-semibold">Nilai Akhir: <strong class="text-lg text-success">{{ $jawaban->nilai_akhir }}</strong></span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            @if ($jawaban && $jawaban->status !== 'draft')
                <div class="card bg-base-100 shadow-xl mb-6">
                    <div class="card-body">
                        <h4 class="card-title text-lg">Jawaban Pilihan Ganda</h4>
                        @forelse ($tugas->soalPG as $i => $s)
                            @php $jawab = $jawabanPG[$s->id] ?? null; @endphp
                            <div class="p-4 bg-base-200 rounded-box mb-4">
                                <p class="font-medium mb-2">{{ $i + 1 }}. {{ $s->pertanyaan }}</p>
                                @foreach (['A', 'B', 'C', 'D'] as $opsi)
                                    @php
                                        $isJawabanSiswa = $jawab && $jawab->jawaban_siswa === $opsi;
                                        $isKunci = $s->jawaban_benar === $opsi;
                                    @endphp
                                    <label class="flex items-center gap-2 p-1 text-sm rounded cursor-pointer
                                        {{ $isKunci ? 'bg-success/20' : '' }}
                                        {{ $isJawabanSiswa && !$isKunci ? 'bg-error/20' : '' }}">
                                        <input type="radio" disabled {{ $isJawabanSiswa ? 'checked' : '' }} class="radio radio-sm">
                                        <span class="{{ $isKunci ? 'font-semibold text-success' : '' }}">
                                            {{ $opsi }}. {{ $s->{'opsi_' . strtolower($opsi)} }}
                                            @if ($isKunci) <span class="text-xs text-success">(kunci)</span> @endif
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        @empty
                            <p class="text-sm opacity-60">Tidak ada soal pilihan ganda.</p>
                        @endforelse
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h4 class="card-title text-lg">Jawaban Essay</h4>
                        @forelse ($tugas->soalEssay as $i => $s)
                            @php $jawab = $jawabanEssay[$s->id] ?? null; @endphp
                            <div class="p-4 bg-base-200 rounded-box mb-4">
                                <p class="font-medium mb-2">{{ $i + 1 }}. {{ $s->pertanyaan }}</p>
                                <div class="p-3 bg-base-100 rounded text-sm">
                                    {{ $jawab->jawaban ?? '-' }}
                                </div>
                            </div>
                        @empty
                            <p class="text-sm opacity-60">Tidak ada soal essay.</p>
                        @endforelse
                    </div>
                </div>
            @else
                @if ($tugas->deadline->isPast() && !$jawaban)
                    <div class="card bg-base-100 shadow-xl mb-6">
                        <div class="card-body text-center">
                            <p class="text-error font-medium">Tugas sudah lewat. Tidak dapat dikerjakan.</p>
                        </div>
                    </div>
                @elseif ($tugas->deadline->isPast() && $jawaban)
                    <div class="card bg-base-100 shadow-xl mb-6">
                        <div class="card-body text-center">
                            <p class="text-warning font-medium">Tugas sudah lewat. Jawaban Anda telah tercatat.</p>
                        </div>
                    </div>
                @else
                    <form action="{{ route('siswa.tugas.submit', $tugas) }}" method="POST">
                        @csrf

                        @if ($tugas->soalPG->isNotEmpty())
                            <div class="card bg-base-100 shadow-xl mb-6">
                                <div class="card-body">
                                    <h4 class="card-title text-lg">Pilihan Ganda</h4>
                                    @foreach ($tugas->soalPG as $i => $s)
                                        <div class="p-4 bg-base-200 rounded-box mb-4">
                                            <p class="font-medium mb-2">{{ $i + 1 }}. {{ $s->pertanyaan }} <span class="text-error">*</span></p>
                                            @foreach (['A', 'B', 'C', 'D'] as $opsi)
                                                <label class="flex items-center gap-2 p-1 text-sm hover:bg-base-300 rounded cursor-pointer">
                                                    <input type="radio" name="pg[{{ $s->id }}]" value="{{ $opsi }}"
                                                        {{ old("pg.{$s->id}") === $opsi ? 'checked' : '' }}
                                                        class="radio radio-sm radio-primary">
                                                    <span>{{ $opsi }}. {{ $s->{'opsi_' . strtolower($opsi)} }}</span>
                                                </label>
                                            @endforeach
                                            @error("pg.{$s->id}")
                                                <p class="text-error text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($tugas->soalEssay->isNotEmpty())
                            <div class="card bg-base-100 shadow-xl mb-6">
                                <div class="card-body">
                                    <h4 class="card-title text-lg">Essay</h4>
                                    @foreach ($tugas->soalEssay as $i => $s)
                                        <div class="p-4 bg-base-200 rounded-box mb-4">
                                            <p class="font-medium mb-2">{{ $i + 1 }}. {{ $s->pertanyaan }} <span class="text-error">*</span></p>
                                            <textarea name="essay[{{ $s->id }}]" rows="4"
                                                class="textarea textarea-bordered w-full"
                                                placeholder="Tulis jawaban Anda...">{{ old("essay.{$s->id}") }}</textarea>
                                            @error("essay.{$s->id}")
                                                <p class="text-error text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($tugas->soalPG->isEmpty() && $tugas->soalEssay->isEmpty())
                            <div class="card bg-base-100 shadow-xl mb-6">
                                <div class="card-body text-center opacity-60">
                                    Tugas ini belum memiliki soal.
                                </div>
                            </div>
                        @endif

                        @if ($tugas->soalPG->isNotEmpty() || $tugas->soalEssay->isNotEmpty())
                            <div class="flex items-center gap-4">
                                <button type="submit"
                                    onclick="return confirm('Yakin ingin mengumpulkan tugas? Jawaban tidak dapat diubah setelah dikumpulkan.')"
                                    class="btn btn-primary">
                                    Kumpulkan Tugas
                                </button>
                                <a href="{{ route('siswa.tugas.index') }}" class="btn btn-ghost">Batal</a>
                            </div>
                        @endif
                    </form>
                @endif
            @endif
</x-app-layout>




