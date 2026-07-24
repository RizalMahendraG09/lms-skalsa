@php
    $profil = App\Models\SchoolProfile::first();
    $logo = $profil?->logo_url;
@endphp
<x-guest-layout>

    {{-- Header --}}
    <div class="text-center mb-6">
        @if($logo)
            <img src="{{ $logo }}" alt="Logo" class="w-14 h-14 mx-auto object-contain rounded-xl mb-3 shadow-md">
        @else
            <div class="w-14 h-14 mx-auto rounded-xl bg-primary flex items-center justify-center mb-3 shadow-lg">
                <span class="text-primary-content font-bold text-xl">SL</span>
            </div>
        @endif
        <h2 class="text-xl font-bold text-base-content">Buat Akun Baru</h2>
        <p class="text-sm text-base-content/60 mt-1">Silakan isi data diri Anda untuk mendaftar.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" x-data="{ loading: false }" @submit="loading = true">
        @csrf

        {{-- Name --}}
        <div class="form-control">
            <label class="label" for="name">
                <span class="label-text font-medium">Nama Lengkap</span>
            </label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/40 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                </span>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="input input-bordered w-full pl-10 @error('name') input-error @enderror"
                    placeholder="Masukkan nama lengkap" />
            </div>
            @error('name')
                <div class="text-error text-xs mt-1.5 ml-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="form-control mt-4">
            <label class="label" for="email">
                <span class="label-text font-medium">Email</span>
            </label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/40 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                </span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    class="input input-bordered w-full pl-10 @error('email') input-error @enderror"
                    placeholder="Masukkan email" />
            </div>
            @error('email')
                <div class="text-error text-xs mt-1.5 ml-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- NIS --}}
        <div class="form-control mt-4">
            <label class="label" for="nis">
                <span class="label-text font-medium">NIS <span class="text-base-content/40 font-normal">(untuk siswa)</span></span>
            </label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/40 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 00-.491 6.347A48.62 48.62 0 0112 20.904a48.62 48.62 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.636 50.636 0 00-2.658-.813A59.906 59.906 0 0112 3.493a59.903 59.903 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" /></svg>
                </span>
                <input id="nis" type="text" name="nis" value="{{ old('nis') }}"
                    class="input input-bordered w-full pl-10 @error('nis') input-error @enderror"
                    placeholder="Masukkan NIS" />
            </div>
            @error('nis')
                <div class="text-error text-xs mt-1.5 ml-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-control mt-4">
            <label class="label" for="password">
                <span class="label-text font-medium">Password</span>
            </label>
            <div class="relative" x-data="{ show: false }">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/40 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                </span>
                <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="new-password"
                    class="input input-bordered w-full pl-10 pr-10 @error('password') input-error @enderror"
                    placeholder="Masukkan password" />
                <button type="button" @click="show = !show"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-base-content/40 hover:text-base-content/70 transition-colors duration-200"
                    tabindex="-1">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>
                </button>
            </div>
            @error('password')
                <div class="text-error text-xs mt-1.5 ml-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="form-control mt-4">
            <label class="label" for="password_confirmation">
                <span class="label-text font-medium">Konfirmasi Password</span>
            </label>
            <div class="relative" x-data="{ show: false }">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/40 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                </span>
                <input id="password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password"
                    class="input input-bordered w-full pl-10 pr-10"
                    placeholder="Ulangi password" />
                <button type="button" @click="show = !show"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-base-content/40 hover:text-base-content/70 transition-colors duration-200"
                    tabindex="-1">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>
                </button>
            </div>
            @error('password_confirmation')
                <div class="text-error text-xs mt-1.5 ml-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="mt-6">
            <button type="submit" :disabled="loading" class="btn btn-primary w-full h-12 text-base font-semibold rounded-lg">
                <span x-show="!loading">Daftar</span>
                <span x-show="loading" x-cloak class="flex items-center gap-2">
                    <span class="loading loading-spinner loading-sm"></span>
                    Memproses...
                </span>
            </button>
        </div>

        {{-- Login Link --}}
        <p class="text-center text-sm text-base-content/60 mt-5">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="link link-primary font-medium">Masuk</a>
        </p>
    </form>
</x-guest-layout>
