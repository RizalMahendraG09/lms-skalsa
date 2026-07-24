@php
    $title = 'Buat Profil Sekolah';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Buat Profil Sekolah') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <form action="{{ route('admin.profil-sekolah.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="form-control">
                        <label class="label"><span class="label-text">Nama Sekolah</span></label>
                        <input type="text" name="nama_sekolah" class="input input-bordered @error('nama_sekolah') input-error @enderror" value="{{ old('nama_sekolah') }}" required>
                        @error('nama_sekolah') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Email</span></label>
                            <input type="email" name="email" class="input input-bordered @error('email') input-error @enderror" value="{{ old('email') }}" required>
                            @error('email') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Telepon</span></label>
                            <input type="text" name="telepon" class="input input-bordered @error('telepon') input-error @enderror" value="{{ old('telepon') }}" required>
                            @error('telepon') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Alamat</span></label>
                        <textarea name="alamat" class="textarea textarea-bordered @error('alamat') textarea-error @enderror" rows="3" required>{{ old('alamat') }}</textarea>
                        @error('alamat') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Website</span></label>
                        <input type="url" name="website" class="input input-bordered @error('website') input-error @enderror" value="{{ old('website') }}">
                        @error('website') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Logo</span></label>
                        <input type="file" name="logo" accept="image/jpg,image/jpeg,image/png" class="file-input file-input-bordered @error('logo') file-input-error @enderror">
                        <p class="text-xs text-base-content/60 mt-1">Format: JPG/JPEG/PNG. Maks: 2MB</p>
                        @error('logo') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Visi (setiap baris adalah satu poin)</span></label>
                        <textarea name="visi" class="textarea textarea-bordered @error('visi') textarea-error @enderror" rows="4" required>{{ old('visi') }}</textarea>
                        @error('visi') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Misi (setiap baris adalah satu poin)</span></label>
                        <textarea name="misi" class="textarea textarea-bordered @error('misi') textarea-error @enderror" rows="6" required>{{ old('misi') }}</textarea>
                        @error('misi') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Sejarah Sekolah</span></label>
                        <textarea name="sejarah" class="textarea textarea-bordered @error('sejarah') textarea-error @enderror" rows="6" required>{{ old('sejarah') }}</textarea>
                        @error('sejarah') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Nama Kepala Sekolah</span></label>
                            <input type="text" name="kepala_sekolah" class="input input-bordered @error('kepala_sekolah') input-error @enderror" value="{{ old('kepala_sekolah') }}" required>
                            @error('kepala_sekolah') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Foto Kepala Sekolah</span></label>
                            <input type="file" name="foto_kepala_sekolah" accept="image/jpg,image/jpeg,image/png" class="file-input file-input-bordered @error('foto_kepala_sekolah') file-input-error @enderror">
                            <p class="text-xs text-base-content/60 mt-1">Format: JPG/JPEG/PNG. Maks: 2MB</p>
                            @error('foto_kepala_sekolah') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.profil-sekolah.index') }}" class="btn btn-ghost">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
