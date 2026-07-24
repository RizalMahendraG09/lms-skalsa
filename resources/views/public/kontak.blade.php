@php
    $title = 'Kontak';
@endphp

<x-public-layout>
    <section class="hero-gradient text-white py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold">Kontak</h1>
            <p class="text-lg text-white/80 mt-3">Hubungi kami untuk informasi lebih lanjut</p>
        </div>
    </section>

    <section class="py-12 px-4">
        <div class="max-w-4xl mx-auto">
            @if(!$profil)
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body py-16 text-center">
                        <svg class="w-20 h-20 mx-auto text-base-content/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <h2 class="text-2xl font-bold">Informasi Kontak Belum Tersedia</h2>
                        <p class="text-base-content/60 mt-2">Silakan hubungi administrator untuk mengisi data sekolah.</p>
                    </div>
                </div>
            @else
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body p-8 md:p-12">
                        <h2 class="text-2xl md:text-3xl font-bold section-title">Informasi Kontak</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                            <div class="flex items-start gap-4 p-4 bg-base-200 rounded-xl">
                                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm text-base-content/60">Nama Sekolah</p>
                                    <p class="font-semibold text-lg">{{ $profil->nama_sekolah }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 p-4 bg-base-200 rounded-xl">
                                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm text-base-content/60">Alamat</p>
                                    <p class="font-semibold">{{ $profil->alamat }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 p-4 bg-base-200 rounded-xl">
                                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm text-base-content/60">Telepon</p>
                                    <p class="font-semibold">{{ $profil->telepon }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 p-4 bg-base-200 rounded-xl">
                                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm text-base-content/60">Email</p>
                                    <p class="font-semibold">{{ $profil->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 p-4 bg-base-200 rounded-xl md:col-span-2">
                                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm text-base-content/60">Website</p>
                                    @if($profil->website)
                                        <a href="{{ $profil->website }}" target="_blank" class="link link-primary font-semibold">{{ $profil->website }}</a>
                                    @else
                                        <p class="font-semibold">-</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            
            @endif
        </div>
    </section>
</x-public-layout>
