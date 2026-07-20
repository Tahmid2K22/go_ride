<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm font-medium text-gray-500">Pending Applications</h3>
                    <p class="mt-2 text-3xl font-bold text-yellow-600">
                        {{ \App\Models\RiderApplication::where('status', 'pending')->count() }}
                    </p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm font-medium text-gray-500">Total Drivers</h3>
                    <p class="mt-2 text-3xl font-bold text-green-600">
                        {{ \App\Models\User::where('role', 'driver')->count() }}
                    </p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm font-medium text-gray-500">Total Riders</h3>
                    <p class="mt-2 text-3xl font-bold text-blue-600">
                        {{ \App\Models\User::where('role', 'rider')->count() }}
                    </p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                <div class="flex gap-4">
                    <a href="{{ route('admin.applications.index') }}" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                        View Driver Applications
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
