@php
    $title = 'Data Staff';
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Data Staff') }}
            </h2>
            <a href="{{ route('admin.staff.create') }}" class="btn btn-primary btn-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Staff
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
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($staffList as $staff)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($staff->foto_url)
                                        <div class="avatar">
                                            <div class="w-10 h-10 rounded-full">
                                                <img src="{{ $staff->foto_url }}" alt="{{ $staff->nama }}">
                                            </div>
                                        </div>
                                    @else
                                        <div class="avatar placeholder">
                                            <div class="w-10 h-10 rounded-full bg-neutral text-neutral-content">
                                                <span>{{ substr($staff->nama, 0, 1) }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td class="font-medium">{{ $staff->nama }}</td>
                                <td>{{ $staff->jabatan }}</td>
                                <td>{{ $staff->email ?? '-' }}</td>
                                <td>{{ $staff->telepon ?? '-' }}</td>
                                <td>{{ $staff->urutan }}</td>
                                <td>
                                    @if($staff->status_aktif === 'aktif')
                                        <span class="badge badge-success badge-sm">Aktif</span>
                                    @else
                                        <span class="badge badge-ghost badge-sm">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex gap-1">
                                        <a href="{{ route('admin.staff.edit', $staff) }}" class="btn btn-ghost btn-xs btn-square">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.staff.destroy', $staff) }}" method="POST" onsubmit="return confirm('Hapus staff ini?')">
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
                                <td colspan="9" class="text-center py-8 text-base-content/60">Belum ada data staff.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($staffList->hasPages())
                <div class="p-4 border-t border-base-200">
                    {{ $staffList->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
