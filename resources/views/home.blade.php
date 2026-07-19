<x-app-layout>
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImVudmxvcGUiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMSI+PHBhdGggZD0iTTM2IDM0djItSDJ2LTJoMzR6TTM2IDE4djJIMnYtMmgzNHoiLz48L2c+PC9nPjwvc3ZnPg==');"></div>
            <!-- Gradient Orbs -->
            <div class="absolute top-20 left-10 w-96 h-96 bg-primary-400/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 lg:py-40">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 text-white text-sm font-medium rounded-full mb-8 backdrop-blur-sm border border-white/10">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        {{ __('app.hero_tagline') }}
                    </span>
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-white leading-[1.1]">
                        {{ __('app.hero_title_short') }}<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-200 to-primary-300">Go<span class="text-white">Ride</span></span>
                    </h1>
                    <p class="mt-8 text-xl text-primary-100/90 leading-relaxed max-w-lg">
                        {{ __('app.hero_title') }}
                    </p>
                    <div class="mt-10 flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="group px-8 py-4 bg-white text-primary-700 font-bold rounded-2xl hover:bg-primary-50 transition-all duration-300 shadow-xl shadow-primary-900/30 flex items-center gap-3">
                            {{ __('app.get_started') }}
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </a>
                        <a href="{{ route('driver-apply.create') }}" class="group px-8 py-4 bg-amber-500 text-white font-bold rounded-2xl hover:bg-amber-600 transition-all duration-300 shadow-xl shadow-amber-500/30 flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ __('app.earn_from_goride') }}
                        </a>
                        <a href="#services" class="px-8 py-4 bg-white/10 text-white font-bold rounded-2xl hover:bg-white/20 transition-all duration-300 border border-white/20 backdrop-blur-sm">
                            {{ __('app.explore_services') }}
                        </a>
                    </div>
                    <!-- Trust Indicators -->
                    <div class="mt-12 flex items-center gap-8">
                        <div class="flex -space-x-3">
                            @for ($i = 0; $i < 4; $i++)
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-300 to-primary-500 border-2 border-primary-700 flex items-center justify-center text-white text-xs font-bold">
                                    {{ chr(65 + $i) }}
                                </div>
                            @endfor
                        </div>
                        <div>
                            <div class="text-white font-semibold">2M+ Riders</div>
                            <div class="text-primary-200 text-sm">Trust GoRide daily</div>
                        </div>
                    </div>
                </div>

                <!-- Hero Visual -->
                <div class="relative hidden lg:block">
                    <div class="relative bg-white/10 backdrop-blur-sm rounded-3xl p-8 border border-white/20">
                        <div class="bg-gradient-to-br from-primary-500/80 to-primary-700/80 rounded-2xl p-8">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center">
                                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                </div>
                                <div>
                                    <div class="text-white font-semibold">Find Your Ride</div>
                                    <div class="text-primary-100 text-sm">Pickup: Dhanmondi 27</div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="bg-white/10 rounded-xl p-4 flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-lg bg-primary-400/30 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-white text-sm font-medium">Bike</div>
                                        <div class="text-primary-200 text-xs">3 min away</div>
                                    </div>
                                    <div class="text-white font-semibold">Tk 45</div>
                                </div>
                                <div class="bg-white/10 rounded-xl p-4 flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-lg bg-amber-400/30 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-white text-sm font-medium">Car</div>
                                        <div class="text-primary-200 text-xs">5 min away</div>
                                    </div>
                                    <div class="text-white font-semibold">Tk 120</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Floating Elements -->
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-white rounded-2xl shadow-xl flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary-600">4.8</div>
                            <div class="flex gap-0.5 justify-center">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-3 h-3 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl shadow-xl p-4 flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <div class="text-gray-900 font-semibold text-sm">Trip Completed</div>
                            <div class="text-gray-500 text-xs">Just now</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/60">
            <span class="text-xs font-medium">Scroll to explore</span>
            <div class="w-6 h-10 rounded-full border-2 border-white/30 flex justify-center pt-2">
                <div class="w-1.5 h-3 bg-white/60 rounded-full animate-bounce"></div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-12">{{ __('app.how_to_use') }}</h2>
            <!-- Stacked vertical column layout -->
            <div class="flex flex-col gap-6 max-w-xl mx-auto text-center">
                <!-- Step 1 -->
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl font-bold mb-4">1</div>
                    <h3 class="text-xl font-semibold mb-2">{{ __('app.request_ride') }}</h3>
                    <p class="text-gray-600 max-w-sm">{{ __('app.request_ride_desc') }}</p>
                </div>
                <!-- Step 2 -->
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl font-bold mb-4">2</div>
                    <h3 class="text-xl font-semibold mb-2">{{ __('app.enjoy_journey') }}</h3>
                    <p class="text-gray-600 max-w-sm">{{ __('app.enjoy_journey_desc') }}</p>
                </div>
                <!-- Step 3 -->
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl font-bold mb-4">3</div>
                    <h3 class="text-xl font-semibold mb-2">{{ __('app.seamless_payment') }}</h3>
                    <p class="text-gray-600 max-w-sm">{{ __('app.seamless_payment_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 text-sm font-semibold rounded-full mb-4">{{ __('app.our_services') }}</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900">{{ __('app.services_subtitle') }}</h2>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Bike -->
                <div class="group relative bg-white rounded-3xl p-8 shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-primary-200 hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary-50 rounded-bl-[80px] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative text-center">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center mb-6 shadow-lg shadow-primary-500/30 group-hover:scale-110 transition-transform duration-500 mx-auto">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">{{ __('app.bike') }}</h3>
                        <p class="mt-3 text-gray-500 text-sm leading-relaxed text-center">{{ __('app.bike_desc') }}</p>
                        <a href="#" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-primary-600 hover:text-primary-700 group/link">
                            {{ __('app.learn_more') }}
                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </a>
                    </div>
                </div>
                <!-- Car -->
                <div class="group relative bg-white rounded-3xl p-8 shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-amber-200 hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[80px] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative text-center">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center mb-6 shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform duration-500 mx-auto">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">{{ __('app.car') }}</h3>
                        <p class="mt-3 text-gray-500 text-sm leading-relaxed text-center">{{ __('app.car_desc') }}</p>
                        <a href="#" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-amber-600 hover:text-amber-700 group/link">
                            {{ __('app.learn_more') }}
                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </a>
                    </div>
                </div>
                <!-- Food -->
                <div class="group relative bg-white rounded-3xl p-8 shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-rose-200 hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-bl-[80px] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative text-center">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-rose-500 to-rose-600 flex items-center justify-center mb-6 shadow-lg shadow-rose-500/30 group-hover:scale-110 transition-transform duration-500 mx-auto">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">{{ __('app.food') }}</h3>
                        <p class="mt-3 text-gray-500 text-sm leading-relaxed text-center">{{ __('app.food_desc') }}</p>
                        <a href="#" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-rose-600 hover:text-rose-700 group/link">
                            {{ __('app.learn_more') }}
                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </a>
                    </div>
                </div>
                <!-- Parcel -->
                <div class="group relative bg-white rounded-3xl p-8 shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-emerald-200 hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[80px] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative text-center">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center mb-6 shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-500 mx-auto">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">{{ __('app.parcel') }}</h3>
                        <p class="mt-3 text-gray-500 text-sm leading-relaxed text-center">{{ __('app.parcel_desc') }}</p>
                        <a href="#" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 hover:text-emerald-700 group/link">
                            {{ __('app.learn_more') }}
                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 text-sm font-semibold rounded-full mb-4">{{ __('app.about') }}</span>
                    <h2 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight">{{ __('app.why_choose') }}</h2>
                    <p class="mt-6 text-lg text-gray-500 leading-relaxed">{{ __('app.why_subtitle') }}</p>
                    <div class="mt-10 space-y-4">
                        <div class="flex items-start gap-5 p-4 rounded-2xl hover:bg-gray-50 transition-colors">
                            <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg">{{ __('app.safe_secure') }}</h4>
                                <p class="mt-1 text-gray-500">{{ __('app.safe_desc') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5 p-4 rounded-2xl hover:bg-gray-50 transition-colors">
                            <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg">{{ __('app.affordable') }}</h4>
                                <p class="mt-1 text-gray-500">{{ __('app.affordable_desc') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5 p-4 rounded-2xl hover:bg-gray-50 transition-colors">
                            <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg">{{ __('app.lightning_fast') }}</h4>
                                <p class="mt-1 text-gray-500">{{ __('app.fast_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-primary-50 border border-primary-100 rounded-[2rem] p-10">
                        <div class="text-center">
                            <div class="text-7xl font-extrabold text-primary-600 mb-4">4.8</div>
                            <div class="flex justify-center gap-1.5 mb-6">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-7 h-7 text-primary-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                @endfor
                            </div>
                            <p class="text-primary-700 text-xl font-medium">{{ __('app.rated_by') }}</p>
                        </div>
                    </div>
                    <!-- Decorative -->
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-primary-100 rounded-2xl -z-10"></div>
                    <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-primary-50 rounded-2xl -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 text-sm font-semibold rounded-full mb-4">{{ __('app.contact') }}</span>
                <h2 class="text-4xl sm:text-5xl font-extrabold text-gray-900">{{ __('app.get_in_touch') }}</h2>
                <p class="mt-4 text-lg text-gray-500">{{ __('app.contact_subtitle') }}</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-xl bg-primary-100 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">{{ __('app.call_us') }}</h3>
                    <p class="mt-2 text-gray-500 text-sm">+880 1XXX-XXXXXX</p>
                    <p class="text-gray-400 text-sm">{{ __('app.available_24_7') }}</p>
                </div>
                <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-xl bg-primary-100 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">{{ __('app.email_us') }}</h3>
                    <p class="mt-2 text-gray-500 text-sm">support@goride.com</p>
                    <p class="text-gray-400 text-sm">{{ __('app.fast_response') }}</p>
                </div>
                <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-xl bg-primary-100 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">{{ __('app.visit_us') }}</h3>
                    <p class="mt-2 text-gray-500 text-sm">{{ __('app.office_address') }}</p>
                    <p class="text-gray-400 text-sm">Dhaka, Bangladesh</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-950 text-gray-400 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-5 gap-10">
                <div class="md:col-span-2">
                    <h3 class="text-2xl font-extrabold text-white mb-4">GoRide</h3>
                    <p class="text-sm leading-relaxed max-w-xs">{{ __('app.footer_desc') }}</p>
                    <div class="flex gap-3 mt-6">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">{{ __('app.services') }}</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-white transition">{{ __('app.bike') }}</a></li>
                        <li><a href="#" class="hover:text-white transition">{{ __('app.car') }}</a></li>
                        <li><a href="#" class="hover:text-white transition">{{ __('app.food') }}</a></li>
                        <li><a href="#" class="hover:text-white transition">{{ __('app.parcel') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">{{ __('app.company') }}</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-white transition">{{ __('app.about_us') }}</a></li>
                        <li><a href="#" class="hover:text-white transition">{{ __('app.careers') }}</a></li>
                        <li><a href="#" class="hover:text-white transition">{{ __('app.blog') }}</a></li>
                        <li><a href="#" class="hover:text-white transition">{{ __('app.press') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">{{ __('app.support') }}</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-white transition">{{ __('app.help_center') }}</a></li>
                        <li><a href="#" class="hover:text-white transition">{{ __('app.safety') }}</a></li>
                        <li><a href="#" class="hover:text-white transition">{{ __('app.terms') }}</a></li>
                        <li><a href="#" class="hover:text-white transition">{{ __('app.privacy') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-800 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-sm">&copy; {{ date('Y') }} GoRide. {{ __('app.all_rights') }}</p>
            </div>
        </div>
    </footer>
</x-app-layout>
