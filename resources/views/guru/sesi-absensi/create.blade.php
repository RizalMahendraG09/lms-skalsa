<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Tambah Sesi Absensi') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <form action="{{ route('guru.sesi-absensi.store') }}" method="POST">
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
                    <label class="label" for="judul_pertemuan">
                        <span class="label-text">Judul Pertemuan</span>
                    </label>
                    <input type="text" id="judul_pertemuan" name="judul_pertemuan" value="{{ old('judul_pertemuan') }}" class="input input-bordered" placeholder="Contoh: Pertemuan 1">
                    @error('judul_pertemuan')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label class="label" for="tanggal">
                        <span class="label-text">Tanggal</span>
                    </label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" class="input input-bordered">
                    @error('tanggal')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="form-control">
                        <label class="label" for="jam_mulai">
                            <span class="label-text">Jam Mulai</span>
                        </label>
                        <input type="time" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}" class="input input-bordered">
                        @error('jam_mulai')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="jam_selesai">
                            <span class="label-text">Jam Selesai</span>
                        </label>
                        <input type="time" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}" class="input input-bordered">
                        @error('jam_selesai')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-control mb-4">
                    <label class="label" for="status">
                        <span class="label-text">Status</span>
                    </label>
                    <select id="status" name="status" class="select select-bordered">
                        <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('guru.sesi-absensi.index') }}" class="btn btn-ghost">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
