<nav class="navbar bg-base-100 border-b border-base-300 px-4 h-16 sticky top-0 z-30">
    <div class="flex-1 flex items-center gap-4">
        <label for="sidebar-drawer" class="btn btn-ghost btn-square lg:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </label>
        <div class="text-sm breadcrumbs hidden sm:block">
            <ul>
                <li><a href="{{ route('dashboard') }}" class="text-base-content/60 hover:text-primary">Home</a></li>
                @if(request()->route())
                    @php
                        $routeName = request()->route()->getName();
                        $segments = explode('.', $routeName);
                        $current = '';
                    @endphp
                    @foreach($segments as $segment)
                        @php $current = $segment; @endphp
                        <li class="text-base-content/80 capitalize">{{ $segment }}</li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="flex-none flex items-center gap-2">
        <button @click="toggleTheme" class="btn btn-ghost btn-square" :title="theme === 'skalsa-dark' ? 'Mode Terang' : 'Mode Gelap'">
            <svg x-show="theme === 'skalsa'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
            </svg>
            <svg x-show="theme === 'skalsa-dark'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </button>
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-9 h-9 rounded-full bg-primary text-primary-content flex items-center justify-center font-bold text-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </label>
            <ul tabindex="0" class="dropdown-content z-50 menu p-2 shadow-xl bg-base-100 rounded-box w-56 border border-base-200">
                <li class="menu-title">
                    <span>{{ Auth::user()->name }}</span>
                </li>
                <li><a href="{{ route('profile.edit') }}" class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profile
                </a></li>
                <li class="menu-title">
                    <span>Akun</span>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 text-error">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
