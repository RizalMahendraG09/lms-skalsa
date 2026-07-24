@php
    $title = 'Galeri Sekolah';
@endphp

<x-public-layout>
    <div class="max-w-6xl mx-auto px-4 py-8">
        {{-- Header & Filter --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h1 class="text-3xl md:text-4xl font-bold section-title">Galeri Sekolah</h1>
            @if($kategoriList->isNotEmpty())
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('galeri.index') }}"
                        class="btn btn-sm {{ !$kategoriAktif ? 'btn-primary' : 'btn-ghost' }}">
                        Semua
                    </a>
                    @foreach($kategoriList as $kat)
                        <a href="{{ route('galeri.index', ['kategori' => $kat]) }}"
                            class="btn btn-sm {{ $kategoriAktif === $kat ? 'btn-primary' : 'btn-ghost' }}">
                            {{ $kat }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        @if($galleries->isEmpty())
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-base-content/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p class="text-base-content/60">Belum ada foto galeri.</p>
                </div>
            </div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($galleries as $gallery)
                    <div class="card bg-base-100 shadow-xl cursor-pointer" onclick="openLightbox('{{ $gallery->foto_url }}', '{{ $gallery->judul }}', '{{ $gallery->deskripsi }}')">
                        <figure>
                            <img src="{{ $gallery->foto_url }}" alt="{{ $gallery->judul }}" class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                        </figure>
                        <div class="card-body p-3">
                            <h3 class="font-semibold text-sm truncate">{{ $gallery->judul }}</h3>
                            @if($gallery->kategori)
                                <span class="badge badge-ghost badge-xs">{{ $gallery->kategori }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            @if($galleries->hasPages())
                <div class="mt-6">
                    {{ $galleries->links() }}
                </div>
            @endif
        @endif
    </div>

    {{-- Lightbox Modal --}}
    <dialog id="lightbox-modal" class="modal">
        <form method="dialog" class="modal-box max-w-4xl p-0 bg-transparent shadow-none">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 text-white z-10">✕</button>
            <div class="relative">
                <img id="lightbox-image" src="" alt="" class="w-full max-h-[80vh] object-contain rounded-xl">
                <div class="bg-black/70 text-white p-4 rounded-b-xl">
                    <h3 id="lightbox-title" class="font-semibold text-lg"></h3>
                    <p id="lightbox-desc" class="text-sm text-white/80 mt-1"></p>
                </div>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    @push('scripts')
    <script>
        function openLightbox(url, title, desc) {
            document.getElementById('lightbox-image').src = url;
            document.getElementById('lightbox-title').textContent = title;
            document.getElementById('lightbox-desc').textContent = desc || '';
            document.getElementById('lightbox-modal').showModal();
        }
    </script>
    @endpush
</x-public-layout>