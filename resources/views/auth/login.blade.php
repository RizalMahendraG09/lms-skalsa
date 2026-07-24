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
        <h2 class="text-xl font-bold text-base-content">Selamat Datang</h2>
        <p class="text-sm text-base-content/60 mt-1">Silakan masuk menggunakan akun Anda.</p>
    </div>

    {{-- Status --}}
    @if (session('status'))
        <div class="alert alert-success mb-4 shadow-sm text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    {{-- Error --}}
    @if (session('error'))
        <div class="alert alert-error mb-4 shadow-sm text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" x-data="{ loading: false }" @submit="loading = true">
        @csrf

        {{-- Email --}}
        <div class="form-control">
            <label class="label" for="email">
                <span class="label-text font-medium">Email</span>
            </label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/40 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                </span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="input input-bordered w-full pl-10 @error('email') input-error @enderror"
                    placeholder="Masukkan email" />
            </div>
            @error('email')
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
                <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
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

        {{-- Remember Me --}}
        <div class="form-control mt-4">
            <label class="label cursor-pointer justify-start gap-2">
                <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm" {{ old('remember') ? 'checked' : '' }} />
                <span class="label-text text-sm">Ingat saya</span>
            </label>
        </div>

        {{-- Forgot Password --}}
        @if (Route::has('password.request'))
            <div class="text-right mt-2">
                <a href="{{ route('password.request') }}" class="link link-primary text-sm font-medium">
                    Lupa password?
                </a>
            </div>
        @endif

        {{-- Submit --}}
        <div class="mt-6">
            <button type="submit" :disabled="loading" class="btn btn-primary w-full h-12 text-base font-semibold rounded-lg">
                <span x-show="!loading">Masuk</span>
                <span x-show="loading" x-cloak class="flex items-center gap-2">
                    <span class="loading loading-spinner loading-sm"></span>
                    Memproses...
                </span>
            </button>
        </div>

        {{-- Register Link --}}
        @if (Route::has('register'))
            <p class="text-center text-sm text-base-content/60 mt-5">
                Belum punya akun?
                <a href="{{ route('register') }}" class="link link-primary font-medium">Daftar</a>
            </p>
        @endif
    </form>
</x-guest-layout>
