<x-app-layout>
    <x-slot name="header">Dashboard Admin</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 mb-8">
        <div class="stat bg-base-100 shadow-xl rounded-box p-4">
            <div class="stat-figure text-primary">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div class="stat-title text-sm">Total Guru</div>
            <div class="stat-value text-primary">{{ $totalGuru ?? 0 }}</div>
            <div class="stat-desc text-xs">Pengajar</div>
        </div>
        <div class="stat bg-base-100 shadow-xl rounded-box p-4">
            <div class="stat-figure text-secondary">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <div class="stat-title text-sm">Total Siswa</div>
            <div class="stat-value text-secondary">{{ $totalSiswa ?? 0 }}</div>
            <div class="stat-desc text-xs">Pelajar</div>
        </div>
        <div class="stat bg-base-100 shadow-xl rounded-box p-4">
            <div class="stat-figure text-accent">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <div class="stat-title text-sm">Total Kelas</div>
            <div class="stat-value text-accent">{{ $totalKelas ?? 0 }}</div>
            <div class="stat-desc text-xs">Ruang belajar</div>
        </div>
        <div class="stat bg-base-100 shadow-xl rounded-box p-4">
            <div class="stat-figure text-info">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div class="stat-title text-sm">Total Mapel</div>
            <div class="stat-value text-info">{{ $totalMapel ?? 0 }}</div>
            <div class="stat-desc text-xs">Mata Pelajaran</div>
        </div>
        <div class="stat bg-base-100 shadow-xl rounded-box p-4">
            <div class="stat-figure text-success">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div class="stat-title text-sm">Total Materi</div>
            <div class="stat-value text-success">{{ $totalMateri ?? 0 }}</div>
            <div class="stat-desc text-xs">Dokumen belajar</div>
        </div>
        <div class="stat bg-base-100 shadow-xl rounded-box p-4">
            <div class="stat-figure text-warning">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
            </div>
            <div class="stat-title text-sm">Pengumuman</div>
            <div class="stat-value text-warning">{{ $totalPengumuman ?? 0 }}</div>
            <div class="stat-desc text-xs">Telah dipublish</div>
        </div>
    </div>

    <h2 class="text-lg font-semibold text-base-content mb-4">Menu Cepat</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        <a href="{{ route('admin.kelas.index') }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-200">
            <div class="card-body items-center text-center p-4">
                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="card-title text-sm">Kelas</h3>
            </div>
        </a>
        <a href="{{ route('admin.guru.index') }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-200">
            <div class="card-body items-center text-center p-4">
                <div class="w-12 h-12 rounded-full bg-secondary/10 text-secondary flex items-center justify-center mb-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="card-title text-sm">Guru</h3>
            </div>
        </a>
        <a href="{{ route('admin.siswa.index') }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-200">
            <div class="card-body items-center text-center p-4">
                <div class="w-12 h-12 rounded-full bg-accent/10 text-accent flex items-center justify-center mb-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h3 class="card-title text-sm">Siswa</h3>
            </div>
        </a>
        <a href="{{ route('admin.mata-pelajaran.index') }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-200">
            <div class="card-body items-center text-center p-4">
                <div class="w-12 h-12 rounded-full bg-info/10 text-info flex items-center justify-center mb-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 class="card-title text-sm">Mapel</h3>
            </div>
        </a>
        <a href="{{ route('admin.materi.index') }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-200">
            <div class="card-body items-center text-center p-4">
                <div class="w-12 h-12 rounded-full bg-success/10 text-success flex items-center justify-center mb-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="card-title text-sm">Materi</h3>
            </div>
        </a>
        <a href="{{ route('admin.tugas.index') }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-200">
            <div class="card-body items-center text-center p-4">
                <div class="w-12 h-12 rounded-full bg-warning/10 text-warning flex items-center justify-center mb-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <h3 class="card-title text-sm">Tugas</h3>
            </div>
        </a>
    </div>
</x-app-layout>
