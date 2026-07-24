@php
    $title = 'Detail Tabungan - ' . $tabungan->siswa->name;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                Detail Tabungan - {{ $tabungan->siswa->name }}
            </h2>
            <a href="{{ route('admin.tabungan.index') }}" class="btn btn-ghost btn-sm">Kembali</a>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="avatar placeholder">
                            <div class="w-16 h-16 rounded-full bg-primary text-primary-content flex items-center justify-center text-xl font-bold">
                                {{ substr($tabungan->siswa->name, 0, 1) }}
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">{{ $tabungan->siswa->name }}</h3>
                            <p class="text-sm text-base-content/60">NIS: {{ $tabungan->siswa->nis ?? '-' }}</p>
                            <p class="text-sm text-base-content/60">Kelas: {{ $tabungan->siswa->kelas->nama_kelas ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body flex flex-row items-center gap-4">
                    <div class="stat-figure text-secondary">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-base-content/60">Saldo Saat Ini</p>
                        <p class="text-2xl font-bold text-secondary">Rp {{ number_format($tabungan->saldo, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body flex flex-row items-center justify-center gap-4">
                    <a href="{{ route('admin.tabungan.setor', $tabungan) }}" class="btn btn-success btn-lg gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Setor
                    </a>
                    <a href="{{ route('admin.tabungan.tarik', $tabungan) }}" class="btn btn-error btn-lg gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                        Tarik
                    </a>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h3 class="card-title text-lg mb-4">Riwayat Transaksi</h3>

                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Jenis</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Admin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                                    <td>
                                        @if($item->jenis === 'setor')
                                            <span class="badge badge-success badge-sm">Setoran</span>
                                        @else
                                            <span class="badge badge-error badge-sm">Penarikan</span>
                                        @endif
                                    </td>
                                    <td class="font-medium">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>{{ $item->admin->name }}</td>
                                    <td>
                                        <div class="flex gap-1">
                                            <a href="{{ route('admin.tabungan.transaksi.edit', [$tabungan, $item]) }}" class="btn btn-ghost btn-xs btn-square">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <form action="{{ route('admin.tabungan.transaksi.destroy', [$tabungan, $item]) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini? Saldo akan dihitung ulang.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-ghost btn-xs btn-square text-error">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-8 text-base-content/60">Belum ada transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($transaksi->hasPages())
                    <div class="mt-4 border-t border-base-200 pt-4">
                        {{ $transaksi->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
