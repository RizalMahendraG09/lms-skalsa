@php
    $profil = App\Models\SchoolProfile::first();
    $sekolah = $profil ? $profil->nama_sekolah : config('app.name', 'Skalsa LMS');
    $sejarah = $profil ? strip_tags($profil->sejarah) : '';
    $logo = $profil?->logo_url;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $sekolah) - {{ $sekolah }}</title>
    <meta name="description" content="@yield('description', Str::limit($sejarah, 160))">
    @if($logo)
        <link rel="icon" href="{{ $logo }}">
    @endif
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d5a87 50%, #1e3a5f 100%);
        }
        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: currentColor;
            margin-top: 0.5rem;
            border-radius: 2px;
        }
    </style>
</head>
<body class="font-sans antialiased bg-base-200">
    {{-- Navbar --}}
    <div class="navbar bg-base-100 shadow-lg sticky top-0 z-50">
        <div class="navbar-start">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost lg:hidden">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </label>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow-xl bg-base-100 rounded-box w-52">
                    <li><a href="{{ route('public.home') }}" class="{{ request()->routeIs('public.home') ? 'active' : '' }}">Beranda</a></li>
                    <li><a href="{{ route('public.profil-sekolah') }}" class="{{ request()->routeIs('public.profil-sekolah') ? 'active' : '' }}">Profil Sekolah</a></li>
                    <li><a href="{{ route('public.guru-staff') }}" class="{{ request()->routeIs('public.guru-staff') ? 'active' : '' }}">Guru & Staff</a></li>
                    <li><a href="{{ route('public.kontak') }}" class="{{ request()->routeIs('public.kontak') ? 'active' : '' }}">Kontak</a></li>
                </ul>
            </div>
            <a href="{{ route('public.home') }}" class="flex items-center gap-2">
                @if($logo)
                    <img src="{{ $logo }}" alt="Logo" class="w-8 h-8 object-contain">
                @endif
                <span class="font-bold text-lg hidden sm:inline">{{ $sekolah }}</span>
            </a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1 gap-1">
                <li><a href="{{ route('public.home') }}" class="{{ request()->routeIs('public.home') ? 'active font-semibold' : '' }}">Beranda</a></li>
                <li><a href="{{ route('public.profil-sekolah') }}" class="{{ request()->routeIs('public.profil-sekolah') ? 'active font-semibold' : '' }}">Profil Sekolah</a></li>
                <li><a href="{{ route('public.guru-staff') }}" class="{{ request()->routeIs('public.guru-staff') ? 'active font-semibold' : '' }}">Guru & Staff</a></li>
                <li><a href="{{ route('public.kontak') }}" class="{{ request()->routeIs('public.kontak') ? 'active font-semibold' : '' }}">Kontak</a></li>
            </ul>
        </div>
        <div class="navbar-end">
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                Login LMS
            </a>
        </div>
    </div>

    {{-- Main Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="footer footer-center bg-neutral text-neutral-content p-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-col items-center gap-2">
                @if($logo)
                    <img src="{{ $logo }}" alt="Logo" class="w-12 h-12 object-contain">
                @endif
                <h3 class="font-bold text-lg">{{ $sekolah }}</h3>
                @if($profil)
                    <p class="text-sm text-neutral-content/70">{{ $profil->alamat }}</p>
                    <p class="text-sm text-neutral-content/70">
                        {{ $profil->telepon }} @if($profil->email) | {{ $profil->email }} @endif
                    </p>
                @endif
            </div>
            <div class="divider divider-neutral"></div>
            <p class="text-sm text-neutral-content/60">
                Copyright by Rizal Mahendra
            </p>
        </div>
    </footer>
</body>
</html>
