{{--
    Component: recent-trips
    Usage:     <x-recent-trips />
    Queries the ride_histories table for the authenticated user
    and renders a clean card list of past trips.
--}}

@php
    use App\Models\RideHistory;

    // Fetch the 10 most recent archived trips for the current user
    $trips = RideHistory::where('user_id', auth()->id())
        ->latest('completed_at')
        ->take(10)
        ->get();
@endphp

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    {{-- Card header --}}
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-primary-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-base font-bold text-gray-900">Recent Trips</h2>
                <p class="text-xs text-gray-500">Your last {{ $trips->count() }} ride{{ $trips->count() !== 1 ? 's' : '' }}</p>
            </div>
        </div>

        {{-- Book new ride CTA --}}
        <a href="{{ route('rides.create') }}"
           class="text-xs font-semibold text-primary-600 hover:text-primary-700 transition">
            + New Ride
        </a>
    </div>

    {{-- Trip list --}}
    @if ($trips->isEmpty())

        {{-- Empty state --}}
        <div class="flex flex-col items-center justify-center py-12 px-6 text-center">
            <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 9m0 8V9m0 0L9 7"/>
                </svg>
            </div>
            <p class="text-sm font-semibold text-gray-500">No trips yet</p>
            <p class="text-xs text-gray-400 mt-1">Your completed rides will appear here</p>
            <a href="{{ route('rides.create') }}"
               class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 text-white text-sm font-semibold hover:bg-primary-700 transition">
                Book your first ride
            </a>
        </div>

    @else

        <ul class="divide-y divide-gray-50">
            @foreach ($trips as $trip)
            <li class="flex items-start gap-4 px-6 py-4 hover:bg-gray-50 transition group">

                {{-- Vehicle icon / status indicator --}}
                <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center text-lg mt-0.5
                            {{ $trip->final_status === 'completed' ? 'bg-primary-50' : 'bg-red-50' }}">
                    @if ($trip->vehicle_type && str_contains(strtolower($trip->vehicle_type), 'moto'))
                        🏍️
                    @elseif ($trip->vehicle_type && str_contains(strtolower($trip->vehicle_type), 'premium'))
                        🚙
                    @else
                        🚗
                    @endif
                </div>

                {{-- Route details --}}
                <div class="flex-1 min-w-0">

                    {{-- Pickup → Dropoff --}}
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-2 h-2 rounded-full bg-green-500 flex-shrink-0"></span>
                        <span class="text-sm font-semibold text-gray-900 truncate">
                            {{ $trip->shortPickup() }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-red-500 flex-shrink-0"></span>
                        <span class="text-sm text-gray-600 truncate">
                            {{ $trip->shortDropoff() }}
                        </span>
                    </div>

                    {{-- Date + vehicle type --}}
                    <div class="flex items-center gap-3 mt-2">
                        <span class="text-xs text-gray-400">
                            {{ $trip->completed_at?->format('d M Y, g:i A') ?? '—' }}
                        </span>
                        @if ($trip->vehicle_type)
                            <span class="text-xs text-gray-400">·</span>
                            <span class="text-xs text-gray-500 font-medium">{{ $trip->vehicle_type }}</span>
                        @endif
                    </div>
                </div>

                {{-- Fare + status badge --}}
                <div class="flex flex-col items-end gap-2 flex-shrink-0">
                    <span class="text-sm font-bold text-gray-900">
                        ৳{{ number_format($trip->fare, 0) }}
                    </span>

                    @if ($trip->final_status === 'completed')
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full bg-primary-50 text-primary-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary-500 inline-block"></span>
                            Completed
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full bg-red-50 text-red-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 inline-block"></span>
                            Cancelled
                        </span>
                    @endif
                </div>

            </li>
            @endforeach
        </ul>

    @endif

</div>
