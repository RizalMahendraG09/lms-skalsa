@php
    $title = $pengumuman->judul;
@endphp

<x-public-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <nav class="text-sm breadcrumbs mb-6">
            <ul>
                <li><a href="{{ route('public.home') }}">Beranda</a></li>
                <li><a href="{{ route('pengumuman.index') }}">Pengumuman</a></li>
                <li class="text-base-content/60">{{ Str::limit($pengumuman->judul, 40) }}</li>
            </ul>
        </nav>

        <div class="card bg-base-100 shadow-xl">
            @if($pengumuman->thumbnail_url)
                <figure>
                    <img src="{{ $pengumuman->thumbnail_url }}" alt="{{ $pengumuman->judul }}" class="w-full h-72 object-cover">
                </figure>
            @endif
            <div class="card-body">
                <h1 class="text-3xl font-bold">{{ $pengumuman->judul }}</h1>
                <div class="flex items-center gap-2 text-sm text-base-content/50 mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $pengumuman->tanggal_publish->format('d F Y H:i') }}
                </div>

                <div class="prose max-w-none">
                    <p>{{ $pengumuman->isi }}</p>
                </div>
            </div>
        </div>

        @if($recent->isNotEmpty())
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Pengumuman Lainnya</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($recent as $item)
                        <a href="{{ route('pengumuman.show', $item->slug) }}" class="card bg-base-100 shadow hover:shadow-lg transition-all">
                            @if($item->thumbnail_url)
                                <figure>
                                    <img src="{{ $item->thumbnail_url }}" alt="{{ $item->judul }}" class="w-full h-32 object-cover">
                                </figure>
                            @endif
                            <div class="card-body p-4">
                                <p class="text-xs text-base-content/50">{{ $item->tanggal_publish->format('d M Y') }}</p>
                                <h4 class="font-semibold text-sm">{{ $item->judul }}</h4>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('pengumuman.index') }}" class="btn btn-ghost">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Daftar
            </a>
        </div>
    </div>
</x-public-layout>