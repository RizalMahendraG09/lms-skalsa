<x-app-layout>
    <x-slot name="header">Tambah Guru</x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <form action="{{ route('admin.guru.store') }}" method="POST">
                @csrf

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">NIP</span>
                    </label>
                    <input type="text" name="nip" class="input input-bordered" value="{{ old('nip') }}" placeholder="Nomor Induk Pegawai">
                    @error('nip')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Nama Lengkap</span>
                    </label>
                    <input type="text" name="name" class="input input-bordered" value="{{ old('name') }}" placeholder="Nama lengkap guru">
                    @error('name')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" class="input input-bordered" value="{{ old('email') }}" placeholder="guru@skalsa.sch.id">
                    @error('email')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" class="input input-bordered" placeholder="Minimal 8 karakter">
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.guru.index') }}" class="btn btn-ghost btn-sm">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
