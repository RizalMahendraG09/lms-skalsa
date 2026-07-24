@php
    $title = 'Galeri';
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Galeri') }}
            </h2>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary btn-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Upload Foto
            </a>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($galleries as $gallery)
                <div class="card bg-base-100 shadow-xl">
                    <figure class="relative group">
                        <img src="{{ $gallery->foto_url }}" alt="{{ $gallery->judul }}" class="w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                            <a href="{{ route('admin.gallery.edit', $gallery) }}" class="btn btn-sm btn-ghost text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-ghost text-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </figure>
                    <div class="card-body p-3">
                        <h3 class="font-semibold text-sm truncate">{{ $gallery->judul }}</h3>
                        @if($gallery->kategori)
                            <span class="badge badge-ghost badge-xs">{{ $gallery->kategori }}</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full card bg-base-100 shadow-xl">
                    <div class="card-body text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-base-content/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-base-content/60">Belum ada foto.</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if($galleries->hasPages())
            <div class="mt-6">
                {{ $galleries->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
