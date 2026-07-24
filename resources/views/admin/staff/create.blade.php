@php
    $title = 'Tambah Staff';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Tambah Staff') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="form-control">
                        <label class="label"><span class="label-text">Nama</span></label>
                        <input type="text" name="nama" class="input input-bordered @error('nama') input-error @enderror" value="{{ old('nama') }}" required>
                        @error('nama') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Jabatan</span></label>
                        <select name="jabatan" class="select select-bordered @error('jabatan') select-error @enderror" required>
                            <option value="">Pilih Jabatan</option>
                            <option value="Wakil Kepala Sekolah" @selected(old('jabatan') === 'Wakil Kepala Sekolah')>Wakil Kepala Sekolah</option>
                            <option value="Tata Usaha" @selected(old('jabatan') === 'Tata Usaha')>Tata Usaha</option>
                            <option value="Staff Administrasi" @selected(old('jabatan') === 'Staff Administrasi')>Staff Administrasi</option>
                            <option value="Laboran" @selected(old('jabatan') === 'Laboran')>Laboran</option>
                            <option value="Pustakawan" @selected(old('jabatan') === 'Pustakawan')>Pustakawan</option>
                            <option value="Operator Sekolah" @selected(old('jabatan') === 'Operator Sekolah')>Operator Sekolah</option>
                            <option value="Lainnya" @selected(old('jabatan') === 'Lainnya')>Lainnya</option>
                        </select>
                        @error('jabatan') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Foto</span></label>
                        <input type="file" name="foto" accept="image/jpg,image/jpeg,image/png" class="file-input file-input-bordered @error('foto') file-input-error @enderror">
                        <p class="text-xs text-base-content/60 mt-1">Format: JPG/JPEG/PNG. Maks: 2MB</p>
                        @error('foto') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Email</span></label>
                            <input type="email" name="email" class="input input-bordered @error('email') input-error @enderror" value="{{ old('email') }}">
                            @error('email') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Telepon</span></label>
                            <input type="text" name="telepon" class="input input-bordered @error('telepon') input-error @enderror" value="{{ old('telepon') }}">
                            @error('telepon') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Urutan Tampilan</span></label>
                            <input type="number" name="urutan" class="input input-bordered @error('urutan') input-error @enderror" value="{{ old('urutan', 0) }}" min="0" required>
                            @error('urutan') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Status Aktif</span></label>
                            <select name="status_aktif" class="select select-bordered @error('status_aktif') select-error @enderror" required>
                                <option value="aktif" @selected(old('status_aktif', 'aktif') === 'aktif')>Aktif</option>
                                <option value="nonaktif" @selected(old('status_aktif') === 'nonaktif')>Nonaktif</option>
                            </select>
                            @error('status_aktif') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.staff.index') }}" class="btn btn-ghost">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
