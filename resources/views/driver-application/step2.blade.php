<x-driver-application.layout :steps="['Personal Info', 'Vehicle Details']" :currentStep="2" :title="'Vehicle Information'">
    <form action="{{ route('driver-apply.step2.store') }}" method="POST" class="space-y-8">
        @csrf
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Vehicle Details</h1>
            <p class="mt-2 text-gray-500">Tell us about your vehicle</p>
        </div>

        <!-- Vehicle Type Selection -->
        <section class="space-y-6">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                <span class="w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-sm font-bold">1</span>
                Vehicle Type
            </h2>

            <div class="grid grid-cols-2 gap-4">
                <label class="relative cursor-pointer group">
                    <input type="radio" name="vehicle_type" value="bike" class="sr-only peer" {{ old('vehicle_type') === 'bike' ? 'checked' : '' }} required>
                    <div class="p-4 rounded-xl border-2 text-center transition-all peer-checked:border-primary-500 peer-checked:bg-primary-50 peer-checked:shadow-lg peer-checked:shadow-primary-500/10 hover:border-primary-300">
                        <div class="w-14 h-14 mx-auto mb-3 bg-green-100 rounded-xl flex items-center justify-center peer-checked:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <p class="font-medium text-gray-900">Motorcycle / Bike</p>
                        <p class="text-xs text-gray-500">2-wheeler vehicles</p>
                    </div>
                </label>

                <label class="relative cursor-pointer group">
                    <input type="radio" name="vehicle_type" value="car" class="sr-only peer" {{ old('vehicle_type') === 'car' ? 'checked' : '' }} required>
                    <div class="p-4 rounded-xl border-2 text-center transition-all peer-checked:border-primary-500 peer-checked:bg-primary-50 peer-checked:shadow-lg peer-checked:shadow-primary-500/10 hover:border-primary-300">
                        <div class="w-14 h-14 mx-auto mb-3 bg-amber-100 rounded-xl flex items-center justify-center peer-checked:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <p class="font-medium text-gray-900">Car</p>
                        <p class="text-xs text-gray-500">Sedan, Hatchback, SUV</p>
                    </div>
                </label>
            </div>
            @error('vehicle_type') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </section>

        <!-- License Plate -->
        <section class="space-y-6">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                <span class="w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-sm font-bold">2</span>
                License Plate Number
            </h2>

            <div>
                <x-input-label for="license_plate" value="Vehicle License Plate" />
                <input type="text" id="license_plate" name="license_plate" value="{{ old('license_plate', session('driver_application.step2.license_plate', '')) }}"
                       class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm p-3 bg-white uppercase"
                       placeholder="DHAKA METRO-A-1234" required maxlength="20">
                @error('license_plate') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                <p class="mt-1 text-xs text-gray-500">Enter as shown on your vehicle registration</p>
            </div>
        </section>

        <div class="flex justify-between gap-4 pt-4 border-t border-gray-100">
            <a href="{{ route('driver-apply.create') }}"
               class="px-8 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                Back
            </a>
            <button type="submit"
                    class="px-8 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                Submit Application
                <svg class="w-5 h-5 ml-2 inline" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
            </button>
        </div>
    </form>
</x-driver-application.layout>
