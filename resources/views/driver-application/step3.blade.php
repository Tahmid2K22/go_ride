<x-driver-application.layout :steps="['Personal Info', 'Documents', 'Review']" :currentStep="2" :title="'Upload Documents'">
    <form x-data="driverForm" @submit.prevent="nextStep" class="space-y-8" enctype="multipart/form-data">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Upload Required Documents</h1>
            <p class="mt-2 text-gray-500">We need to verify your identity and driving credentials</p>
        </div>

        <!-- Document Upload Grid -->
        <div class="grid gap-6">
            <!-- NID Front -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 hover:border-primary-200 transition-colors">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900">NID / Passport - Front Side</h3>
                        <p class="text-sm text-gray-500 mt-1">Clear photo of the front side of your National ID or Passport</p>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="relative cursor-pointer w-full">
                        <input type="file" id="nid_front" name="nid_front" accept="image/jpeg,image/png,application/pdf"
                               x-ref="nid_front" @change="handleFileUpload('nid_front', $event)"
                               class="sr-only" required>
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary-400 hover:bg-primary-50 transition-colors">
                            <svg class="w-10 h-10 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <p class="text-gray-600 mb-1">Drag & drop or click to upload</p>
                            <p class="text-xs text-gray-400">JPG, PNG, or PDF (max 5MB)</p>
                        </div>
                    </label>
                    <x-input-error :messages="errors.nid_front" class="mt-2" />
                    <template x-if="getFileName('nid_front')">
                        <div class="mt-2 p-2 bg-green-50 rounded-lg flex items-center gap-2 text-green-700 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            <span x-text="getFileName('nid_front')"></span>
                        </div>
                    </template>
                </div>
            </div>

            <!-- NID Back -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 hover:border-primary-200 transition-colors">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900">NID / Passport - Back Side</h3>
                        <p class="text-sm text-gray-500 mt-1">Clear photo of the back side of your National ID or Passport</p>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="relative cursor-pointer w-full">
                        <input type="file" id="nid_back" name="nid_back" accept="image/jpeg,image/png,application/pdf"
                               x-ref="nid_back" @change="handleFileUpload('nid_back', $event)"
                               class="sr-only" required>
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary-400 hover:bg-primary-50 transition-colors">
                            <svg class="w-10 h-10 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <p class="text-gray-600 mb-1">Drag & drop or click to upload</p>
                            <p class="text-xs text-gray-400">JPG, PNG, or PDF (max 5MB)</p>
                        </div>
                    </label>
                    <x-input-error :messages="errors.nid_back" class="mt-2" />
                    <template x-if="getFileName('nid_back')">
                        <div class="mt-2 p-2 bg-green-50 rounded-lg flex items-center gap-2 text-green-700 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            <span x-text="getFileName('nid_back')"></span>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Driving License -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 hover:border-primary-200 transition-colors">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-xl bg-green-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900">Driving License</h3>
                        <p class="text-sm text-gray-500 mt-1">Valid driving license (front side with photo)</p>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="relative cursor-pointer w-full">
                        <input type="file" id="driving_license" name="driving_license" accept="image/jpeg,image/png,application/pdf"
                               x-ref="driving_license" @change="handleFileUpload('driving_license', $event)"
                               class="sr-only" required>
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary-400 hover:bg-primary-50 transition-colors">
                            <svg class="w-10 h-10 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <p class="text-gray-600 mb-1">Drag & drop or click to upload</p>
                            <p class="text-xs text-gray-400">JPG, PNG, or PDF (max 5MB)</p>
                        </div>
                    </label>
                    <x-input-error :messages="errors.driving_license" class="mt-2" />
                    <template x-if="getFileName('driving_license')">
                        <div class="mt-2 p-2 bg-green-50 rounded-lg flex items-center gap-2 text-green-700 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            <span x-text="getFileName('driving_license')"></span>
                        </div>
                    </template>
                </div>
            </div>
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