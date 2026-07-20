<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Driver Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <h3 class="text-lg font-medium text-gray-900">Pending & Processed Applications</h3>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                                Dashboard
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="p-4 bg-gray-50 border-b border-gray-200">
                    <form method="GET" class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <select name="status" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <select name="vehicle_type" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                <option value="">All Vehicle Types</option>
                                <option value="bike" {{ request('vehicle_type') === 'bike' ? 'selected' : '' }}>Bike</option>
                                <option value="car" {{ request('vehicle_type') === 'car' ? 'selected' : '' }}>Car</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <input type="date" name="date_from" value="{{ request('date_from') }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" placeholder="From Date">
                        </div>
                        <div class="flex-1">
                            <input type="date" name="date_to" value="{{ request('date_to') }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" placeholder="To Date">
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">Filter</button>
                            <a href="{{ route('admin.applications.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Clear</a>
                        </div>
                    </form>
                </div>

                <!-- Applications Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">License Plate</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($applications as $application)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $application->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $application->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $application->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $application->phone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($application->vehicle_type === 'bike') bg-green-100 text-green-800
                                        @elseif($application->vehicle_type === 'car') bg-amber-100 text-amber-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $application->getVehicleTypeLabel() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">{{ $application->license_plate }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($application->status === 'approved') bg-green-100 text-green-800
                                        @elseif($application->status === 'rejected') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $application->created_at->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.applications.show', $application) }}" class="text-primary-600 hover:text-primary-900 mr-3">View</a>
                                    @if($application->status === 'pending')
                                        <form action="{{ route('admin.applications.approve', $application) }}" method="POST" class="inline" onsubmit="return confirm('Approve this application and create driver account?')">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900 mr-3">Approve</button>
                                        </form>
                                        <button onclick="showRejectModal({{ $application->id }})" class="text-red-600 hover:text-red-900">Reject</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center text-gray-500">No applications found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $applications->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Reject Application</h3>
                <form id="rejectForm" method="POST">
                    @csrf
                    <input type="hidden" name="rejection_reason" id="rejectionReasonInput">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Reason for Rejection</label>
                        <textarea name="rejection_reason" id="rejectionReason" rows="4" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" required placeholder="Enter reason for rejection..."></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="hideRejectModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let currentApplicationId = null;

        function showRejectModal(id) {
            currentApplicationId = id;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function hideRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectionReason').value = '';
            currentApplicationId = null;
        }

        document.getElementById('rejectForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const reason = document.getElementById('rejectionReason').value;
            if (!reason.trim()) {
                alert('Please enter a rejection reason');
                return;
            }
            
            // Update form action and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/applications/${currentApplicationId}/reject`;
            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            form.innerHTML = `<input type="hidden" name="_token" value="${csrf}"><input type="hidden" name="rejection_reason" value="${reason}">`;
            document.body.appendChild(form);
            form.submit();
        });
    </script>
</x-app-layout>