<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Application Details') }} #{{ $application->id }}
            </h2>
            <div class="flex gap-3">
                @if($application->status === 'pending')
                    <form action="{{ route('admin.applications.approve', $application) }}" method="POST" class="inline" onsubmit="return confirm('Approve this application and create driver account?')">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Approve</button>
                    </form>
                    <button onclick="showRejectModal()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Reject</button>
                @endif
                <a href="{{ route('admin.applications.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Status Badge -->
            <div class="mb-6">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                    @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($application->status === 'approved') bg-green-100 text-green-800
                    @elseif($application->status === 'rejected') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ ucfirst($application->status) }}
                    @if($application->status === 'approved')
                        <span class="ml-2 text-xs opacity-75">Approved {{ $application->approved_at->format('M d, Y H:i') }}</span>
                    @endif
                </span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Personal Info -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Personal Information</h3>
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm text-gray-500">Full Name</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $application->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-500">Email</dt>
                                <dd class="text-sm text-gray-900">{{ $application->email }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-500">Phone</dt>
                                <dd class="text-sm text-gray-900">{{ $application->phone }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-500">Applied On</dt>
                                <dd class="text-sm text-gray-900">{{ $application->created_at->format('M d, Y H:i') }}</dd>
                            </div>
                            @if($application->status === 'approved')
                            <div>
                                <dt class="text-sm text-gray-500">Approved On</dt>
                                <dd class="text-sm text-gray-900">{{ $application->approved_at->format('M d, Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-500">Approved By</dt>
                                <dd class="text-sm text-gray-900">{{ $application->approver?->name ?? 'N/A' }}</dd>
                            </div>
                            @endif
                            @if($application->status === 'rejected')
                            <div class="sm:col-span-2">
                                <dt class="text-sm text-gray-500">Rejection Reason</dt>
                                <dd class="text-sm text-red-600 mt-1">{{ $application->rejection_reason }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>

                    <!-- Vehicle Info -->
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Vehicle Information</h3>
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm text-gray-500">Vehicle Type</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($application->vehicle_type === 'bike') bg-green-100 text-green-800
                                        @elseif($application->vehicle_type === 'car') bg-amber-100 text-amber-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $application->getVehicleTypeLabel() }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-500">License Plate</dt>
                                <dd class="text-sm font-mono font-medium text-gray-900">{{ $application->license_plate }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Documents -->
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Verification Documents</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            @foreach(['nid_front' => 'NID Front', 'nid_back' => 'NID Back', 'driving_license' => 'Driving License'] as $key => $label)
                            <div>
                                <dt class="text-sm text-gray-500 mb-2">{{ $label }}</dt>
                                @if($application->getDocument($key))
                                    <a href="{{ asset('storage/' . $application->getDocument($key)) }}" target="_blank" class="block">
                                        <img src="{{ asset('storage/' . $application->getDocument($key)) }}" alt="{{ $label }}" class="w-full h-48 object-cover rounded-lg border border-gray-200 hover:border-primary-500 transition cursor-pointer">
                                        <p class="text-xs text-gray-500 mt-1 text-center">Click to view full size</p>
                                    </a>
                                @else
                                    <div class="w-full h-48 bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center text-gray-400">Not uploaded</div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Sidebar Actions -->
                <div class="space-y-4">
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            @if($application->status === 'pending')
                                <form action="{{ route('admin.applications.approve', $application) }}" method="POST" onsubmit="return confirm('Approve this application and create driver account? Credentials will be emailed.')">
                                    @csrf
                                    <button type="submit" class="w-full px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium">
                                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></path></svg>
                                        Approve & Register Driver
                                    </button>
                                </form>
                                <button onclick="showRejectModal()" class="w-full px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></path></svg>
                                    Reject Application
                                </button>
                            @elseif($application->status === 'approved')
                                <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                                    <p class="text-sm text-green-800">This application was approved on {{ $application->approved_at->format('M d, Y') }}.</p>
                                    <p class="text-sm text-green-700 mt-1">Driver credentials were sent to {{ $application->email }}.</p>
                                </div>
                            @elseif($application->status === 'rejected')
                                <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                                    <p class="text-sm text-red-800">This application was rejected.</p>
                                    <p class="text-sm text-red-700 mt-1">Reason: {{ $application->rejection_reason }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Timeline</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Application Submitted</p>
                                    <p class="text-sm text-gray-500">{{ $application->created_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                            @if($application->status === 'approved')
                            <div class="flex items-start">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Application Approved</p>
                                    <p class="text-sm text-gray-500">{{ $application->approved_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4H5z"/></path></svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Credentials Email Sent</p>
                                    <p class="text-sm text-gray-500">Sent to {{ $application->email }}</p>
                                </div>
                            </div>
                            @elseif($application->status === 'rejected')
                            <div class="flex items-start">
                                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></path></svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Application Rejected</p>
                                    <p class="text-sm text-gray-500">{{ $application->updated_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Reject Application</h3>
            <form id="rejectForm" method="POST" action="{{ route('admin.applications.reject', $application) }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Reason for Rejection</label>
                    <textarea name="rejection_reason" rows="4" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" required placeholder="Enter reason for rejection..."></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="hideRejectModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Reject</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }
        function hideRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-app-layout>