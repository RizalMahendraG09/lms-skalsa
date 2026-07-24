@php
    $title = 'Edit Transaksi';
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                Edit Transaksi - {{ $tabungan->siswa->name }}
            </h2>
            <a href="{{ route('admin.tabungan.show', $tabungan) }}" class="btn btn-ghost btn-sm">Kembali</a>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="card bg-base-100 shadow-xl mb-6">
            <div class="card-body">
                <div class="flex items-center gap-4">
                    <div class="avatar placeholder">
                        <div class="w-12 h-12 rounded-full bg-primary text-primary-content flex items-center justify-center font-bold">
                            {{ substr($tabungan->siswa->name, 0, 1) }}
                        </div>
                    </div>
                    <div>
                        <p class="font-semibold">{{ $tabungan->siswa->name }}</p>
                        <p class="text-sm text-base-content/60">{{ $tabungan->siswa->nis ?? '-' }} | {{ $tabungan->siswa->kelas->nama_kelas ?? '-' }}</p>
                    </div>
                    <div class="ml-auto text-right">
                        <p class="text-sm text-base-content/60">Saldo Saat Ini</p>
                        <p class="text-lg font-bold">Rp {{ number_format($tabungan->saldo, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <form action="{{ route('admin.tabungan.transaksi.update', [$tabungan, $transaksi]) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="form-control">
                        <label class="label"><span class="label-text">Tanggal</span></label>
                        <input type="date" name="tanggal" class="input input-bordered @error('tanggal') input-error @enderror" value="{{ old('tanggal', $transaksi->tanggal->format('Y-m-d')) }}" required>
                        @error('tanggal') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Jenis Transaksi</span></label>
                        <input type="text" class="input input-bordered" value="{{ $transaksi->jenis === 'setor' ? 'Setoran' : 'Penarikan' }}" disabled>
                        <p class="text-xs text-base-content/60 mt-1">Jenis transaksi tidak dapat diubah.</p>
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Nominal (Rp)</span></label>
                        <input type="number" name="nominal" class="input input-bordered @error('nominal') input-error @enderror" value="{{ old('nominal', $transaksi->nominal) }}" min="1" required>
                        @error('nominal') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Keterangan <span class="text-base-content/40">(opsional)</span></span></label>
                        <input type="text" name="keterangan" class="input input-bordered @error('keterangan') input-error @enderror" value="{{ old('keterangan', $transaksi->keterangan) }}" placeholder="Catatan transaksi">
                        @error('keterangan') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.tabungan.show', $tabungan) }}" class="btn btn-ghost">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
