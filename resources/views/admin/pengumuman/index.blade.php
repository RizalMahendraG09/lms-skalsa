@php
    $title = 'Pengumuman';
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Pengumuman') }}
            </h2>
            <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary btn-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Pengumuman
            </a>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto">
        <div class="card bg-base-100 shadow-xl">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Thumbnail</th>
                            <th>Status</th>
                            <th>Tgl. Publish</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengumumanList as $pengumuman)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="font-medium">{{ $pengumuman->judul }}</td>
                                <td>
                                    @if($pengumuman->thumbnail_url)
                                        <img src="{{ $pengumuman->thumbnail_url }}" alt="thumb" class="w-12 h-12 object-cover rounded-lg">
                                    @else
                                        <span class="text-base-content/40">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($pengumuman->status_publish === 'published')
                                        <span class="badge badge-success badge-sm">Published</span>
                                    @else
                                        <span class="badge badge-ghost badge-sm">Draft</span>
                                    @endif
                                </td>
                                <td>{{ $pengumuman->tanggal_publish ? $pengumuman->tanggal_publish->format('d M Y H:i') : '-' }}</td>
                                <td>{{ $pengumuman->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="flex gap-1">
                                        <a href="{{ route('admin.pengumuman.edit', $pengumuman) }}" class="btn btn-ghost btn-xs btn-square">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.pengumuman.destroy', $pengumuman) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-ghost btn-xs btn-square text-error">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-8 text-base-content/60">Belum ada pengumuman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($pengumumanList->hasPages())
                <div class="p-4 border-t border-base-200">
                    {{ $pengumumanList->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
