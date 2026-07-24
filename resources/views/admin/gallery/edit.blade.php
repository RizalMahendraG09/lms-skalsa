@php
    $title = 'Edit Foto';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Edit Foto') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="form-control">
                        <label class="label"><span class="label-text">Judul</span></label>
                        <input type="text" name="judul" class="input input-bordered @error('judul') input-error @enderror" value="{{ old('judul', $gallery->judul) }}" required>
                        @error('judul') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Foto</span></label>
                        @if($gallery->foto_url)
                            <div class="mb-2">
                                <img src="{{ $gallery->foto_url }}" alt="{{ $gallery->judul }}" class="w-48 h-32 object-cover rounded-lg bg-base-200">
                                <p class="text-xs text-base-content/60 mt-1">Foto saat ini. Upload baru untuk mengganti.</p>
                            </div>
                        @endif
                        <input type="file" name="foto" accept="image/jpg,image/jpeg,image/png" class="file-input file-input-bordered @error('foto') file-input-error @enderror">
                        <p class="text-xs text-base-content/60 mt-1">Format: JPG/JPEG/PNG. Maks: 2MB</p>
                        @error('foto') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Deskripsi</span></label>
                        <textarea name="deskripsi" class="textarea textarea-bordered @error('deskripsi') textarea-error @enderror" rows="3">{{ old('deskripsi', $gallery->deskripsi) }}</textarea>
                        @error('deskripsi') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Kategori</span></label>
                        <select name="kategori" class="select select-bordered @error('kategori') select-error @enderror">
                            <option value="">Pilih Kategori</option>
                            <option value="Kegiatan" @selected(old('kategori', $gallery->kategori) === 'Kegiatan')>Kegiatan</option>
                            <option value="Prestasi" @selected(old('kategori', $gallery->kategori) === 'Prestasi')>Prestasi</option>
                            <option value="Lingkungan" @selected(old('kategori', $gallery->kategori) === 'Lingkungan')>Lingkungan</option>
                            <option value="Ekstrakurikuler" @selected(old('kategori', $gallery->kategori) === 'Ekstrakurikuler')>Ekstrakurikuler</option>
                            <option value="Lainnya" @selected(old('kategori', $gallery->kategori) === 'Lainnya')>Lainnya</option>
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
