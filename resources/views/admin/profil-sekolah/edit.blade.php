@php
    $title = 'Edit Profil Sekolah';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Edit Profil Sekolah') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <form action="{{ route('admin.profil-sekolah.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="form-control">
                        <label class="label"><span class="label-text">Nama Sekolah</span></label>
                        <input type="text" name="nama_sekolah" class="input input-bordered @error('nama_sekolah') input-error @enderror" value="{{ old('nama_sekolah', $profil->nama_sekolah) }}" required>
                        @error('nama_sekolah') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Email</span></label>
                            <input type="email" name="email" class="input input-bordered @error('email') input-error @enderror" value="{{ old('email', $profil->email) }}" required>
                            @error('email') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Telepon</span></label>
                            <input type="text" name="telepon" class="input input-bordered @error('telepon') input-error @enderror" value="{{ old('telepon', $profil->telepon) }}" required>
                            @error('telepon') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Alamat</span></label>
                        <textarea name="alamat" class="textarea textarea-bordered @error('alamat') textarea-error @enderror" rows="3" required>{{ old('alamat', $profil->alamat) }}</textarea>
                        @error('alamat') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Website</span></label>
                        <input type="url" name="website" class="input input-bordered @error('website') input-error @enderror" value="{{ old('website', $profil->website) }}">
                        @error('website') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Logo</span></label>
                        @if($profil->logo_url)
                            <div class="mb-2">
                                <img src="{{ $profil->logo_url }}" alt="Logo" class="w-20 h-20 object-contain rounded-lg bg-base-200 p-1">
                                <p class="text-xs text-base-content/60 mt-1">Logo saat ini. Upload baru untuk mengganti.</p>
                            </div>
                        @endif
                        <input type="file" name="logo" accept="image/jpg,image/jpeg,image/png" class="file-input file-input-bordered @error('logo') file-input-error @enderror">
                        <p class="text-xs text-base-content/60 mt-1">Format: JPG/JPEG/PNG. Maks: 2MB</p>
                        @error('logo') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Visi (setiap baris adalah satu poin)</span></label>
                        <textarea name="visi" class="textarea textarea-bordered @error('visi') textarea-error @enderror" rows="4" required>{{ old('visi', $profil->visi) }}</textarea>
                        @error('visi') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Misi (setiap baris adalah satu poin)</span></label>
                        <textarea name="misi" class="textarea textarea-bordered @error('misi') textarea-error @enderror" rows="6" required>{{ old('misi', $profil->misi) }}</textarea>
                        @error('misi') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Sejarah Sekolah</span></label>
                        <textarea name="sejarah" class="textarea textarea-bordered @error('sejarah') textarea-error @enderror" rows="6" required>{{ old('sejarah', $profil->sejarah) }}</textarea>
                        @error('sejarah') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Nama Kepala Sekolah</span></label>
                            <input type="text" name="kepala_sekolah" class="input input-bordered @error('kepala_sekolah') input-error @enderror" value="{{ old('kepala_sekolah', $profil->kepala_sekolah) }}" required>
                            @error('kepala_sekolah') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Foto Kepala Sekolah</span></label>
                            @if($profil->foto_kepala_sekolah_url)
                                <div class="mb-2">
                                    <img src="{{ $profil->foto_kepala_sekolah_url }}" alt="Foto Kepsek" class="w-20 h-20 object-cover rounded-full bg-base-200">
                                    <p class="text-xs text-base-content/60 mt-1">Foto saat ini. Upload baru untuk mengganti.</p>
                                </div>
                            @endif
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
