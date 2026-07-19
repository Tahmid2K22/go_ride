<x-driver-application.layout :steps="['Personal Info', 'Documents', 'Review']" :currentStep="3" :title="'Application Submitted'">
    <div class="text-center py-12">
        <!-- Success Animation -->
        <div class="mx-auto mb-8">
            <div class="w-24 h-24 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>

        <h1 class="text-3xl font-extrabold text-gray-900 mb-4">Application Received!</h1>
        <p class="text-lg text-gray-600 mb-8 max-w-xl mx-auto">
            Thank you for applying to drive with GoRide. Our admin team will review your documents and get back to you within 24-48 hours.
        </p>

        <!-- What happens next -->
        <div class="bg-white rounded-2xl border border-gray-200 p-8 mb-8 text-left max-w-xl mx-auto">
            <h2 class="font-semibold text-gray-900 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.05-.65.66-1.15 1.31-.15l15.18 15.18a1.5 1.5 0 010 2.121l-1.06 1.06a1.5 1.5 0 01-2.12 0l-13.394-13.394a1.5 1.5 0 01.15-1.31z" /></svg>
                What happens next?
            </h2>
            <div class="space-y-4">
                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center flex-shrink-0 text-lg font-bold">1</div>
                    <div>
                        <h3 class="font-medium text-gray-900">Document Verification</h3>
                        <p class="text-sm text-gray-500 mt-1">Our team will verify your NID/Passport and driving license authenticity.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center flex-shrink-0 text-lg font-bold">2</div>
                    <div>
                        <h3 class="font-medium text-gray-900">Background Check</h3>
                        <p class="text-sm text-gray-500 mt-1">Standard background verification for safety and compliance.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center flex-shrink-0 text-lg font-bold">3</div>
                    <div>
                        <h3 class="font-medium text-gray-900">Account Creation</h3>
                        <p class="text-sm text-gray-500 mt-1">If approved, we'll create your driver account and send login credentials via email.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-4 bg-green-50 rounded-xl border border-green-100">
                    <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0 text-lg font-bold">4</div>
                    <div>
                        <h3 class="font-medium text-gray-900">Start Earning!</h3>
                        <p class="text-sm text-gray-500 mt-1">Log in to the driver app, go online, and start accepting rides.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 mb-8 max-w-xl mx-auto">
            <h3 class="font-semibold text-blue-900 mb-2">Questions?</h3>
            <p class="text-blue-800 text-sm">Our support team is here to help. Contact us at <a href="mailto:support@goride.com" class="underline font-medium">support@goride.com</a> or call <a href="tel:+8801XXXXXXXXX" class="underline font-medium">+880 1XXX-XXXXXX</a></p>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="px-8 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors">
                Back to Home
            </a>
            <a href="{{ route('login') }}" class="px-8 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                Driver Sign In
            </a>
        </div>
    </div>
</x-driver-application.layout>