@php
    $title = 'Buat Pengumuman';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Buat Pengumuman') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="form-control">
                        <label class="label"><span class="label-text">Judul</span></label>
                        <input type="text" name="judul" class="input input-bordered @error('judul') input-error @enderror" value="{{ old('judul') }}" required>
                        @error('judul') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Isi Pengumuman</span></label>
                        <textarea name="isi" class="textarea textarea-bordered @error('isi') textarea-error @enderror" rows="10" required>{{ old('isi') }}</textarea>
                        @error('isi') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Gambar Thumbnail</span></label>
                        <input type="file" name="gambar_thumbnail" accept="image/jpg,image/jpeg,image/png" class="file-input file-input-bordered @error('gambar_thumbnail') file-input-error @enderror">
                        <p class="text-xs text-base-content/60 mt-1">Format: JPG/JPEG/PNG. Maks: 2MB</p>
                        @error('gambar_thumbnail') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Status</span></label>
                            <select name="status_publish" class="select select-bordered @error('status_publish') select-error @enderror" required>
                                <option value="draft" @selected(old('status_publish', 'draft') === 'draft')>Draft</option>
                                <option value="published" @selected(old('status_publish') === 'published')>Published</option>
                            </select>
                            @error('status_publish') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Tanggal Publish</span></label>
                            <input type="datetime-local" name="tanggal_publish" class="input input-bordered @error('tanggal_publish') input-error @enderror" value="{{ old('tanggal_publish') }}">
                            <p class="text-xs text-base-content/60 mt-1">Kosongkan untuk menggunakan waktu sekarang</p>
                            @error('tanggal_publish') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-ghost">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
