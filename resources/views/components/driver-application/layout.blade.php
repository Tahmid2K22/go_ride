<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Become a GoRide Driver' }} | GoRide</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white border-b border-gray-100 sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <x-application-logo class="h-8 w-auto fill-current text-primary-600" />
                        <span class="text-xl font-extrabold text-gray-900">GoRide</span>
                    </a>
                    <nav class="hidden md:flex items-center gap-6">
                        <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-primary-600">Home</a>
                    </nav>
                </div>
            </div>
        </header>

        <!-- Progress Indicator -->
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-3xl mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    @foreach ($steps as $index => $step)
                        <div class="flex items-center flex-1 {{ $index < count($steps) - 1 ? 'pr-4' : '' }}">
                            <div class="relative flex items-center">
                                <div class="flex-1 h-1 bg-gray-200 {{ $index < $currentStep ? 'bg-primary-600' : '' }}"></div>
                                <div class="relative flex items-center justify-center w-10 h-10 rounded-full border-2 {{ $index < $currentStep ? 'bg-primary-600 border-primary-600' : ($index === $currentStep ? 'border-primary-600 bg-white' : 'border-gray-200 bg-white') }} z-10">
                                    @if ($index < $currentStep)
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                    @else
                                        <span class="text-sm font-bold {{ $index === $currentStep ? 'text-primary-600' : 'text-gray-400' }}">{{ $index + 1 }}</span>
                                    @endif
                                </div>
                            </div>
                            <span class="mt-2 block text-center text-xs font-medium {{ $index === $currentStep ? 'text-primary-600' : 'text-gray-500' }}">{{ $step }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-950 text-gray-400 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-sm">&copy; {{ date('Y') }} GoRide. All rights reserved.</p>
            </div>
        </footer>
    </div>

</body>
</html>