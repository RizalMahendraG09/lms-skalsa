@php
    $profil = App\Models\SchoolProfile::first();
    $logo = $profil?->logo_url;
@endphp
<x-guest-layout>

    {{-- Header --}}
    <div class="text-center mb-6">
        @if($logo)
            <div class="w-16 h-16 mx-auto rounded-full bg-info/15 flex items-center justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-info" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
            </div>
        @else
            <div class="w-16 h-16 mx-auto rounded-xl bg-primary flex items-center justify-center mb-3 shadow-lg">
                <span class="text-primary-content font-bold text-xl">SL</span>
            </div>
        @endif
        <h2 class="text-xl font-bold text-base-content">Verifikasi Email</h2>
        <p class="text-sm text-base-content/60 mt-1 leading-relaxed">
            Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang kami kirimkan. Jika Anda tidak menerima email, kami dengan senang hati akan mengirimkan yang baru.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-4 shadow-sm text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.</span>
        </div>
    @endif

    <div class="flex flex-col gap-3 mt-6">
        {{-- Resend --}}
        <form method="POST" action="{{ route('verification.send') }}" x-data="{ loading: false }" @submit="loading = true">
            @csrf
            <button type="submit" :disabled="loading" class="btn btn-primary w-full h-12 text-base font-semibold rounded-lg">
                <span x-show="!loading" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" /></svg>
                    Kirim Ulang Email Verifikasi
                </span>
                <span x-show="loading" x-cloak class="flex items-center gap-2">
                    <span class="loading loading-spinner loading-sm"></span>
                    Mengirim...
                </span>
            </button>
        </form>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}" x-data="{ loading: false }" @submit="loading = true">
            @csrf
            <button type="submit" :disabled="loading" class="btn btn-ghost w-full h-12 text-base font-medium rounded-lg">
                <span x-show="!loading" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
                    Keluar
                </span>
                <span x-show="loading" x-cloak class="flex items-center gap-2">
                    <span class="loading loading-spinner loading-sm"></span>
                    ...
                </span>
            </button>
        </form>
    </div>
</x-guest-layout>
