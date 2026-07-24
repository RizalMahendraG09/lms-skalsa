@php
    $title = 'Dashboard Tabungan';
@endphp

<x-app-layout>
    <x-slot name="header">Dashboard Tabungan</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 mb-8">
        <div class="stat bg-base-100 shadow-xl rounded-box p-4">
            <div class="stat-figure text-primary">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <div class="stat-title text-sm">Total Siswa</div>
            <div class="stat-value text-primary">{{ number_format($totalSiswa, 0, ',', '.') }}</div>
            <div class="stat-desc text-xs">Memiliki tabungan</div>
        </div>

        <div class="stat bg-base-100 shadow-xl rounded-box p-4">
            <div class="stat-figure text-secondary">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div class="stat-title text-sm">Total Saldo</div>
            <div class="stat-value text-secondary">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</div>
            <div class="stat-desc text-xs">Seluruh siswa</div>
        </div>

        <div class="stat bg-base-100 shadow-xl rounded-box p-4">
            <div class="stat-figure text-success">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            </div>
            <div class="stat-title text-sm">Setoran Hari Ini</div>
            <div class="stat-value text-success">Rp {{ number_format($setorHariIni, 0, ',', '.') }}</div>
            <div class="stat-desc text-xs">Total setoran</div>
        </div>

        <div class="stat bg-base-100 shadow-xl rounded-box p-4">
            <div class="stat-figure text-error">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
            </div>
            <div class="stat-title text-sm">Penarikan Hari Ini</div>
            <div class="stat-value text-error">Rp {{ number_format($tarikHariIni, 0, ',', '.') }}</div>
            <div class="stat-desc text-xs">Total penarikan</div>
        </div>

        <div class="stat bg-base-100 shadow-xl rounded-box p-4">
            <div class="stat-figure text-info">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <div class="stat-title text-sm">Transaksi Hari Ini</div>
            <div class="stat-value text-info">{{ number_format($transaksiHariIni, 0, ',', '.') }}</div>
            <div class="stat-desc text-xs">Total transaksi</div>
        </div>
    </div>

    <h2 class="text-lg font-semibold text-base-content mb-4">Menu Cepat</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('admin.tabungan.index') }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-200">
            <div class="card-body items-center text-center p-6">
                <div class="w-14 h-14 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <h3 class="card-title">Data Tabungan</h3>
                <p class="text-sm text-base-content/60">Lihat data tabungan siswa</p>
            </div>
        </a>
        <a href="{{ route('admin.tabungan.laporan') }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-200">
            <div class="card-body items-center text-center p-6">
                <div class="w-14 h-14 rounded-full bg-secondary/10 text-secondary flex items-center justify-center mb-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="card-title">Laporan</h3>
                <p class="text-sm text-base-content/60">Laporan & export transaksi</p>
            </div>
        </a>
    </div>
</x-app-layout>
