@php
    $title = 'Profil Sekolah';
    $description = $profil ? strip_tags($profil->sejarah) : '';
@endphp

<x-public-layout>
    @if(!$profil)
        <section class="py-16 px-4">
            <div class="max-w-3xl mx-auto text-center">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body py-16">
                        <svg class="w-20 h-20 mx-auto text-base-content/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <h2 class="text-2xl font-bold">Profil Sekolah Belum Tersedia</h2>
                        <p class="text-base-content/60 mt-2">Silakan hubungi administrator untuk mengisi data sekolah.</p>
                    </div>
                </div>
            </div>
        </section>
    @else
        {{-- Header --}}
        <section class="hero-gradient text-white py-16">
            <div class="max-w-5xl mx-auto px-4 text-center">
                @if($profil->logo_url)
                    <img src="{{ $profil->logo_url }}" alt="Logo" class="w-24 h-24 object-contain mx-auto mb-4">
                @endif
                <h1 class="text-4xl md:text-5xl font-extrabold">{{ $profil->nama_sekolah }}</h1>
            </div>
        </section>

        {{-- Informasi Sekolah --}}
        <section class="py-12 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body p-8 md:p-12">
                        <h2 class="text-2xl md:text-3xl font-bold section-title">Informasi Sekolah</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 mt-1 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <div>
                                    <p class="text-sm text-base-content/60">Alamat</p>
                                    <p class="font-medium">{{ $profil->alamat }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 mt-1 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <div>
                                    <p class="text-sm text-base-content/60">Telepon</p>
                                    <p class="font-medium">{{ $profil->telepon }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 mt-1 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <div>
                                    <p class="text-sm text-base-content/60">Email</p>
                                    <p class="font-medium">{{ $profil->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 mt-1 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                <div>
                                    <p class="text-sm text-base-content/60">Website</p>
                                    @if($profil->website)
                                        <a href="{{ $profil->website }}" target="_blank" class="link link-primary font-medium">{{ $profil->website }}</a>
                                    @else
                                        <p class="font-medium">-</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Visi --}}
        <section class="py-12 px-4 bg-base-100">
            <div class="max-w-5xl mx-auto">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body p-8 md:p-12">
                        <h2 class="text-2xl md:text-3xl font-bold section-title">Visi</h2>
                        <ul class="list-disc list-inside space-y-3 mt-6 text-lg">
                            @foreach($visiList as $visi)
                                <li>{{ $visi }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Misi --}}
        <section class="py-12 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body p-8 md:p-12">
                        <h2 class="text-2xl md:text-3xl font-bold section-title">Misi</h2>
                        <ul class="list-disc list-inside space-y-3 mt-6 text-lg">
                            @foreach($misiList as $misi)
                                <li>{{ $misi }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Sejarah --}}
        <section class="py-12 px-4 bg-base-100">
            <div class="max-w-5xl mx-auto">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body p-8 md:p-12">
                        <h2 class="text-2xl md:text-3xl font-bold section-title">Sejarah</h2>
                        <p class="text-lg leading-relaxed mt-6 text-base-content/80">{{ $profil->sejarah }}</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Kepala Sekolah --}}
        <section class="py-12 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body p-8 md:p-12 text-center">
                        <h2 class="text-2xl md:text-3xl font-bold section-title inline-block">Kepala Sekolah</h2>
                        <div class="mt-8">
                            @if($profil->foto_kepala_sekolah_url)
                                <div class="avatar">
                                    <div class="w-44 h-44 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2 mx-auto">
                                        <img src="{{ $profil->foto_kepala_sekolah_url }}" alt="{{ $profil->kepala_sekolah }}">
                                    </div>
                                </div>
                            @else
                                <div class="avatar placeholder">
                                    <div class="w-44 h-44 rounded-full bg-primary text-primary-content mx-auto">
                                        <span class="text-5xl font-bold">{{ substr($profil->kepala_sekolah, 0, 1) }}</span>
                                    </div>
                                </div>
                            @endif
                            <h3 class="text-2xl font-bold mt-4">{{ $profil->kepala_sekolah }}</h3>
                            <p class="text-base-content/60 text-lg">Kepala Sekolah</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
</x-public-layout>
