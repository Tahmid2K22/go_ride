<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'GoRide') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full font-sans antialiased">
        <div class="min-h-screen flex bg-slate-50">
            <!-- Left Branding Panel -->
            <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImVudmxvcGUiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzR2MkgyVjJoMzR6TTM2IDE4djJIMnYtMmgzNHoiLz48L2c+PC9nPjwvc3ZnPg==');"></div>
                </div>
                <div class="absolute -top-32 -right-32 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>

                <div class="relative flex flex-col justify-center px-12 lg:px-16 w-full">
                    <a href="/" class="flex items-center gap-3 mb-12">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-lg shadow-black/10">
                            <svg class="w-7 h-7 text-primary-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <span class="text-2xl font-extrabold text-white tracking-tight">GoRide</span>
                    </a>

                    <h1 class="text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-6">
                        {{ __('app.hero_tagline') }}
                    </h1>
                    <p class="text-lg text-primary-100 leading-relaxed max-w-md">
                        {{ __('app.hero_title') }}
                    </p>

                    <div class="mt-16 grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-3xl font-extrabold text-white">2M+</p>
                            <p class="text-sm text-primary-200 mt-1">{{ __('app.trips_completed') }}</p>
                        </div>
                        <div>
                            <p class="text-3xl font-extrabold text-white">50+</p>
                            <p class="text-sm text-primary-200 mt-1">{{ __('app.cities_covered') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Form Panel -->
            <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
                <div class="w-full max-w-md">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <span class="text-xl font-extrabold text-slate-900">GoRide</span>
                    </div>

                    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 p-8 sm:p-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
