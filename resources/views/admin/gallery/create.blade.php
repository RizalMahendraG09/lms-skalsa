@php
    $title = 'Upload Foto';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Upload Foto') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="form-control">
                        <label class="label"><span class="label-text">Judul</span></label>
                        <input type="text" name="judul" class="input input-bordered @error('judul') input-error @enderror" value="{{ old('judul') }}" required>
                        @error('judul') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Foto</span></label>
                        <input type="file" name="foto" accept="image/jpg,image/jpeg,image/png" class="file-input file-input-bordered @error('foto') file-input-error @enderror" required>
                        <p class="text-xs text-base-content/60 mt-1">Format: JPG/JPEG/PNG. Maks: 2MB</p>
                        @error('foto') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Deskripsi</span></label>
                        <textarea name="deskripsi" class="textarea textarea-bordered @error('deskripsi') textarea-error @enderror" rows="3">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Kategori</span></label>
                        <select name="kategori" class="select select-bordered @error('kategori') select-error @enderror">
                            <option value="">Pilih Kategori</option>
                            <option value="Kegiatan" @selected(old('kategori') === 'Kegiatan')>Kegiatan</option>
                            <option value="Prestasi" @selected(old('kategori') === 'Prestasi')>Prestasi</option>
                            <option value="Lingkungan" @selected(old('kategori') === 'Lingkungan')>Lingkungan</option>
                            <option value="Ekstrakurikuler" @selected(old('kategori') === 'Ekstrakurikuler')>Ekstrakurikuler</option>
                            <option value="Lainnya" @selected(old('kategori') === 'Lainnya')>Lainnya</option>
                        </select>
                        @error('kategori') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.gallery.index') }}" class="btn btn-ghost">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
