<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Rekap Nilai Tugas') }}
            </h2>
            <a href="{{ route('guru.rekap-nilai.pdf') }}" class="btn btn-sm btn-error">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Export PDF
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @forelse ($tugasList as $t)
                <div class="card bg-base-100 shadow-xl mb-6">
                    <div class="card-body">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <h3 class="card-title">{{ $t->judul }}</h3>
                                <p class="text-sm text-base-content/60">
                                    {{ $t->mataPelajaran->nama_mapel ?? '-' }}
                                    &bull; {{ $t->deadline ? $t->deadline->format('d M Y H:i') : '-' }}
                                </p>
                            </div>
                            <div class="flex items-center gap-4 flex-wrap">
                                <div class="text-center">
                                    <span class="block text-2xl font-bold text-primary">{{ $t->total_submit ?? 0 }}</span>
                                    <span class="text-xs opacity-60">Submit</span>
                                </div>
                                <div class="text-center">
                                    <span class="block text-2xl font-bold text-success">{{ $t->total_dinilai ?? 0 }}</span>
                                    <span class="text-xs opacity-60">Dinilai</span>
                                </div>
                                <div class="text-center">
                                    <span class="block text-2xl font-bold text-warning">{{ ($t->total_submit ?? 0) - ($t->total_dinilai ?? 0) }}</span>
                                    <span class="text-xs opacity-60">Menunggu</span>
                                </div>
                                <a href="{{ route('guru.tugas.nilai', $t) }}" class="btn btn-sm btn-primary">Detail Nilai</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body text-center">
                        <p class="opacity-60">Belum ada tugas yang dibuat.</p>
                    </div>
                </div>
            @endforelse

            <div class="mt-4">
                {{ $tugasList->links() }}
            </div>

            <div class="mt-4">
                <a href="{{ route('guru.dashboard') }}" class="btn btn-ghost">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
