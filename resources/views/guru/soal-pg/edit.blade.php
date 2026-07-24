<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Edit Soal PG') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <form action="{{ route('guru.tugas.soal-pg.update', [$tugas, $soalPg]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-control mb-4">
                    <label class="label" for="pertanyaan">
                        <span class="label-text">Pertanyaan <span class="text-error">*</span></span>
                    </label>
                    <textarea id="pertanyaan" name="pertanyaan" rows="3" class="textarea textarea-bordered" placeholder="Masukkan pertanyaan">{{ old('pertanyaan', $soalPg->pertanyaan) }}</textarea>
                    @error('pertanyaan')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="form-control">
                        <label class="label" for="opsi_a">
                            <span class="label-text">Opsi A <span class="text-error">*</span></span>
                        </label>
                        <input type="text" id="opsi_a" name="opsi_a" value="{{ old('opsi_a', $soalPg->opsi_a) }}" class="input input-bordered" placeholder="Opsi A">
                        @error('opsi_a')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="opsi_b">
                            <span class="label-text">Opsi B <span class="text-error">*</span></span>
                        </label>
                        <input type="text" id="opsi_b" name="opsi_b" value="{{ old('opsi_b', $soalPg->opsi_b) }}" class="input input-bordered" placeholder="Opsi B">
                        @error('opsi_b')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="opsi_c">
                            <span class="label-text">Opsi C <span class="text-error">*</span></span>
                        </label>
                        <input type="text" id="opsi_c" name="opsi_c" value="{{ old('opsi_c', $soalPg->opsi_c) }}" class="input input-bordered" placeholder="Opsi C">
                        @error('opsi_c')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="opsi_d">
                            <span class="label-text">Opsi D <span class="text-error">*</span></span>
                        </label>
                        <input type="text" id="opsi_d" name="opsi_d" value="{{ old('opsi_d', $soalPg->opsi_d) }}" class="input input-bordered" placeholder="Opsi D">
                        @error('opsi_d')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="form-control">
                        <label class="label" for="jawaban_benar">
                            <span class="label-text">Jawaban Benar <span class="text-error">*</span></span>
                        </label>
                        <select id="jawaban_benar" name="jawaban_benar" class="select select-bordered">
                            <option value="">-- Pilih --</option>
                            <option value="A" {{ old('jawaban_benar', $soalPg->jawaban_benar) === 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('jawaban_benar', $soalPg->jawaban_benar) === 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ old('jawaban_benar', $soalPg->jawaban_benar) === 'C' ? 'selected' : '' }}>C</option>
                            <option value="D" {{ old('jawaban_benar', $soalPg->jawaban_benar) === 'D' ? 'selected' : '' }}>D</option>
                        </select>
                        @error('jawaban_benar')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="poin">
                            <span class="label-text">Poin <span class="text-error">*</span></span>
                        </label>
                        <input type="number" id="poin" name="poin" value="{{ old('poin', $soalPg->poin) }}" min="1" class="input input-bordered">
                        @error('poin')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('guru.tugas.soal-pg.index', $tugas) }}" class="btn btn-ghost">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
