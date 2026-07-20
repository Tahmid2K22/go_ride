<x-driver-application.layout :steps="['Personal Info', 'Vehicle Details']" :currentStep="1" :title="'Apply to Drive with GoRide'">
    <form action="{{ route('driver-apply.step1') }}" method="POST" class="space-y-8">
        @csrf
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Join GoRide as a Driver</h1>
            <p class="mt-2 text-gray-500">Start earning on your own schedule. Tell us about yourself.</p>
        </div>

        <!-- Personal Information -->
        <section class="space-y-6">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                <span class="w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-sm font-bold">1</span>
                Personal Information
            </h2>

            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="name" value="Full Name" />
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm p-3 bg-white"
                           placeholder="John Doe" required>
                    @error('name') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-input-label for="email" value="Email Address" />
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm p-3 bg-white"
                           placeholder="john@example.com" required>
                    @error('email') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <x-input-label for="phone" value="Phone Number" />
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                       class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm p-3 bg-white"
                       placeholder="+880 1XXX XXXXXXX" required>
                @error('phone') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="password" value="Password" />
                    <input type="password" id="password" name="password"
                           class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm p-3 bg-white"
                           placeholder="Min 8 characters" required minlength="8">
                    @error('password') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-input-label for="password_confirmation" value="Confirm Password" />
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm p-3 bg-white"
                           placeholder="Re-enter password" required minlength="8">
                </div>
            </div>
        </section>

        <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
            <button type="submit"
                    class="px-8 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                Continue to Vehicle Details
                <svg class="w-5 h-5 ml-2 inline" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
            </button>
        </div>
    </form>
</x-driver-application.layout>
