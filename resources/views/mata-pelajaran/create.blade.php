<x-app-layout>
    <x-slot name="header">Tambah Mata Pelajaran</x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <form action="{{ route('admin.mata-pelajaran.store') }}" method="POST">
                @csrf

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nama Mata Pelajaran</span>
                    </label>
                    <input type="text" name="nama_mapel" class="input input-bordered" value="{{ old('nama_mapel') }}" placeholder="Contoh: Matematika">
                    @error('nama_mapel')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Guru Pengajar</span>
                    </label>
                    <select name="guru_id" class="select select-bordered">
                        <option value="">-- Pilih Guru --</option>
                        @foreach ($guruList as $guru)
                            <option value="{{ $guru->id }}" {{ old('guru_id') == $guru->id ? 'selected' : '' }}>
                                {{ $guru->name }} ({{ $guru->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('guru_id')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Kelas</span>
                    </label>
                    <select name="kelas_id" class="select select-bordered">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelasList as $kelas)
                            <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas_id')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center gap-4 mt-6">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.mata-pelajaran.index') }}" class="btn btn-ghost btn-sm">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
