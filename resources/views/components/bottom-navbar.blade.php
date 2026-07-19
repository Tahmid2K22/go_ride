<nav class="fixed bottom-5 left-1/2 -translate-x-1/2 z-50 bg-white/90 backdrop-blur-lg border border-gray-200 rounded-full shadow-xl px-3 py-2 flex items-center gap-2">
    @auth
        @if(auth()->user()->isRider())
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center px-4 py-2 rounded-full transition {{ request()->routeIs('dashboard') ? 'bg-white text-gray-900 font-bold shadow-md border border-gray-200' : 'text-gray-500 hover:bg-gray-100' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z"/></svg>
                <span class="text-[10px] mt-0.5 font-medium">{{ __('app.dashboard') }}</span>
            </a>
            <a href="{{ route('rides.create') }}" class="flex flex-col items-center justify-center px-4 py-2 rounded-full transition {{ request()->routeIs('rides.create') ? 'bg-white text-gray-900 font-bold shadow-md border border-gray-200' : 'text-gray-500 hover:bg-gray-100' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="text-[10px] mt-0.5 font-medium">{{ __('app.book_ride') }}</span>
            </a>
        @elseif(auth()->user()->isDriver())
            <a href="{{ route('driver.dashboard') }}" class="flex flex-col items-center justify-center px-4 py-2 rounded-full transition {{ request()->routeIs('driver.dashboard') ? 'bg-white text-gray-900 font-bold shadow-md border border-gray-200' : 'text-gray-500 hover:bg-gray-100' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z"/></svg>
                <span class="text-[10px] mt-0.5 font-medium">{{ __('app.dashboard') }}</span>
            </a>
        @endif

        <a href="{{ route('about') }}" class="flex flex-col items-center justify-center px-4 py-2 rounded-full transition {{ request()->routeIs('about') ? 'bg-white text-gray-900 font-bold shadow-md border border-gray-200' : 'text-gray-500 hover:bg-gray-100' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" /></svg>
            <span class="text-[10px] mt-0.5 font-medium">{{ __('app.about') }}</span>
        </a>

        <a href="{{ route('home') }}#contact" class="flex flex-col items-center justify-center px-4 py-2 rounded-full transition text-gray-500 hover:bg-gray-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg>
            <span class="text-[10px] mt-0.5 font-medium">{{ __('app.contact') }}</span>
        </a>

        <!-- Profile Link (now routes to Dashboard) -->
        <a href="{{ auth()->user()->isDriver() ? route('driver.dashboard') : route('dashboard') }}" class="flex flex-col items-center justify-center px-4 py-2 rounded-full transition text-gray-500 hover:bg-gray-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
            <span class="text-[10px] mt-0.5 font-medium">{{ __('app.profile') }}</span>
        </a>
    @else
        <!-- Home Link (routes directly to dashboard path) -->
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center px-4 py-2 rounded-full transition {{ request()->routeIs('dashboard') ? 'bg-white text-gray-900 font-bold shadow-md border border-gray-200' : 'text-gray-500 hover:bg-gray-100' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
            <span class="text-[10px] mt-0.5 font-medium">{{ __('app.home') }}</span>
        </a>

        <a href="{{ route('home') }}#services" class="flex flex-col items-center justify-center px-4 py-2 rounded-full transition text-gray-500 hover:bg-gray-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
            <span class="text-[10px] mt-0.5 font-medium">{{ __('app.services') }}</span>
        </a>

        <a href="{{ route('about') }}" class="flex flex-col items-center justify-center px-4 py-2 rounded-full transition {{ request()->routeIs('about') ? 'bg-white text-gray-900 font-bold shadow-md border border-gray-200' : 'text-gray-500 hover:bg-gray-100' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" /></svg>
            <span class="text-[10px] mt-0.5 font-medium">{{ __('app.about') }}</span>
        </a>

        <a href="{{ route('home') }}#contact" class="flex flex-col items-center justify-center px-4 py-2 rounded-full transition text-gray-500 hover:bg-gray-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg>
            <span class="text-[10px] mt-0.5 font-medium">{{ __('app.contact') }}</span>
        </a>

        <a href="{{ route('login') }}" class="flex flex-col items-center justify-center px-4 py-2 rounded-full transition {{ request()->routeIs('login') ? 'bg-white text-gray-900 font-bold shadow-md border border-gray-200' : 'text-gray-500 hover:bg-gray-100' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
            <span class="text-[10px] mt-0.5 font-medium">{{ __('app.sign_in') }}</span>
        </a>
    @endauth
</nav>
