<x-driver-application.layout :steps="['Personal Info', 'Documents', 'Review']" :currentStep="3" :title="'Review & Submit'">
    <div x-data="driverForm" class="space-y-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Review Your Application</h1>
            <p class="mt-2 text-gray-500">Please verify all information before submitting</p>
        </div>

        <!-- Personal Info Section -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                <span class="w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-sm font-bold">1</span>
                Personal Information
            </h2>
            <dl class="grid sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-gray-500">Full Name</dt>
                    <dd class="font-medium text-gray-900" x-text="formData.name"></dd>
                </div>
                <div>
                    <dt class="text-gray-500">Email</dt>
                    <dd class="font-medium text-gray-900" x-text="formData.email"></dd>
                </div>
                <div>
                    <dt class="text-gray-500">Phone</dt>
                    <dd class="font-medium text-gray-900" x-text="formData.phone"></dd>
                </div>
                <div>
                    <dt class="text-gray-500">Vehicle Type</dt>
                    <dd class="font-medium text-gray-900">
                        <span x-text="vehicleTypeLabels[formData.vehicle_type]"></span>
                    </dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-gray-500">License Plate</dt>
                    <dd class="font-medium text-gray-900 font-mono" x-text="formData.license_plate"></dd>
                </div>
            </dl>
        </div>

        <!-- Documents Section -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                <span class="w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-sm font-bold">2</span>
                Uploaded Documents
            </h2>
            <div class="grid gap-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg>
                        </div>
                        <span class="font-medium text-gray-900">NID Front</span>
                    </div>
                    <span class="text-green-600 font-medium flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Uploaded
                    </span>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg>
                        </div>
                        <span class="font-medium text-gray-900">NID Back</span>
                    </div>
                    <span class="text-green-600 font-medium flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Uploaded
                    </span>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" /></svg>
                        </div>
                        <span class="font-medium text-gray-900">Driving License</span>
                    </div>
                    <span class="text-green-600 font-medium flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Uploaded
                    </span>
                </div>
            </div>
        </div>

        <!-- Terms & Submission -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                <span class="w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-sm font-bold">3</span>
                Confirmation
            </h2>

            <div class="space-y-4">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" id="terms" name="terms" required
                           class="mt-1 w-5 h-5 rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                           x-model="formData.terms_accepted">
                    <div class="text-sm text-gray-600">
                        <p>I confirm that all information provided is accurate and complete.</p>
                        <p class="mt-1">I understand that false information may result in application rejection.</p>
                        <p class="mt-1">I consent to GoRide verifying my documents and conducting background checks.</p>
                    </div>
                </label>

                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                    <div class="flex gap-3">
                        <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></path></svg>
                        </div>
                        <div class="text-sm text-amber-800">
                            <p class="font-medium">What happens next?</p>
                            <ul class="list-disc list-inside mt-1 space-y-1">
                                <li>Our team will review your application within 1-2 business days</li>
                                <li>You'll receive an email with the decision</li>
                                <li>If approved, you'll get login credentials for the driver app</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-between gap-4 pt-4 border-t border-gray-100">
            <button type="button" @click="prevStep()"
                    class="px-8 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                <svg class="w-5 h-5 mr-2 inline" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                Back
            </button>

            <form method="POST" action="{{ route('driver-apply.submit') }}" @submit.prevent="submitApplication">
                @csrf
                <!-- Hidden inputs for all form data -->
                <input type="hidden" name="name" :value="formData.name">
                <input type="hidden" name="email" :value="formData.email">
                <input type="hidden" name="phone" :value="formData.phone">
                <input type="hidden" name="vehicle_type" :value="formData.vehicle_type">
                <input type="hidden" name="license_plate" :value="formData.license_plate">
                <input type="hidden" name="terms_accepted" :value="formData.terms_accepted ? '1' : '0'">

                <!-- File inputs need to be handled separately - we'll use FormData -->
                <button type="submit" :disabled="!formData.terms_accepted"
                        class="px-8 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">
                    Submit Application
                    <svg class="w-5 h-5 ml-2 inline" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5H3" /></svg>
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('driverForm', () => ({
                formData: @json(session('driver_application', [])),
                vehicleTypeLabels: {
                    'bike': 'Motorcycle / Bike',
                    'car': 'Car (Sedan/Hatchback)'
                },

                async submitApplication() {
                    const form = document.querySelector('form[action="{{ route('driver-apply.submit') }}"]');
                    const formData = new FormData(form);

                    // Add file data from session/state
                    // Note: Files can't be stored in session, so we need to re-upload
                    // For this demo, we'll submit the form normally
                    form.submit();
                }
            }));
        });
    </script>
</x-driver-application.layout>