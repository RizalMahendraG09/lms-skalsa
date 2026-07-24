@php
    $profil = App\Models\SchoolProfile::first();
    $sekolah = $profil ? $profil->nama_sekolah : config('app.name', 'Skalsa LMS');
    $logo = $profil?->logo_url;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeHandler" :data-theme="theme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $sekolah }} - Login</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    @if($logo)
        <link rel="icon" href="{{ $logo }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .login-left-panel {
            background: linear-gradient(135deg, #1e3a5f 0%, #1e40af 40%, #2563eb 70%, #0ea5e9 100%);
            position: relative;
            overflow: hidden;
        }
        .login-left-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -30%;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }
        .login-left-panel::after {
            content: '';
            position: absolute;
            bottom: -40%;
            left: -20%;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.03);
        }
        .geometric-dots {
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen">
    <div class="flex min-h-screen">
        {{-- Left Panel: Branding --}}
        <div class="hidden lg:flex lg:w-[45%] login-left-panel geometric-dots relative flex-col items-center justify-center p-10 xl:p-14">
            <div class="relative z-10 text-center text-white max-w-md mx-auto">
                {{-- Logo --}}
                <div class="mb-8">
                    @if($logo)
                        <img src="{{ $logo }}" alt="{{ $sekolah }}" class="w-24 h-24 mx-auto object-contain rounded-2xl bg-white/10 backdrop-blur-sm p-3 shadow-xl">
                    @else
                        <div class="w-24 h-24 mx-auto rounded-2xl bg-white/15 backdrop-blur-sm flex items-center justify-center shadow-xl border border-white/20">
                            <span class="text-white font-bold text-4xl">SL</span>
                        </div>
                    @endif
                </div>

                {{-- School Name --}}
                <h1 class="text-2xl xl:text-3xl font-bold mb-2 tracking-tight">{{ $sekolah }}</h1>
                <div class="w-16 h-1 bg-sky-400 rounded-full mx-auto mb-6"></div>

                {{-- Title --}}
                <h2 class="text-xl xl:text-2xl font-semibold mb-4 text-white/95">Learning Management System</h2>

                {{-- Description --}}
                <p class="text-sm xl:text-base leading-relaxed text-white/75 max-w-sm mx-auto">
                    Platform pembelajaran digital yang memudahkan proses belajar mengajar, pengelolaan tugas, absensi, nilai, dan administrasi sekolah.
                </p>

                {{-- Illustration --}}
                <div class="mt-10">
                    <svg viewBox="0 0 400 220" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full max-w-sm mx-auto opacity-90">
                        {{-- Book --}}
                        <rect x="60" y="80" width="120" height="100" rx="8" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.3)" stroke-width="1.5"/>
                        <rect x="68" y="88" width="104" height="84" rx="4" fill="rgba(255,255,255,0.08)"/>
                        <line x1="120" y1="80" x2="120" y2="180" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"/>
                        <rect x="78" y="98" width="32" height="4" rx="2" fill="rgba(255,255,255,0.25)"/>
                        <rect x="78" y="108" width="24" height="3" rx="1.5" fill="rgba(255,255,255,0.15)"/>
                        <rect x="78" y="116" width="28" height="3" rx="1.5" fill="rgba(255,255,255,0.15)"/>
                        <rect x="130" y="98" width="32" height="4" rx="2" fill="rgba(255,255,255,0.25)"/>
                        <rect x="130" y="108" width="24" height="3" rx="1.5" fill="rgba(255,255,255,0.15)"/>
                        <rect x="130" y="116" width="28" height="3" rx="1.5" fill="rgba(255,255,255,0.15)"/>
                        {{-- Graduation cap --}}
                        <polygon points="280,60 340,90 280,120 220,90" fill="rgba(255,255,255,0.2)" stroke="rgba(255,255,255,0.35)" stroke-width="1.5"/>
                        <polygon points="280,95 340,90 340,100 280,105 220,100 220,90" fill="rgba(255,255,255,0.12)"/>
                        <line x1="340" y1="90" x2="340" y2="130" stroke="rgba(255,255,255,0.25)" stroke-width="1.5"/>
                        <circle cx="340" cy="133" r="4" fill="rgba(255,255,255,0.3)"/>
                        <line x1="280" y1="120" x2="280" y2="145" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"/>
                        <polygon points="268,145 280,155 292,145" fill="rgba(255,255,255,0.25)"/>
                        {{-- Laptop --}}
                        <rect x="160" y="145" width="120" height="75" rx="6" fill="rgba(255,255,255,0.12)" stroke="rgba(255,255,255,0.25)" stroke-width="1.5"/>
                        <rect x="167" y="152" width="106" height="55" rx="3" fill="rgba(255,255,255,0.06)"/>
                        <rect x="145" y="220" width="150" height="6" rx="3" fill="rgba(255,255,255,0.15)"/>
                        {{-- Screen content --}}
                        <rect x="177" y="162" width="40" height="4" rx="2" fill="rgba(14,165,233,0.5)"/>
                        <rect x="177" y="170" width="72" height="3" rx="1.5" fill="rgba(255,255,255,0.12)"/>
                        <rect x="177" y="177" width="60" height="3" rx="1.5" fill="rgba(255,255,255,0.1)"/>
                        <rect x="177" y="184" width="66" height="3" rx="1.5" fill="rgba(255,255,255,0.1)"/>
                        <rect x="177" y="191" width="36" height="8" rx="2" fill="rgba(14,165,233,0.35)"/>
                        {{-- Floating elements --}}
                        <circle cx="80" cy="55" r="6" fill="rgba(251,191,36,0.4)"/>
                        <circle cx="360" cy="55" r="4" fill="rgba(52,211,153,0.4)"/>
                        <circle cx="200" cy="40" r="3" fill="rgba(255,255,255,0.3)"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Right Panel: Form --}}
        <div class="flex-1 flex items-center justify-center p-4 sm:p-6 lg:p-8 bg-base-200">
            <div class="w-full max-w-md login-fade-in">
                {{-- Mobile Logo --}}
                <div class="lg:hidden text-center mb-6">
                    <a href="/" class="inline-flex items-center gap-3">
                        @if($logo)
                            <img src="{{ $logo }}" alt="{{ $sekolah }}" class="w-12 h-12 object-contain rounded-xl bg-base-100 shadow-md p-1">
                        @else
                            <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center shadow-lg">
                                <span class="text-primary-content font-bold text-xl">SL</span>
                            </div>
                        @endif
                        <div class="flex flex-col text-left">
                            <span class="font-bold text-lg leading-tight text-base-content">{{ $sekolah }}</span>
                            <span class="text-xs text-base-content/60">Learning Management</span>
                        </div>
                    </a>
                </div>

                {{-- Card --}}
                <div class="card bg-base-100 shadow-2xl">
                    <div class="card-body p-6 sm:p-8">
                        {{ $slot }}

                        {{-- Footer --}}
                        <div class="text-center mt-6 pt-4 border-t border-base-300">
                            <p class="text-xs text-base-content/50">
                                &copy; {{ date('Y') }} Copyright by Rizal Mahendra
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
