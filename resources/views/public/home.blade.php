@php
    $title = 'Beranda';
    $sekolahName = $profil?->nama_sekolah ?? config('app.name');
    $sejarahDesc = $profil ? strip_tags($profil->sejarah) : '';
    $description = Str::limit($sejarahDesc, 160);
@endphp

<x-public-layout>
    {{-- HERO SECTION --}}
    <section class="hero-gradient text-white">
        <div class="hero min-h-[70vh]">
            <div class="hero-content text-center flex-col gap-6">
                @if($profil?->logo_url)
                    <img src="{{ $profil->logo_url }}" alt="Logo {{ $sekolahName }}" class="w-28 h-28 object-contain drop-shadow-lg">
                @else
                    <div class="w-28 h-28 rounded-2xl bg-white/10 flex items-center justify-center">
                        <span class="text-5xl font-bold">{{ substr($sekolahName, 0, 1) }}</span>
                    </div>
                @endif
                <div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold">{{ $sekolahName }}</h1>
                    @if($profil?->alamat)
                        <p class="text-lg md:text-xl text-white/80 mt-3 max-w-2xl">{{ $profil->alamat }}</p>
                    @endif
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('public.profil-sekolah') }}" class="btn btn-lg btn-outline text-white border-white hover:bg-white hover:text-primary">
                        Profil Sekolah
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-lg btn-accent text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        Login LMS
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- TENTANG SEKOLAH --}}
    @if($profil?->sejarah)
        <section class="py-16 md:py-20 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body p-8 md:p-12">
                        <h2 class="text-3xl md:text-4xl font-bold section-title">Tentang {{ $sekolahName }}</h2>
                        <p class="text-base-content/80 text-lg leading-relaxed mt-6">
                            {{ $sejarahRingkas }}
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('public.profil-sekolah') }}" class="btn btn-primary">
                                Baca Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- VISI SEKOLAH --}}
    @if($profil?->visi)
        @php
            $visiList = array_filter(array_map('trim', explode("\n", $profil->visi)));
        @endphp
        <section class="py-16 md:py-20 px-4 bg-base-100">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold section-title inline-block">Visi</h2>
                <div class="mt-8">
                    @foreach($visiList as $visi)
                        <div class="alert shadow-lg mb-3 bg-base-200 border-0">
                            <svg class="w-6 h-6 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <span class="text-left">{{ $visi }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- KEPALA SEKOLAH --}}
    @if($profil?->kepala_sekolah)
        <section class="py-16 md:py-20 px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold section-title inline-block">Kepala Sekolah</h2>
                <div class="mt-8">
                    <div class="card bg-base-100 shadow-xl max-w-md mx-auto">
                        <div class="card-body items-center p-8">
                            @if($profil->foto_kepala_sekolah_url)
                                <div class="avatar">
                                    <div class="w-40 h-40 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                        <img src="{{ $profil->foto_kepala_sekolah_url }}" alt="{{ $profil->kepala_sekolah }}">
                                    </div>
                                </div>
                            @else
                                <div class="avatar placeholder">
                                    <div class="w-40 h-40 rounded-full bg-primary text-primary-content">
                                        <span class="text-5xl font-bold">{{ substr($profil->kepala_sekolah, 0, 1) }}</span>
                                    </div>
                                </div>
                            @endif
                            <h3 class="text-2xl font-bold mt-4">{{ $profil->kepala_sekolah }}</h3>
                            <p class="text-base-content/60">Kepala Sekolah</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- PENGUMUMAN TERBARU --}}
    @if($pengumumanList->isNotEmpty())
        <section class="py-16 md:py-20 px-4 bg-base-100">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold section-title inline-block text-center w-full">Pengumuman Terbaru</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                    @foreach($pengumumanList as $pengumuman)
                        <a href="{{ route('pengumuman.show', $pengumuman->slug) }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-200 hover:-translate-y-1">
                            @if($pengumuman->thumbnail_url)
                                <figure>
                                    <img src="{{ $pengumuman->thumbnail_url }}" alt="{{ $pengumuman->judul }}" class="w-full h-44 object-cover">
                                </figure>
                            @else
                                <figure class="bg-base-200 h-44 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-base-content/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
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
                <div class="text-center mt-8">
                    <a href="{{ route('pengumuman.index') }}" class="btn btn-primary btn-lg">
                        Lihat Semua Pengumuman
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- GALERI TERBARU --}}
    @if($galeriList->isNotEmpty())
        <section class="py-16 md:py-20 px-4">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold section-title inline-block text-center w-full">Galeri Terbaru</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-8">
                    @foreach($galeriList as $gallery)
                        <div class="card bg-base-100 shadow-xl cursor-pointer" onclick="openLightbox('{{ $gallery->foto_url }}', '{{ $gallery->judul }}', '{{ $gallery->deskripsi }}')">
                            <figure class="h-40">
                                <img src="{{ $gallery->foto_url }}" alt="{{ $gallery->judul }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            </figure>
                            @if($gallery->kategori)
                                <div class="p-2 text-center">
                                    <span class="badge badge-ghost badge-sm">{{ $gallery->kategori }}</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-8">
                    <a href="{{ route('galeri.index') }}" class="btn btn-primary btn-lg">
                        Lihat Semua Galeri
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- GURU & STAFF --}}
    @if($guruList->isNotEmpty() || $staffList->isNotEmpty())
        <section class="py-16 md:py-20 px-4 bg-base-100">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold section-title inline-block text-center w-full">Guru & Staff</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
                    @foreach($staffList as $staff)
                        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                            <figure class="px-6 pt-6">
                                @if($staff->foto_url)
                                    <div class="avatar"><div class="w-24 h-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2"><img src="{{ $staff->foto_url }}" alt="{{ $staff->nama }}"></div></div>
                                @else
                                    <div class="avatar placeholder"><div class="w-24 h-24 rounded-full bg-neutral text-neutral-content"><span class="text-3xl font-bold">{{ substr($staff->nama, 0, 1) }}</span></div></div>
                                @endif
                            </figure>
                            <div class="card-body items-center text-center p-4">
                                <h4 class="font-bold">{{ $staff->nama }}</h4>
                                <p class="text-sm text-base-content/60">{{ $staff->jabatan }}</p>
                            </div>
                        </div>
                    @endforeach
                    @foreach($guruList as $guru)
                        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                            <figure class="px-6 pt-6">
                                @if($guru->foto)
                                    <div class="avatar"><div class="w-24 h-24 rounded-full ring ring-secondary ring-offset-base-100 ring-offset-2"><img src="{{ Storage::url($guru->foto) }}" alt="{{ $guru->name }}"></div></div>
                                @else
                                    <div class="avatar placeholder"><div class="w-24 h-24 rounded-full bg-neutral text-neutral-content"><span class="text-3xl font-bold">{{ substr($guru->name, 0, 1) }}</span></div></div>
                                @endif
                            </figure>
                            <div class="card-body items-center text-center p-4">
                                <h4 class="font-bold">{{ $guru->name }}</h4>
                                <p class="text-sm text-base-content/60">Guru</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-8">
                    <a href="{{ route('public.guru-staff') }}" class="btn btn-primary btn-lg">
                        Lihat Semua
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- STATISTIK SEKOLAH --}}
    <section class="py-16 md:py-20 px-4">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold section-title inline-block text-center w-full">Statistik Sekolah</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="stat bg-base-200 shadow rounded-box p-6 text-center">
                    <div class="stat-figure text-primary mx-auto mb-2">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div class="stat-title text-lg">Tenaga Pengajar</div>
                    <div class="stat-value text-primary">{{ $totalGuru }}</div>
                    <div class="stat-desc">Guru profesional</div>
                </div>
                <div class="stat bg-base-200 shadow rounded-box p-6 text-center">
                    <div class="stat-figure text-secondary mx-auto mb-2">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <div class="stat-title text-lg">Siswa</div>
                    <div class="stat-value text-secondary">{{ $totalSiswa }}</div>
                    <div class="stat-desc">Siswa aktif</div>
                </div>
                <div class="stat bg-base-200 shadow rounded-box p-6 text-center">
                    <div class="stat-figure text-accent mx-auto mb-2">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div class="stat-title text-lg">Mata Pelajaran</div>
                    <div class="stat-value text-accent">{{ $totalMapel }}</div>
                    <div class="stat-desc">Mata pelajaran</div>
                </div>
            </div>
        </div>
    </section>

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