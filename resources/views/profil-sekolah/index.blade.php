@php
    $title = 'Profil Sekolah';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Profil Sekolah') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto space-y-8">
        {{-- Section 1: Informasi Sekolah --}}
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h3 class="card-title text-2xl mb-4">Informasi Sekolah</h3>
                <div class="flex flex-col md:flex-row items-start gap-8">
                    @if($profil->logo_url)
                        <div class="flex-shrink-0">
                            <img src="{{ $profil->logo_url }}" alt="Logo {{ $profil->nama_sekolah }}"
                                class="w-32 h-32 object-contain rounded-xl bg-base-200 p-2">
                        </div>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-1">
                        <div>
                            <p class="text-sm text-base-content/60">Nama Sekolah</p>
                            <p class="font-semibold">{{ $profil->nama_sekolah }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-base-content/60">Email</p>
                            <p class="font-semibold">{{ $profil->email }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-base-content/60">Alamat</p>
                            <p class="font-semibold">{{ $profil->alamat }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-base-content/60">Telepon</p>
                            <p class="font-semibold">{{ $profil->telepon }}</p>
                        </div>
                        @if($profil->website)
                            <div>
                                <p class="text-sm text-base-content/60">Website</p>
                                <p class="font-semibold">
                                    <a href="{{ $profil->website }}" target="_blank" class="link link-primary">{{ $profil->website }}</a>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 2: Visi --}}
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h3 class="card-title text-2xl mb-4">Visi</h3>
                <ul class="list-disc list-inside space-y-2">
                    @foreach($visiList as $visi)
                        <li>{{ $visi }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Section 3: Misi --}}
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h3 class="card-title text-2xl mb-4">Misi</h3>
                <ul class="list-disc list-inside space-y-2">
                    @foreach($misiList as $misi)
                        <li>{{ $misi }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Section 4: Sejarah --}}
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h3 class="card-title text-2xl mb-4">Sejarah Sekolah</h3>
                <div class="prose max-w-none">
                    <p>{{ $profil->sejarah }}</p>
                </div>
            </div>
        </div>

        {{-- Section 5: Kepala Sekolah --}}
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h3 class="card-title text-2xl mb-4">Kepala Sekolah</h3>
                <div class="flex flex-col items-center text-center gap-4 p-4">
                    @if($profil->foto_kepala_sekolah_url)
                        <div class="avatar">
                            <div class="w-40 h-40 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="{{ $profil->foto_kepala_sekolah_url }}" alt="{{ $profil->kepala_sekolah }}">
                            </div>
                        </div>
                    @else
                        <div class="avatar placeholder">
                            <div class="w-40 h-40 rounded-full bg-primary text-primary-content ring ring-primary ring-offset-base-100 ring-offset-2">
                                <span class="text-5xl font-bold">{{ substr($profil->kepala_sekolah, 0, 1) }}</span>
                            </div>
                        </div>
                    @endif
                    <div>
                        <p class="text-xl font-bold">{{ $profil->kepala_sekolah }}</p>
                        <p class="text-base-content/60">Kepala Sekolah</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
