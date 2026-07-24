@php
    $title = 'Data Tabungan';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Data Tabungan') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto">
        @php
            $siswaTanpaTabungan = \App\Models\User::where('role', 'siswa')->whereDoesntHave('tabungan')->count();
        @endphp

        @if($siswaTanpaTabungan > 0)
            <div class="alert alert-warning mb-6 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                <span>Terdapat <strong>{{ $siswaTanpaTabungan }}</strong> siswa yang belum memiliki tabungan.</span>
                <a href="{{ route('admin.tabungan.init') }}" class="btn btn-warning btn-sm" onclick="return confirm('Buat tabungan untuk {{ $siswaTanpaTabungan }} siswa?')">Inisialisasi Tabungan</a>
            </div>
        @endif

        <div class="card bg-base-100 shadow-xl mb-6">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.tabungan.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Cari Nama / NIS</span></label>
                            <input type="text" name="search" class="input input-bordered" placeholder="Ketik nama atau NIS..." value="{{ request('search') }}">
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Filter Kelas</span></label>
                            <select name="kelas_id" class="select select-bordered">
                                <option value="">Semua Kelas</option>
                                @foreach($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}" @selected(request('kelas_id') == $kelas->id)>{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-control flex items-end">
                            <button type="submit" class="btn btn-primary w-full">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Saldo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tabunganList as $tabungan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tabungan->siswa->nis ?? '-' }}</td>
                                <td class="font-medium">{{ $tabungan->siswa->name }}</td>
                                <td>{{ $tabungan->siswa->kelas->nama_kelas ?? '-' }}</td>
                                <td class="font-semibold">Rp {{ number_format($tabungan->saldo, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('admin.tabungan.show', $tabungan) }}" class="btn btn-ghost btn-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8 text-base-content/60">Belum ada data tabungan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($tabunganList->hasPages())
                <div class="p-4 border-t border-base-200">
                    {{ $tabunganList->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
