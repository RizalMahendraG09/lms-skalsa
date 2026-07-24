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
        <h2 class="text-xl font-bold text-base-content">Lupa Password</h2>
        <p class="text-sm text-base-content/60 mt-1">Masukkan email Anda dan kami akan mengirimkan tautan untuk mengatur ulang password.</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-4 shadow-sm text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" x-data="{ loading: false }" @submit="loading = true">
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
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="input input-bordered w-full pl-10 @error('email') input-error @enderror"
                    placeholder="Masukkan email" />
            </div>
            @error('email')
                <div class="text-error text-xs mt-1.5 ml-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="mt-6">
            <button type="submit" :disabled="loading" class="btn btn-primary w-full h-12 text-base font-semibold rounded-lg">
                <span x-show="!loading" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" /></svg>
                    Kirim Tautan Reset
                </span>
                <span x-show="loading" x-cloak class="flex items-center gap-2">
                    <span class="loading loading-spinner loading-sm"></span>
                    Mengirim...
                </span>
            </button>
        </div>

        {{-- Back to Login --}}
        <div class="text-center mt-5">
            <a href="{{ route('login') }}" class="link link-primary text-sm font-medium inline-flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                Kembali ke login
            </a>
        </div>
    </form>
</x-guest-layout>
