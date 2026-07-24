<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Tambah Tugas') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <form action="{{ route('guru.tugas.store') }}" method="POST">
                @csrf

                <div class="form-control mb-4">
                    <label class="label" for="mata_pelajaran_id">
                        <span class="label-text">Mata Pelajaran</span>
                    </label>
                    <select id="mata_pelajaran_id" name="mata_pelajaran_id" class="select select-bordered">
                        <option value="">-- Pilih Mapel --</option>
                        @foreach ($mapelList as $mapel)
                            <option value="{{ $mapel->id }}" {{ old('mata_pelajaran_id') == $mapel->id ? 'selected' : '' }}>
                                {{ $mapel->nama_mapel }} ({{ $mapel->kelas->nama_kelas }})
                            </option>
                        @endforeach
                    </select>
                    @error('mata_pelajaran_id')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label class="label" for="judul">
                        <span class="label-text">Judul Tugas</span>
                    </label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" class="input input-bordered" placeholder="Judul tugas">
                    @error('judul')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label class="label" for="deskripsi">
                        <span class="label-text">Deskripsi <span class="text-base-content/50">(opsional)</span></span>
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" class="textarea textarea-bordered" placeholder="Deskripsi tugas">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label class="label" for="deadline">
                        <span class="label-text">Deadline <span class="text-error">*</span></span>
                    </label>
                    <input type="datetime-local" id="deadline" name="deadline" value="{{ old('deadline') }}" class="input input-bordered">
                    @error('deadline')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('guru.tugas.index') }}" class="btn btn-ghost">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
