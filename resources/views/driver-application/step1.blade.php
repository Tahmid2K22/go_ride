<x-driver-application.layout :steps="['Personal Info', 'Documents', 'Review']" :currentStep="1" :title="'Apply to Drive with GoRide'">
    <form x-data="driverForm" @submit.prevent="nextStep" class="space-y-8">
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
                    <input type="text" id="name" name="name" x-model="formData.name" @blur="$dispatch('validate', { field: 'name' })"
                           class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm p-3 bg-white"
                           placeholder="John Doe" required>
                    <x-input-error :messages="errors.name" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="email" value="Email Address" />
                    <input type="email" id="email" name="email" x-model="formData.email" @blur="$dispatch('validate', { field: 'email' })"
                           class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm p-3 bg-white"
                           placeholder="john@example.com" required>
                    <x-input-error :messages="errors.email" class="mt-1" />
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="phone" value="Phone Number" />
                    <input type="tel" id="phone" name="phone" x-model="formData.phone" @blur="$dispatch('validate', { field: 'phone' })"
                           class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm p-3 bg-white"
                           placeholder="+880 1XXX XXXXXXX" required>
                    <x-input-error :messages="errors.phone" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="vehicle_type" value="Vehicle Type" />
                    <select id="vehicle_type" name="vehicle_type" x-model="formData.vehicle_type" @blur="$dispatch('validate', { field: 'vehicle_type' })"
                            class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm p-3 bg-white" required>
                        <option value="">Select vehicle type</option>
                        <option value="bike">Bike / Motorcycle</option>
                        <option value="car">Car (Sedan/Hatchback)</option>
                        <option value="cng">CNG / Auto-rickshaw</option>
                    </select>
                    <x-input-error :messages="errors.vehicle_type" class="mt-1" />
                </div>
            </div>

            <div>
                <x-input-label for="license_plate" value="License Plate Number" />
                <input type="text" id="license_plate" name="license_plate" x-model="formData.license_plate" @blur="$dispatch('validate', { field: 'license_plate' })"
                       class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm p-3 bg-white uppercase"
                       placeholder="DHAKA METRO-A-1234" required maxlength="20">
                <x-input-error :messages="errors.license_plate" class="mt-1" />
                <p class="mt-1 text-xs text-gray-500">Enter as shown on your vehicle registration</p>
            </div>
        </section>

        <!-- Vehicle Type Info Cards -->
        <div class="bg-gray-50 rounded-2xl p-6">
            <h3 class="font-semibold text-gray-900 mb-4">Which vehicle type fits you?</h3>
            <div class="grid grid-cols-3 gap-4">
                <label class="relative cursor-pointer">
                    <input type="radio" name="vehicle_type_preview" value="bike" class="sr-only peer" x-model="formData.vehicle_type">
                    <div class="p-4 rounded-xl border-2 text-center transition-all peer-checked:border-primary-500 peer-checked:bg-primary-50 peer-checked:shadow-lg peer-checked:shadow-primary-500/10">
                        <div class="w-12 h-12 mx-auto mb-2 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                        </div>
                        <p class="font-medium text-gray-900">Bike</p>
                        <p class="text-xs text-gray-500">Motorcycle/Scooter</p>
                    </div>
                </label>
                <label class="relative cursor-pointer">
                    <input type="radio" name="vehicle_type_preview" value="car" class="sr-only peer" x-model="formData.vehicle_type">
                    <div class="p-4 rounded-xl border-2 text-center transition-all peer-checked:border-primary-500 peer-checked:bg-primary-50 peer-checked:shadow-lg peer-checked:shadow-primary-500/10">
                        <div class="w-12 h-12 mx-auto mb-2 bg-amber-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                        </div>
                        <p class="font-medium text-gray-900">Car</p>
                        <p class="text-xs text-gray-500">Sedan/Hatchback</p>
                    </div>
                </label>
                <label class="relative cursor-pointer">
                    <input type="radio" name="vehicle_type_preview" value="cng" class="sr-only peer" x-model="formData.vehicle_type">
                    <div class="p-4 rounded-xl border-2 text-center transition-all peer-checked:border-primary-500 peer-checked:bg-primary-50 peer-checked:shadow-lg peer-checked:shadow-primary-500/10">
                        <div class="w-12 h-12 mx-auto mb-2 bg-emerald-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.5L8.25 12l6.75-7.5" /></svg>
                        </div>
                        <p class="font-medium text-gray-900">CNG</p>
                        <p class="text-xs text-gray-500">Auto-rickshaw</p>
                    </div>
                </label>
            </div>
        </div>

        <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
            <button type="button" @click="nextStep()"
                    class="px-8 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                Continue to Documents
                <svg class="w-5 h-5 ml-2 inline" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
            </button>
        </div>
    </form>
</x-driver-application.layout>