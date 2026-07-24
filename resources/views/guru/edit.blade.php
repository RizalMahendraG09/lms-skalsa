<x-app-layout>
    <x-slot name="header">Edit Guru</x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <form action="{{ route('admin.guru.update', $guru) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">NIP</span>
                    </label>
                    <input type="text" name="nip" class="input input-bordered" value="{{ old('nip', $guru->nip ?? '') }}" placeholder="Nomor Induk Pegawai">
                    @error('nip')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Nama Lengkap</span>
                    </label>
                    <input type="text" name="name" class="input input-bordered" value="{{ old('name', $guru->name) }}" placeholder="Nama lengkap guru">
                    @error('name')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" class="input input-bordered" value="{{ old('email', $guru->email) }}" placeholder="guru@skalsa.sch.id">
                    @error('email')
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
                    <a href="{{ route('admin.guru.index') }}" class="btn btn-ghost btn-sm">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
