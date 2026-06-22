@php $isHome = request()->routeIs('home'); @endphp
<nav x-data="{ mobileOpen: false, scrolled: false }"
     x-init="scrolled = window.scrollY > 20; window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
     :class="scrolled ? 'bg-white/95 backdrop-blur-md border-b border-gray-200 shadow-sm' : '{{ $isHome ? 'bg-transparent' : 'bg-white border-b border-gray-200' }}'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" :class="scrolled ? 'text-primary-600' : '{{ $isHome ? 'text-white' : 'text-primary-600' }}'" class="text-xl font-bold transition-colors duration-300">
                        GoRide
                    </a>
                </div>

                <div class="hidden space-x-1 sm:-my-px sm:ms-8 sm:flex">
                    @auth
                        @php $active = request()->routeIs('dashboard'); @endphp
                        <a href="{{ route('dashboard') }}" :class="scrolled ? 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' : '{{ $active ? 'text-primary-600 bg-primary-50' : ($isHome ? 'text-white/90 hover:text-white hover:bg-white/10' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50') }}'" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition duration-150">
                            {{ __('app.dashboard') }}
                        </a>
                    @else
                        @php $active = request()->routeIs('home'); @endphp
                        <a href="{{ route('home') }}" :class="scrolled ? 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' : '{{ $active ? 'text-primary-600 bg-primary-50' : ($isHome ? 'text-white/90 hover:text-white hover:bg-white/10' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50') }}'" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition duration-150">
                            Home
                        </a>
                        <a href="#services" :class="scrolled ? 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' : '{{ $isHome ? 'text-white/90 hover:text-white hover:bg-white/10' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}'" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition duration-150">
                            {{ __('app.services') }}
                        </a>
                        <a href="#about" :class="scrolled ? 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' : '{{ $isHome ? 'text-white/90 hover:text-white hover:bg-white/10' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}'" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition duration-150">
                            {{ __('app.about') }}
                        </a>
                        <a href="#download" :class="scrolled ? 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' : '{{ $isHome ? 'text-white/90 hover:text-white hover:bg-white/10' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}'" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition duration-150">
                            {{ __('app.download') }}
                        </a>
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Language Toggle -->
                <div class="me-3 relative" x-data="{ langOpen: false }">
                    <button @click="langOpen = ! langOpen" :class="scrolled ? 'text-gray-700 bg-white border border-gray-200 hover:bg-gray-50' : '{{ $isHome ? 'text-white bg-white/10 border border-white/20 hover:bg-white/20' : 'text-gray-700 bg-white border border-gray-200 hover:bg-gray-50' }}'" class="inline-flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition duration-150">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5a17.92 17.92 0 01-8.716-2.247m0 0A9 9 0 013 12c0-1.605.42-3.113 1.157-4.418" /></svg>
                        {{ strtoupper(app()->getLocale()) }}
                        <svg :class="scrolled ? 'text-gray-400' : '{{ $isHome ? 'text-white/70' : 'text-gray-400' }}'" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                    </button>
                    <div x-show="langOpen"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute z-50 mt-2 w-32 rounded-xl shadow-lg border border-gray-100 ltr:origin-top-right rtl:origin-top-left end-0 py-1 bg-white"
                         style="display: none;"
                         @click.outside="langOpen = false">
                        <a href="?lang=en" class="block px-4 py-2 text-sm {{ app()->getLocale() === 'en' ? 'text-primary-600 bg-primary-50 font-semibold' : 'text-gray-700 hover:bg-gray-50' }} transition duration-150">English</a>
                        <a href="?lang=bn" class="block px-4 py-2 text-sm {{ app()->getLocale() === 'bn' ? 'text-primary-600 bg-primary-50 font-semibold' : 'text-gray-700 hover:bg-gray-50' }} transition duration-150">বাংলা</a>
                    </div>
                </div>

                @auth
                <div class="relative" x-data="{ userOpen: false }" @click.outside="userOpen = false" @close.stop="userOpen = false">
                    <div @click="userOpen = ! userOpen">
                        <button :class="scrolled ? 'text-gray-700 bg-white border border-gray-200 hover:bg-gray-50' : '{{ $isHome ? 'text-white bg-white/10 border border-white/20 hover:bg-white/20' : 'text-gray-700 bg-white border border-gray-200 hover:bg-gray-50' }}'" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition duration-150">
                            <span :class="scrolled ? 'bg-primary-100 text-primary-700' : '{{ $isHome ? 'bg-white/20 text-white' : 'bg-primary-100 text-primary-700' }}'" class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                            <svg :class="scrolled ? 'text-gray-400' : '{{ $isHome ? 'text-white/70' : 'text-gray-400' }}'" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                        </button>
                    </div>

                    <div x-show="userOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute z-50 mt-2 w-48 rounded-xl shadow-lg border border-gray-100 ltr:origin-top-right rtl:origin-top-left end-0 py-1 bg-white"
                            style="display: none;"
                            @click="userOpen = false">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-150">{{ __('app.profile') }}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition duration-150">{{ __('app.log_out') }}</button>
                        </form>
                    </div>
                </div>
                @else
                    <a href="{{ route('login') }}" :class="scrolled ? 'bg-primary-600 text-white hover:bg-primary-700' : '{{ $isHome ? 'bg-white text-primary-700 hover:bg-primary-50' : 'bg-primary-600 text-white hover:bg-primary-700' }}'" class="px-5 py-2.5 text-sm font-semibold rounded-lg transition duration-150">
                        {{ __('app.sign_in') }}
                    </a>
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="mobileOpen = ! mobileOpen" :class="scrolled ? 'text-gray-400 hover:text-gray-500 hover:bg-gray-100' : '{{ $isHome ? 'text-white hover:text-white hover:bg-white/10' : 'text-gray-400 hover:text-gray-500 hover:bg-gray-100' }}'" class="inline-flex items-center justify-center p-2 rounded-lg focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': mobileOpen, 'inline-flex': ! mobileOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! mobileOpen, 'inline-flex': mobileOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': mobileOpen, 'hidden': ! mobileOpen}" class="hidden sm:hidden border-t border-gray-100 bg-white">
        @auth
            <div class="pt-2 pb-1 space-y-1">
                @php $active = request()->routeIs('dashboard'); @endphp
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm font-medium {{ $active ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} transition duration-150">{{ __('app.dashboard') }}</a>
            </div>
            <div class="pt-1 pb-3 border-t border-gray-100">
                <div class="px-4 py-2">
                    <div class="font-medium text-sm text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-1 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition duration-150">{{ __('app.profile') }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition duration-150">{{ __('app.log_out') }}</button>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-2 text-sm font-medium text-primary-600 bg-primary-50">Home</a>
                <a href="#services" class="block px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">{{ __('app.services') }}</a>
                <a href="#about" class="block px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">{{ __('app.about') }}</a>
                <a href="#download" class="block px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">{{ __('app.download') }}</a>
            </div>
            <div class="pt-1 pb-3 border-t border-gray-100 space-y-1">
                <div class="flex gap-2 px-4 py-2">
                    <a href="?lang=en" class="text-xs font-semibold px-3 py-1.5 rounded-lg {{ app()->getLocale() === 'en' ? 'bg-primary-100 text-primary-700' : 'bg-gray-100 text-gray-600' }} transition">English</a>
                    <a href="?lang=bn" class="text-xs font-semibold px-3 py-1.5 rounded-lg {{ app()->getLocale() === 'bn' ? 'bg-primary-100 text-primary-700' : 'bg-gray-100 text-gray-600' }} transition">বাংলা</a>
                </div>
                <a href="{{ route('login') }}" class="block mx-4 text-center px-5 py-2.5 bg-primary-600 text-white text-sm font-semibold rounded-lg">{{ __('app.sign_in') }}</a>
            </div>
        @endauth
    </div>
</nav>
