<x-driver-application.layout :steps="['Personal Info', 'Vehicle Info', 'Documents & Review']" :currentStep="3" :title="'Upload Documents'">
    <form action="{{ route('driver-apply.submit') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
        @csrf
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
                    <input type="file" id="nid_front" name="nid_front" accept="image/jpeg,image/png,application/pdf" required
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    @error('nid_front') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
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
                    <input type="file" id="nid_back" name="nid_back" accept="image/jpeg,image/png,application/pdf" required
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    @error('nid_back') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
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
                    <input type="file" id="driving_license" name="driving_license" accept="image/jpeg,image/png,application/pdf" required
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    @error('driving_license') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

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
            <a href="{{ route('driver-apply.step2') }}"
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
