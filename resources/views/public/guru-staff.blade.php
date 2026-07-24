@php
    $title = 'Guru & Staff';
@endphp

<x-public-layout>
    <section class="hero-gradient text-white py-16">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold">Guru & Staff</h1>
            <p class="text-lg text-white/80 mt-3">Tenaga pendidik dan kependidikan {{ $profil?->nama_sekolah ?? config('app.name') }}</p>
        </div>
    </section>

    <section class="py-12 px-4">
        <div class="max-w-6xl mx-auto">
            @if($staffList->isNotEmpty())
                <h2 class="text-2xl md:text-3xl font-bold section-title mb-8">Staff Sekolah</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
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
            @endif

            <h2 class="text-2xl md:text-3xl font-bold section-title mb-8">Guru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($guruList as $guru)
                    <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                        <figure class="px-6 pt-6">
                            @if($guru->foto)
                                <div class="avatar">
                                    <div class="w-28 h-28 rounded-full ring ring-secondary ring-offset-base-100 ring-offset-2">
                                        <img src="{{ Storage::url($guru->foto) }}" alt="{{ $guru->name }}">
                                    </div>
                                </div>
                            @else
                                <div class="avatar placeholder">
                                    <div class="w-28 h-28 rounded-full bg-neutral text-neutral-content ring ring-secondary ring-offset-base-100 ring-offset-2">
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

            @if($guruList->hasPages())
                <div class="mt-8 flex justify-center">
                    {{ $guruList->links() }}
                </div>
            @endif
        </div>
    </section>
</x-public-layout>
