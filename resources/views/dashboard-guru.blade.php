<x-app-layout>
    <x-slot name="header">Dashboard Guru</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="stat bg-base-100 shadow-xl rounded-box p-4">
            <div class="stat-figure text-primary">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div class="stat-title text-sm">Mapel Saya</div>
            <div class="stat-value text-primary">{{ $totalMapel ?? 0 }}</div>
            <div class="stat-desc text-xs">Mata pelajaran yang diampu</div>
        </div>
        <div class="stat bg-base-100 shadow-xl rounded-box p-4">
            <div class="stat-figure text-secondary">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div class="stat-title text-sm">Materi Saya</div>
            <div class="stat-value text-secondary">{{ $totalMateri ?? 0 }}</div>
            <div class="stat-desc text-xs">Dokumen materi</div>
        </div>
        <div class="stat bg-base-100 shadow-xl rounded-box p-4">
            <div class="stat-figure text-accent">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </div>
            <div class="stat-title text-sm">Tugas Saya</div>
            <div class="stat-value text-accent">{{ $totalTugas ?? 0 }}</div>
            <div class="stat-desc text-xs">Total tugas dibuat</div>
        </div>
    </div>

    <h2 class="text-lg font-semibold text-base-content mb-4">Menu Cepat</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('guru.materi.index') }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-200">
            <div class="card-body items-center text-center p-6">
                <div class="w-14 h-14 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="card-title">Materi</h3>
                <p class="text-sm text-base-content/60">Kelola materi pembelajaran</p>
            </div>
        </a>
        <a href="{{ route('guru.tugas.index') }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-200">
            <div class="card-body items-center text-center p-6">
                <div class="w-14 h-14 rounded-full bg-secondary/10 text-secondary flex items-center justify-center mb-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <h3 class="card-title">Tugas</h3>
                <p class="text-sm text-base-content/60">Buat dan kelola tugas</p>
            </div>
        </a>
        <a href="{{ route('guru.tugas.index') }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-200">
            <div class="card-body items-center text-center p-6">
                <div class="w-14 h-14 rounded-full bg-success/10 text-success flex items-center justify-center mb-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="card-title">Penilaian</h3>
                <p class="text-sm text-base-content/60">Nilai hasil tugas siswa</p>
            </div>
        </a>
        <a href="{{ route('guru.rekap-nilai.index') }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-200">
            <div class="card-body items-center text-center p-6">
                <div class="w-14 h-14 rounded-full bg-info/10 text-info flex items-center justify-center mb-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="card-title">Rekap Nilai</h3>
                <p class="text-sm text-base-content/60">Rekap per tugas & statistik</p>
            </div>
        </a>
    </div>

    @if(isset($pengumumanTerbaru) && $pengumumanTerbaru->isNotEmpty())
        <div class="card bg-base-100 shadow-xl mt-8">
            <div class="card-body">
                <h2 class="card-title text-lg mb-4">
                    <svg class="w-5 h-5 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    Pengumuman Terbaru
                </h2>
                <div class="divide-y divide-base-200">
                    @foreach($pengumumanTerbaru as $item)
                        <div class="flex items-center justify-between py-3">
                            <div class="flex items-center gap-3">
                                @if($item->thumbnail_url)
                                    <img src="{{ $item->thumbnail_url }}" alt="" class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-warning/10 text-warning flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-medium text-sm">{{ $item->judul }}</p>
                                    <p class="text-xs text-base-content/60">{{ $item->tanggal_publish->format('d M Y') }}</p>
                                </div>
                            </div>
                            <a href="{{ route('pengumuman.show', $item->slug) }}" class="btn btn-ghost btn-sm">Baca</a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3 text-right">
                    <a href="{{ route('pengumuman.index') }}" class="btn btn-ghost btn-sm text-primary">Lihat Semua Pengumuman</a>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
