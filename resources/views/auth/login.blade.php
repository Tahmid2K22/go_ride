<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>GoRide - {{ __('app.login_title') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full font-sans antialiased">
        <div class="min-h-full flex">
            <!-- Left side - Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900 relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImVudmxvcGUiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDM0djItSDJ2LTJoMzR6TTM2IDE4djJIMnYtMmgzNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-30"></div>
                <div class="relative z-10 flex flex-col justify-center px-12 lg:px-16">
                    <div class="mb-8">
                        <h1 class="text-5xl font-bold text-white tracking-tight">GoRide</h1>
                        <p class="mt-3 text-primary-100 text-lg">{{ __('app.hero_tagline') }}</p>
                    </div>
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold">{{ __('app.safe_secure') }}</h3>
                                <p class="text-primary-200 text-sm">{{ __('app.hero_title') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold">{{ __('app.affordable') }}</h3>
                                <p class="text-primary-200 text-sm">{{ __('app.affordable_desc') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" /></svg>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold">{{ __('app.lightning_fast') }}</h3>
                                <p class="text-primary-200 text-sm">{{ __('app.fast_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side - Login Form -->
            <div class="flex-1 flex flex-col justify-center px-6 sm:px-12 lg:px-16 xl:px-20">
                <div class="mx-auto w-full max-w-sm">
                    <!-- Language Toggle -->
                    <div class="flex justify-end gap-2 mb-6">
                        <a href="?lang=en" class="text-xs font-semibold px-3 py-1.5 rounded-lg {{ app()->getLocale() === 'en' ? 'bg-primary-100 text-primary-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }} transition">English</a>
                        <a href="?lang=bn" class="text-xs font-semibold px-3 py-1.5 rounded-lg {{ app()->getLocale() === 'bn' ? 'bg-primary-100 text-primary-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }} transition">বাংলা</a>
                    </div>

                    <div class="lg:hidden mb-8">
                        <h1 class="text-3xl font-bold text-primary-600">GoRide</h1>
                    </div>

                    <h2 class="text-2xl font-bold text-gray-900">{{ __('app.login_title') }}</h2>
                    <p class="mt-2 text-sm text-gray-600">{{ __('app.login_subtitle') }}</p>

                    @if (session('status'))
                        <div class="mt-4 p-3 rounded-lg bg-green-50 border border-green-200 text-sm text-green-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.email') }}</label>
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm px-4 py-3"
                                placeholder="you@example.com">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.password') }}</label>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm px-4 py-3"
                                placeholder="••••••••">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-600">{{ __('app.remember_me') }}</label>
                        </div>

                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150">
                            {{ __('app.sign_in') }}
                        </button>
                    </form>

                    <p class="mt-6 text-center text-sm text-gray-600">
                        {{ __('app.no_account') }}
                        <a href="{{ route('register') }}" class="font-semibold text-primary-600 hover:text-primary-500">{{ __('app.create_one') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
