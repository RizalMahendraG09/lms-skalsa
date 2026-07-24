@php
    $title = 'Guru & Staff';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Guru & Staff') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto space-y-12">
        {{-- Daftar Staff --}}
        @if($staffList->isNotEmpty())
            <div>
                <h3 class="text-2xl font-bold mb-6">Staff Sekolah</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($staffList as $staff)
                        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                            <figure class="px-6 pt-6">
                                @if($staff->foto_url)
                                    <div class="avatar">
                                        <div class="w-28 h-28 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                            <img src="{{ $staff->foto_url }}" alt="{{ $staff->nama }}">
                                        </div>
                                    </div>
                                @else
                                    <div class="avatar placeholder">
                                        <div class="w-28 h-28 rounded-full bg-neutral text-neutral-content ring ring-primary ring-offset-base-100 ring-offset-2">
                                            <span class="text-3xl font-bold">{{ substr($staff->nama, 0, 1) }}</span>
                                        </div>
                                    </div>
                                @endif
                            </figure>
                            <div class="card-body items-center text-center">
                                <h4 class="card-title text-lg">{{ $staff->nama }}</h4>
                                <p class="text-sm text-base-content/60">{{ $staff->jabatan }}</p>
                                @if($staff->email)
                                    <p class="text-sm">{{ $staff->email }}</p>
                                @endif
                                @if($staff->telepon)
                                    <p class="text-sm">{{ $staff->telepon }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Daftar Guru --}}
        <div>
            <h3 class="text-2xl font-bold mb-6">Guru</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($guruList as $guru)
                    <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                        <figure class="px-6 pt-6">
                            @if($guru->foto)
                                <div class="avatar">
                                    <div class="w-28 h-28 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                        <img src="{{ Storage::url($guru->foto) }}" alt="{{ $guru->name }}">
                                    </div>
                                </div>
                            @else
                                <div class="avatar placeholder">
                                    <div class="w-28 h-28 rounded-full bg-neutral text-neutral-content ring ring-primary ring-offset-base-100 ring-offset-2">
                                        <span class="text-3xl font-bold">{{ substr($guru->name, 0, 1) }}</span>
                                    </div>
                                </div>
                            @endif
                        </figure>
                        <div class="card-body items-center text-center">
                            <h4 class="card-title text-lg">{{ $guru->name }}</h4>
                            <p class="text-sm text-base-content/60">Guru</p>
                            @if($guru->email)
                                <p class="text-sm">{{ $guru->email }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $guruList->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
