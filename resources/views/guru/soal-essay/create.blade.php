<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Tambah Soal Essay') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <form action="{{ route('guru.tugas.soal-essay.store', $tugas) }}" method="POST">
                @csrf

                <div class="form-control mb-4">
                    <label class="label" for="pertanyaan">
                        <span class="label-text">Pertanyaan <span class="text-error">*</span></span>
                    </label>
                    <textarea id="pertanyaan" name="pertanyaan" rows="4" class="textarea textarea-bordered" placeholder="Masukkan pertanyaan">{{ old('pertanyaan') }}</textarea>
                    @error('pertanyaan')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label class="label" for="poin">
                        <span class="label-text">Poin <span class="text-error">*</span></span>
                    </label>
                    <input type="number" id="poin" name="poin" value="{{ old('poin', 1) }}" min="1" class="input input-bordered">
                    @error('poin')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('guru.tugas.soal-essay.index', $tugas) }}" class="btn btn-ghost">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
