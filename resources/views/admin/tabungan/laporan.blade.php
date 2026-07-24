@php
    $title = 'Laporan Tabungan';
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Laporan Tabungan') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.tabungan.laporan.pdf', request()->query()) }}" class="btn btn-error btn-sm gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    Export PDF
                </a>
                <a href="{{ route('admin.tabungan.laporan.excel', request()->query()) }}" class="btn btn-success btn-sm gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Export Excel
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto">
        <div class="card bg-base-100 shadow-xl mb-6">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.tabungan.laporan') }}">
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Tanggal Awal</span></label>
                            <input type="date" name="start_date" class="input input-bordered" value="{{ request('start_date') }}">
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Tanggal Akhir</span></label>
                            <input type="date" name="end_date" class="input input-bordered" value="{{ request('end_date') }}">
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Kelas</span></label>
                            <select name="kelas_id" class="select select-bordered">
                                <option value="">Semua Kelas</option>
                                @foreach($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}" @selected(request('kelas_id') == $kelas->id)>{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Siswa</span></label>
                            <select name="siswa_id" class="select select-bordered">
                                <option value="">Semua Siswa</option>
                                @foreach($siswaList as $siswa)
                                    <option value="{{ $siswa->id }}" @selected(request('siswa_id') == $siswa->id)>{{ $siswa->name }} ({{ $siswa->nis ?? '-' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Jenis</span></label>
                            <select name="jenis" class="select select-bordered">
                                <option value="">Semua</option>
                                <option value="setor" @selected(request('jenis') === 'setor')>Setoran</option>
                                <option value="tarik" @selected(request('jenis') === 'tarik')>Penarikan</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="stat bg-base-100 shadow-xl rounded-box p-4">
                <div class="stat-title text-sm">Total Setoran</div>
                <div class="stat-value text-success">Rp {{ number_format($totalSetor, 0, ',', '.') }}</div>
            </div>
            <div class="stat bg-base-100 shadow-xl rounded-box p-4">
                <div class="stat-title text-sm">Total Penarikan</div>
                <div class="stat-value text-error">Rp {{ number_format($totalTarik, 0, ',', '.') }}</div>
            </div>
            <div class="stat bg-base-100 shadow-xl rounded-box p-4">
                <div class="stat-title text-sm">Saldo Akhir</div>
                <div class="stat-value text-primary">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Jenis</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksiList as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                                <td>{{ $item->tabungan->siswa->nis ?? '-' }}</td>
                                <td class="font-medium">{{ $item->tabungan->siswa->name }}</td>
                                <td>{{ $item->tabungan->siswa->kelas->nama_kelas ?? '-' }}</td>
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
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-8 text-base-content/60">Tidak ada data transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($transaksiList->hasPages())
                <div class="p-4 border-t border-base-200">
                    {{ $transaksiList->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
