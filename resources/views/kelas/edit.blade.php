<x-app-layout>
    <x-slot name="header">Edit Kelas</x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <form action="{{ route('admin.kelas.update', $kelas) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nama Kelas</span>
                    </label>
                    <input type="text" name="nama_kelas" class="input input-bordered" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" placeholder="Contoh: X RPL 1">
                    @error('nama_kelas')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center gap-4 mt-6">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('admin.kelas.index') }}" class="btn btn-ghost btn-sm">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
