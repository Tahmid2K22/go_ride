<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <section class="relative py-20 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900 overflow-hidden text-white">
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImVudmxvcGUiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMSI+PHBhdGggZD0iTTM2IDM0djItSDJ2LTJoMzR6TTM2IDE4djJIMnYtMmgzNHoiLz48L2c+PC9nPjwvc3ZnPg==');"></div>
            <div class="absolute top-20 right-10 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-primary-500/20 rounded-full blur-3xl"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 text-white text-sm font-medium rounded-full mb-6 backdrop-blur-sm border border-white/10">
                    <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                    {{ __('app.about_us') }}
                </span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight">
                    Redefining Mobility for Everyone
                </h1>
                <p class="mt-6 text-xl text-primary-100 max-w-3xl mx-auto leading-relaxed">
                    At GoRide, we are building a seamless transportation ecosystem that connects passengers with reliable drivers, making daily commutes easier, safer, and more affordable.
                </p>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="-mt-12 relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 sm:p-10 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="text-4xl sm:text-5xl font-extrabold text-primary-600">2M+</div>
                    <div class="text-gray-500 font-semibold mt-2">Active Riders</div>
                    <p class="text-xs text-gray-400 mt-1">Commuting daily with trust and comfort</p>
                </div>
                <div class="border-y md:border-y-0 md:border-x border-gray-100 py-6 md:py-0">
                    <div class="text-4xl sm:text-5xl font-extrabold text-primary-600">50K+</div>
                    <div class="text-gray-500 font-semibold mt-2">Verified Drivers</div>
                    <p class="text-xs text-gray-400 mt-1">Earning responsibly on their own schedules</p>
                </div>
                <div>
                    <div class="text-4xl sm:text-5xl font-extrabold text-primary-600">24/7</div>
                    <div class="text-gray-500 font-semibold mt-2">Coverage & Support</div>
                    <p class="text-xs text-gray-400 mt-1">Always here to help you get to your destination</p>
                </div>
            </div>
        </section>

        <!-- Core Mission & Values -->
        <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Our Mission</h2>
                    <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                        To empower local communities by creating economic opportunities for drivers while offering safe, sustainable, and reliable transportation alternatives for riders.
                    </p>
                    <div class="mt-8 space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center shrink-0 text-green-600">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Safety First</h3>
                                <p class="text-sm text-gray-500">Every single trip is monitored, and drivers go through rigorous background checks.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center shrink-0 text-green-600">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Affordable & Convenient</h3>
                                <p class="text-sm text-gray-500">Fast pairings, transparent fare estimations, and options for any budget.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative bg-white rounded-3xl p-8 border border-gray-100 shadow-xl overflow-hidden">
                    <div class="absolute -top-12 -right-12 w-40 h-40 bg-primary-100 rounded-full blur-2xl"></div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Our Journey</h3>
                    <div class="relative border-l-2 border-primary-100 ml-4 pl-6 space-y-8">
                        <div class="relative">
                            <span class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-primary-500 border-4 border-white"></span>
                            <h4 class="font-bold text-gray-900">2024 — Inception</h4>
                            <p class="text-sm text-gray-500 mt-1">GoRide was born from a simple idea: making transportation accessible to everyone in urban centers.</p>
                        </div>
                        <div class="relative">
                            <span class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-primary-500 border-4 border-white"></span>
                            <h4 class="font-bold text-gray-900">2025 — Rapid Growth</h4>
                            <p class="text-sm text-gray-500 mt-1">Expanding across multiple cities and launching bike, car, and parcel delivery options.</p>
                        </div>
                        <div class="relative">
                            <span class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-primary-500 border-4 border-white"></span>
                            <h4 class="font-bold text-gray-900">Present — The Future</h4>
                            <p class="text-sm text-gray-500 mt-1">Continuously optimizing route pairing algorithms and integrating more sustainable transport methods.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
