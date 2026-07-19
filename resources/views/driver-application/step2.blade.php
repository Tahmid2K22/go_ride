<x-driver-application.layout :steps="['Personal Info', 'Vehicle & Documents', 'Review']" :currentStep="2" :title="'Vehicle Information & Documents'">
    <form x-data="driverForm" @submit.prevent="nextStep" class="space-y-8" enctype="multipart/form-data">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Vehicle Details & Documents</h1>
            <p class="mt-2 text-gray-500">Tell us about your vehicle and upload required documents</p>
        </div>

        <!-- Vehicle Type Selection -->
        <section class="space-y-6">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                <span class="w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-sm font-bold">1</span>
                Vehicle Type
            </h2>
            
            <div class="grid grid-cols-3 gap-4">
                <label class="relative cursor-pointer group">
                    <input type="radio" name="vehicle_type" value="bike" class="sr-only peer" x-model="formData.vehicle_type" required>
                    <div class="p-4 rounded-xl border-2 text-center transition-all 
                        peer-checked:border-primary-500 peer-checked:bg-primary-50 peer-checked:shadow-lg peer-checked:shadow-primary-500/10
                        hover:border-primary-300">
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
                    <input type="radio" name="vehicle_type" value="car" class="sr-only peer" x-model="formData.vehicle_type" required>
                    <div class="p-4 rounded-xl border-2 text-center transition-all 
                        peer-checked:border-primary-500 peer-checked:bg-primary-50 peer-checked:shadow-lg peer-checked:shadow-primary-500/10
                        hover:border-primary-300">
                        <div class="w-14 h-14 mx-auto mb-3 bg-amber-100 rounded-xl flex items-center justify-center peer-checked:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <p class="font-medium text-gray-900">Car</p>
                        <p class="text-xs text-gray-500">Sedan, Hatchback, SUV</p>
                    </div>
                </label>

                <label class="relative cursor-pointer group">
                    <input type="radio" name="vehicle_type" value="cng" class="sr-only peer" x-model="formData.vehicle_type" required>
                    <div class="p-4 rounded-xl border-2 text-center transition-all 
                        peer-checked:border-primary-500 peer-checked:bg-primary-50 peer-checked:shadow-lg peer-checked:shadow-primary-500/10
                        hover:border-primary-300">
                        <div class="w-14 h-14 mx-auto mb-3 bg-emerald-100 rounded-xl flex items-center justify-center peer-checked:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.5L8.25 12l6.75-7.5" />
                            </svg>
                        </div>
                        <p class="font-medium text-gray-900">CNG / Auto</p>
                        <p class="text-xs text-gray-500">Auto-rickshaw / CNG</p>
                    </div>
                </label>
            </div>
            <x-input-error :messages="errors.vehicle_type" class="mt-1" />
        </section>

        <!-- License Plate -->
        <section class="space-y-6">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                <span class="w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-sm font-bold">2</span>
                License Plate Number
            </h2>
            
            <div>
                <x-input-label for="license_plate" value="Vehicle License Plate" />
                <input type="text" id="license_plate" name="license_plate" x-model="formData.license_plate" @blur="$dispatch('validate', { field: 'license_plate' })"
                       class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm p-3 bg-white uppercase"
                       placeholder="DHAKA METRO-A-1234" required maxlength="20">
                <x-input-error :messages="errors.license_plate" class="mt-1" />
                <p class="mt-1 text-xs text-gray-500">Enter as shown on your vehicle registration</p>
            </div>
        </section>

        <!-- Document Upload Section -->
        <section class="space-y-6 pt-4 border-t border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                <span class="w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-sm font-bold">3</span>
                Required Documents
            </h2>
            <p class="text-sm text-gray-500">Upload clear photos or scans of each document</p>

            <!-- NID Front -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 hover:border-primary-200 transition-colors">
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900">NID / Passport - Front Side</h3>
                        <p class="text-sm text-gray-500 mt-1">Clear photo of the front side of your National ID or Passport</p>
                    </div>
                </div>
                <label class="relative cursor-pointer w-full">
                    <input type="file" id="nid_front" name="nid_front" accept="image/*,.pdf"
                           x-ref="nid_front" @change="handleFileUpload('nid_front', $event)"
                           class="sr-only" required>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary-400 hover:bg-primary-50 transition-colors"
                         @dragover.prevent @dragleave.prevent @drop.prevent="handleFileUpload('nid_front', $event)">
                        <div x-show="!formData.nid_front" class="text-center">
                            <svg class="mx-auto h-10 w-10 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <p class="text-gray-600 mb-1">Drag & drop or click to upload</p>
                            <p class="text-xs text-gray-400">JPG, PNG, or PDF (max 5MB)</p>
                        </div>
                        <div x-show="formData.nid_front" class="text-center text-green-600">
                            <svg class="mx-auto h-10 w-10 mb-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <p class="font-medium" x-text="getFileName('nid_front')"></p>
                            <button type="button" @click="formData.nid_front = null" class="mt-2 text-sm text-red-600 hover:text-red-700">Remove</button>
                        </div>
                    </div>
                </label>
                <x-input-error :messages="errors.nid_front" class="mt-2" />
            </div>

            <!-- NID Back -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 hover:border-primary-200 transition-colors">
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900">NID / Passport - Back Side</h3>
                        <p class="text-sm text-gray-500 mt-1">Clear photo of the back side of your National ID or Passport</p>
                    </div>
                </div>
                <label class="relative cursor-pointer w-full">
                    <input type="file" id="nid_back" name="nid_back" accept="image/*,.pdf"
                           x-ref="nid_back" @change="handleFileUpload('nid_back', $event)"
                           class="sr-only" required>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary-400 hover:bg-primary-50 transition-colors"
                         @dragover.prevent @dragleave.prevent @drop.prevent="handleFileUpload('nid_back', $event)">
                        <div x-show="!formData.nid_back" class="text-center">
                            <svg class="mx-auto h-10 w-10 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <p class="text-gray-600 mb-1">Drag & drop or click to upload</p>
                            <p class="text-xs text-gray-400">JPG, PNG, or PDF (max 5MB)</p>
                        </div>
                        <div x-show="formData.nid_back" class="text-center text-green-600">
                            <svg class="mx-auto h-10 w-10 mb-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <p class="font-medium" x-text="getFileName('nid_back')"></p>
                            <button type="button" @click="formData.nid_back = null" class="mt-2 text-sm text-red-600 hover:text-red-700">Remove</button>
                        </div>
                    </div>
                </label>
                <x-input-error :messages="errors.nid_back" class="mt-2" />
            </div>

            <!-- Driving License -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 hover:border-primary-200 transition-colors">
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900">Driving License</h3>
                        <p class="text-sm text-gray-500 mt-1">Valid driving license (front side with photo)</p>
                    </div>
                </div>
                <label class="relative cursor-pointer w-full">
                    <input type="file" id="driving_license" name="driving_license" accept="image/*,.pdf"
                           x-ref="driving_license" @change="handleFileUpload('driving_license', $event)"
                           class="sr-only" required>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary-400 hover:bg-primary-50 transition-colors"
                         @dragover.prevent @dragleave.prevent @drop.prevent="handleFileUpload('driving_license', $event)">
                        <div x-show="!formData.driving_license" class="text-center">
                            <svg class="mx-auto h-10 w-10 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <p class="text-gray-600 mb-1">Drag & drop or click to upload</p>
                            <p class="text-xs text-gray-400">JPG, PNG, or PDF (max 5MB)</p>
                        </div>
                        <div x-show="formData.driving_license" class="text-center text-green-600">
                            <svg class="mx-auto h-10 w-10 mb-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <p class="font-medium" x-text="getFileName('driving_license')"></p>
                            <button type="button" @click="formData.driving_license = null" class="mt-2 text-sm text-red-600 hover:text-red-700">Remove</button>
                        </div>
                    </div>
                </label>
                <x-input-error :messages="errors.driving_license" class="mt-2" />
            </div>
        </section>

        <!-- Document Requirements Info -->
        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">
            <h3 class="font-semibold text-blue-900 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                Document Requirements
            </h3>
            <ul class="space-y-2 text-sm text-blue-800">
                <li class="flex items-center gap-2"><svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Clear, readable photos or scans</li>
                <li class="flex items-center gap-2"><svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> All four corners visible</li>
                <li class="flex items-center gap-2"><svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> File size under 5MB each</li>
                <li class="flex items-center gap-2"><svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Valid (not expired) documents only</li>
            </ul>
        </div>

        <div class="flex justify-between gap-4 pt-4 border-t border-gray-100">
            <button type="button" @click="prevStep()"
                    class="px-8 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                <svg class="w-5 h-5 mr-2 inline" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                Back
            </button>
            <button type="submit"
                    class="px-8 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                Continue to Review
                <svg class="w-5 h-5 ml-2 inline" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
            </button>
        </div>
    </form>
</x-driver-application.layout>