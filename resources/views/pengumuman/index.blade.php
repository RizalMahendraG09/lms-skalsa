@php
    $title = 'Pengumuman';
@endphp

<x-public-layout>
    <div class="max-w-6xl mx-auto px-4 py-8">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h1 class="text-3xl md:text-4xl font-bold section-title">Pengumuman</h1>
            <form method="GET" action="{{ route('pengumuman.index') }}" class="flex gap-2">
                <input type="text" name="search" placeholder="Cari pengumuman..." value="{{ request('search') }}"
                    class="input input-bordered w-full sm:w-64">
                <button type="submit" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
                @if(request('search'))
                    <a href="{{ route('pengumuman.index') }}" class="btn btn-ghost">Reset</a>
                @endif
            </form>
        </div>

        @if($pengumumanList->isEmpty())
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-base-content/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    <p class="text-base-content/60">Belum ada pengumuman.</p>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($pengumumanList as $pengumuman)
                    <a href="{{ route('pengumuman.show', $pengumuman->slug) }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-200 hover:-translate-y-1">
                        @if($pengumuman->thumbnail_url)
                            <figure>
                                <img src="{{ $pengumuman->thumbnail_url }}" alt="{{ $pengumuman->judul }}" class="w-full h-48 object-cover">
                            </figure>
                        @else
                            <figure class="bg-base-200 h-48 flex items-center justify-center">
                                <svg class="w-16 h-16 text-base-content/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                            </figure>
                        @endif
                        <div class="card-body">
                            <div class="flex items-center gap-2 text-xs text-base-content/50 mb-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $pengumuman->tanggal_publish->format('d M Y') }}
                            </div>
                            <h3 class="card-title text-lg">{{ $pengumuman->judul }}</h3>
                            <p class="text-sm text-base-content/70">{{ $pengumuman->excerpt }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $pengumumanList->links() }}
            </div>
        @endif
    </div>
</x-public-layout>