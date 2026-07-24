@php
    $title = 'Edit Staff';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Edit Staff') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <form action="{{ route('admin.staff.update', $staff) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="form-control">
                        <label class="label"><span class="label-text">Nama</span></label>
                        <input type="text" name="nama" class="input input-bordered @error('nama') input-error @enderror" value="{{ old('nama', $staff->nama) }}" required>
                        @error('nama') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Jabatan</span></label>
                        <select name="jabatan" class="select select-bordered @error('jabatan') select-error @enderror" required>
                            <option value="">Pilih Jabatan</option>
                            <option value="Wakil Kepala Sekolah" @selected(old('jabatan', $staff->jabatan) === 'Wakil Kepala Sekolah')>Wakil Kepala Sekolah</option>
                            <option value="Tata Usaha" @selected(old('jabatan', $staff->jabatan) === 'Tata Usaha')>Tata Usaha</option>
                            <option value="Staff Administrasi" @selected(old('jabatan', $staff->jabatan) === 'Staff Administrasi')>Staff Administrasi</option>
                            <option value="Laboran" @selected(old('jabatan', $staff->jabatan) === 'Laboran')>Laboran</option>
                            <option value="Pustakawan" @selected(old('jabatan', $staff->jabatan) === 'Pustakawan')>Pustakawan</option>
                            <option value="Operator Sekolah" @selected(old('jabatan', $staff->jabatan) === 'Operator Sekolah')>Operator Sekolah</option>
                            <option value="Lainnya" @selected(old('jabatan', $staff->jabatan) === 'Lainnya')>Lainnya</option>
                        </select>
                        @error('jabatan') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Foto</span></label>
                        @if($staff->foto_url)
                            <div class="mb-2">
                                <img src="{{ $staff->foto_url }}" alt="{{ $staff->nama }}" class="w-20 h-20 object-cover rounded-full bg-base-200">
                                <p class="text-xs text-base-content/60 mt-1">Foto saat ini. Upload baru untuk mengganti.</p>
                            </div>
                        @endif
                        <input type="file" name="foto" accept="image/jpg,image/jpeg,image/png" class="file-input file-input-bordered @error('foto') file-input-error @enderror">
                        <p class="text-xs text-base-content/60 mt-1">Format: JPG/JPEG/PNG. Maks: 2MB</p>
                        @error('foto') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Email</span></label>
                            <input type="email" name="email" class="input input-bordered @error('email') input-error @enderror" value="{{ old('email', $staff->email) }}">
                            @error('email') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Telepon</span></label>
                            <input type="text" name="telepon" class="input input-bordered @error('telepon') input-error @enderror" value="{{ old('telepon', $staff->telepon) }}">
                            @error('telepon') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Urutan Tampilan</span></label>
                            <input type="number" name="urutan" class="input input-bordered @error('urutan') input-error @enderror" value="{{ old('urutan', $staff->urutan) }}" min="0" required>
                            @error('urutan') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Status Aktif</span></label>
                            <select name="status_aktif" class="select select-bordered @error('status_aktif') select-error @enderror" required>
                                <option value="aktif" @selected(old('status_aktif', $staff->status_aktif) === 'aktif')>Aktif</option>
                                <option value="nonaktif" @selected(old('status_aktif', $staff->status_aktif) === 'nonaktif')>Nonaktif</option>
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
