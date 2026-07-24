<x-app-layout>
    <x-slot name="header">Edit Siswa</x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <form action="{{ route('admin.siswa.update', $siswa) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">NIS</span>
                    </label>
                    <input type="text" name="nis" class="input input-bordered" value="{{ old('nis', $siswa->nis ?? '') }}" placeholder="Nomor Induk Siswa">
                    @error('nis')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Nama Lengkap</span>
                    </label>
                    <input type="text" name="name" class="input input-bordered" value="{{ old('name', $siswa->name) }}" placeholder="Nama lengkap siswa">
                    @error('name')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" class="input input-bordered" value="{{ old('email', $siswa->email) }}" placeholder="siswa@skalsa.sch.id">
                    @error('email')
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
                            <option value="{{ $kelas->id }}" {{ old('kelas_id', $siswa->kelas_id) == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas_id')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Password <span class="text-base-content/50 text-xs">(kosongkan jika tidak diubah)</span></span>
                    </label>
                    <input type="password" name="password" class="input input-bordered" placeholder="Kosongkan jika tidak diubah">
                    @error('password')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Konfirmasi Password</span>
                    </label>
                    <input type="password" name="password_confirmation" class="input input-bordered" placeholder="Ulangi password">
                </div>

                <div class="flex items-center gap-4 mt-6">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-ghost btn-sm">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
