@php
    $title = 'Tarik Tabungan - ' . $tabungan->siswa->name;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                Tarik Tabungan - {{ $tabungan->siswa->name }}
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
                        <p class="text-lg font-bold text-error">Rp {{ number_format($tabungan->saldo, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-info mb-6 shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Saldo tidak boleh negatif. Pastikan nominal penarikan tidak melebihi saldo saat ini.</span>
        </div>

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <form action="{{ route('admin.tabungan.tarik.store', $tabungan) }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="form-control">
                        <label class="label"><span class="label-text">Tanggal</span></label>
                        <input type="date" name="tanggal" class="input input-bordered @error('tanggal') input-error @enderror" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                        @error('tanggal') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Nominal Penarikan (Rp)</span></label>
                        <input type="number" name="nominal" class="input input-bordered @error('nominal') input-error @enderror" value="{{ old('nominal') }}" placeholder="Masukkan nominal" min="1" max="{{ (int) $tabungan->saldo }}" required>
                        @error('nominal') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Keterangan <span class="text-base-content/40">(opsional)</span></span></label>
                        <input type="text" name="keterangan" class="input input-bordered @error('keterangan') input-error @enderror" value="{{ old('keterangan') }}" placeholder="Catatan penarikan">
                        @error('keterangan') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.tabungan.show', $tabungan) }}" class="btn btn-ghost">Batal</a>
                        <button type="submit" class="btn btn-error">Simpan Penarikan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
