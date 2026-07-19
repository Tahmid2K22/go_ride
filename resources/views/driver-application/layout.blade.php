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

    <!-- Alpine.js for form interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700">Sign In</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-primary-600 text-white rounded-xl font-semibold hover:bg-primary-700 transition">Get Started</a>
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

    {{-- Alpine.js form validation --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('driverForm', () => ({
                step: {{ $currentStep }},
                maxStep: 3,
                formData: @json(session('driver_application', [])),
                errors: {},

                nextStep() {
                    if (this.validateStep(this.step)) {
                        this.step++;
                        this.saveProgress();
                    }
                },

                prevStep() {
                    if (this.step > 1) {
                        this.step--;
                    }
                },

                validateStep(step) {
                    this.errors = {};
                    let valid = true;

                    if (step === 1) {
                        const fields = ['name', 'email', 'phone', 'vehicle_type', 'license_plate'];
                        fields.forEach(field => {
                            if (!this.formData[field] || !this.formData[field].toString().trim()) {
                                this.errors[field] = 'This field is required';
                                valid = false;
                            }
                        });
                        if (this.formData.email && !this.isValidEmail(this.formData.email)) {
                            this.errors.email = 'Please enter a valid email';
                            valid = false;
                        }
                        if (this.formData.phone && !this.isValidPhone(this.formData.phone)) {
                            this.errors.phone = 'Please enter a valid phone number';
                            valid = false;
                        }
                    } else if (step === 2) {
                        const files = ['nid_front', 'nid_back', 'driving_license'];
                        files.forEach(file => {
                            if (!this.$refs[file]?.files?.length) {
                                this.errors[file] = 'Please upload this document';
                                valid = false;
                            }
                        });
                    }

                    return valid;
                },

                saveProgress() {
                    if (this.step <= 2) {
                        // Store in session via AJAX
                        fetch('{{ route('driver-apply.save-progress') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                step: this.step,
                                data: this.formData
                            })
                        });
                    }
                },

                isValidEmail(email) {
                    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                },

                isValidPhone(phone) {
                    return /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(phone);
                },

                handleFileUpload(field, event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.formData[field] = file;
                        this.errors[field] = '';
                    }
                },

                getFileName(field) {
                    const file = this.formData[field];
                    return file instanceof File ? file.name : (file ? 'Uploaded' : '');
                }
            }));
        });
    </script>
</body>
</html>