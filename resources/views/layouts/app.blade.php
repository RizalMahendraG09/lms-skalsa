<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeHandler" :data-theme="theme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Skalsa LMS') }} - @yield('title', 'Dashboard')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="drawer lg:drawer-open">
        <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            @include('layouts.navigation')
            <main class="flex-1 p-4 sm:p-6 lg:p-8 bg-base-200 min-h-[calc(100vh-4rem)]">
                @isset($header)
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-base-content">{{ $header }}</h1>
                    </div>
                @endisset

                @if (session('success'))
                    <div class="alert alert-success mb-6 shadow-lg">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error mb-6 shadow-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
        <div class="drawer-side z-40">
            <label for="sidebar-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <aside class="bg-neutral text-neutral-content min-h-full w-72 p-4 flex flex-col gap-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-2 pt-2 pb-4 border-b border-base-content/10">
                    <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center shadow-lg">
                        <span class="text-primary-content font-bold text-lg">SL</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-lg leading-tight">Skalsa LMS</span>
                        <span class="text-xs text-neutral-content/60">Learning Management</span>
                    </div>
                </a>

                @auth
                    @if(Auth::user()->isAdmin())
                        <nav class="flex-1 flex flex-col gap-1 overflow-y-auto">
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-2 mb-1">Menu Utama</p>
                            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                Dashboard
                            </a>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-4 mb-1">Manajemen</p>
                            <a href="{{ route('admin.kelas.index') }}" class="sidebar-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                Kelas
                            </a>
                            <a href="{{ route('admin.guru.index') }}" class="sidebar-link {{ request()->routeIs('admin.guru.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                Guru
                            </a>
                            <a href="{{ route('admin.siswa.index') }}" class="sidebar-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                Siswa
                            </a>
                            <a href="{{ route('admin.mata-pelajaran.index') }}" class="sidebar-link {{ request()->routeIs('admin.mata-pelajaran.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                Mata Pelajaran
                            </a>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-4 mb-1">Konten</p>
                            <a href="{{ route('admin.materi.index') }}" class="sidebar-link {{ request()->routeIs('admin.materi.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Materi
                            </a>
                            <a href="{{ route('admin.tugas.index') }}" class="sidebar-link {{ request()->routeIs('admin.tugas.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                Tugas
                            </a>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-4 mb-1">Tabungan</p>
                            <a href="{{ route('admin.tabungan.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.tabungan.dashboard') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                Dashboard Tabungan
                            </a>
                            <a href="{{ route('admin.tabungan.index') }}" class="sidebar-link {{ request()->routeIs('admin.tabungan.index') || request()->routeIs('admin.tabungan.show') || request()->routeIs('admin.tabungan.setor') || request()->routeIs('admin.tabungan.tarik') || request()->routeIs('admin.tabungan.transaksi.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                Data Tabungan
                            </a>
                            <a href="{{ route('admin.tabungan.laporan') }}" class="sidebar-link {{ request()->routeIs('admin.tabungan.laporan') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Laporan
                            </a>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-4 mb-1">Pengumuman</p>
                            <a href="{{ route('admin.pengumuman.index') }}" class="sidebar-link {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                                Pengumuman
                            </a>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-4 mb-1">Galeri</p>
                            <a href="{{ route('admin.gallery.index') }}" class="sidebar-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Galeri
                            </a>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-4 mb-1">Sekolah</p>
                            <a href="{{ route('admin.profil-sekolah.index') }}" class="sidebar-link {{ request()->routeIs('admin.profil-sekolah.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                Profil Sekolah
                            </a>
                            <a href="{{ route('admin.staff.index') }}" class="sidebar-link {{ request()->routeIs('admin.staff.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                Staff
                            </a>
                            <a href="{{ route('public.profil-sekolah') }}" class="sidebar-link {{ request()->routeIs('public.profil-sekolah') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11a3 3 0 10-4 2.829M12 14v3"/></svg>
                                Lihat Profil Sekolah
                            </a>
                        </nav>
                    @elseif(Auth::user()->isGuru())
                        <nav class="flex-1 flex flex-col gap-1 overflow-y-auto">
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-2 mb-1">Menu Utama</p>
                            <a href="{{ route('guru.dashboard') }}" class="sidebar-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                Dashboard
                            </a>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-4 mb-1">Konten</p>
                            <a href="{{ route('guru.materi.index') }}" class="sidebar-link {{ request()->routeIs('guru.materi.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Materi
                            </a>
                            <a href="{{ route('guru.tugas.index') }}" class="sidebar-link {{ request()->routeIs('guru.tugas.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                Tugas
                            </a>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-4 mb-1">Absensi</p>
                            <a href="{{ route('guru.sesi-absensi.index') }}" class="sidebar-link {{ request()->routeIs('guru.sesi-absensi.*') && !request()->routeIs('guru.sesi-absensi.rekap') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Sesi Absensi
                            </a>
                            <a href="{{ route('guru.sesi-absensi.rekap') }}" class="sidebar-link {{ request()->routeIs('guru.sesi-absensi.rekap') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Rekap Absensi
                            </a>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-4 mb-1">Penilaian</p>
                            <a href="{{ route('guru.rekap-nilai.index') }}" class="sidebar-link {{ request()->routeIs('guru.rekap-nilai.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Rekap Nilai
                            </a>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-4 mb-1">Pengumuman</p>
                            <a href="{{ route('pengumuman.index') }}" class="sidebar-link {{ request()->routeIs('pengumuman.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                                Pengumuman
                            </a>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-4 mb-1">Sekolah</p>
                            <a href="{{ route('public.profil-sekolah') }}" class="sidebar-link {{ request()->routeIs('public.profil-sekolah') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                Profil Sekolah
                            </a>
                            <a href="{{ route('public.guru-staff') }}" class="sidebar-link {{ request()->routeIs('public.guru-staff') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                Guru & Staff
                            </a>
                            <a href="{{ route('galeri.index') }}" class="sidebar-link {{ request()->routeIs('galeri.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Galeri
                            </a>
                        </nav>
                    @elseif(Auth::user()->isSiswa())
                        <nav class="flex-1 flex flex-col gap-1 overflow-y-auto">
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-2 mb-1">Menu Utama</p>
                            <a href="{{ route('siswa.dashboard') }}" class="sidebar-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                Dashboard
                            </a>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-4 mb-1">Belajar</p>
                            <a href="{{ route('siswa.materi.index') }}" class="sidebar-link {{ request()->routeIs('siswa.materi.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                Materi
                            </a>
                            <a href="{{ route('siswa.tugas.index') }}" class="sidebar-link {{ request()->routeIs('siswa.tugas.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                Tugas
                            </a>
                            <a href="{{ route('siswa.absensi.index') }}" class="sidebar-link {{ request()->routeIs('siswa.absensi.*') && !request()->routeIs('siswa.absensi.rekap') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Absensi
                            </a>
                            <a href="{{ route('siswa.absensi.rekap') }}" class="sidebar-link {{ request()->routeIs('siswa.absensi.rekap') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Rekap Absensi
                            </a>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-4 mb-1">Nilai</p>
                            <a href="{{ route('siswa.rekap-nilai.index') }}" class="sidebar-link {{ request()->routeIs('siswa.rekap-nilai.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Rekap Nilai
                            </a>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-4 mb-1">Pengumuman</p>
                            <a href="{{ route('pengumuman.index') }}" class="sidebar-link {{ request()->routeIs('pengumuman.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                                Pengumuman
                            </a>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-content/40 px-4 mt-4 mb-1">Sekolah</p>
                            <a href="{{ route('public.profil-sekolah') }}" class="sidebar-link {{ request()->routeIs('public.profil-sekolah') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                Profil Sekolah
                            </a>
                            <a href="{{ route('public.guru-staff') }}" class="sidebar-link {{ request()->routeIs('public.guru-staff') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                Guru & Staff
                            </a>
                            <a href="{{ route('galeri.index') }}" class="sidebar-link {{ request()->routeIs('galeri.*') ? 'active' : '' }} text-neutral-content/70 hover:text-neutral-content">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Galeri
                            </a>
                        </nav>
                    @endif
                @endauth

                <div class="border-t border-base-content/10 pt-4 mt-auto">
                    <div class="flex items-center gap-3 px-2">
                        <div class="avatar placeholder">
                            <div class="w-9 h-9 rounded-full bg-primary/20 text-primary-content flex items-center justify-center">
                                <span class="text-sm font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium truncate max-w-[160px]">{{ Auth::user()->name }}</span>
                            <span class="text-xs text-neutral-content/50 capitalize">{{ Auth::user()->role }}</span>
                        </div>
                    </div>
                </div>
                <p class="text-xs text-neutral-content/40 text-center pb-2">Copyright by Rizal Mahendra</p>
            </aside>
        </div>
    </div>
</body>
</html>
