<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50 rounded-xl border border-emerald-200 text-emerald-700 text-sm font-medium" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 rounded-xl border border-red-200 text-red-700 text-sm font-medium" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Welcome Banner -->
            <div class="relative bg-gradient-to-r from-emerald-600 via-emerald-700 to-emerald-800 rounded-3xl p-8 sm:p-10 mb-8 overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImVudmxvcGUiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzR2MkgyVjJoMzR6TTM2IDE4djJIMnYtMmgzNHoiLz48L2c+PC9nPjwvc3ZnPg==');"></div>
                </div>
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>

                <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-white">{{ __('app.welcome') }}, {{ Auth::user()->name }}!</h1>
                        <p class="mt-3 text-emerald-100 text-lg">
                            @if($driver && $driver->is_online)
                                {{ __('app.you_are_online') }}
                            @else
                                {{ __('app.you_are_offline') }}
                            @endif
                        </p>
                    </div>
                    <div class="mt-6 sm:mt-0 flex items-center gap-4">
                        <!-- Online Toggle -->
                        <form method="POST" action="{{ route('driver.toggle-online') }}">
                            @csrf
                            <button type="submit"
                                class="relative inline-flex h-12 w-28 items-center rounded-full transition-colors duration-300 focus:outline-none
                                    {{ $driver && $driver->is_online ? 'bg-white' : 'bg-white/20 border border-white/30' }}">
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full transition-all duration-300
                                    {{ $driver && $driver->is_online ? 'translate-x-16 bg-emerald-500' : 'translate-x-2 bg-white/40' }}">
                                    @if($driver && $driver->is_online)
                                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1012.728 0M12 3v6" />
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1012.728 0M12 3v9" />
                                        </svg>
                                    @endif
                                </span>
                                <span class="absolute inset-0 flex items-center justify-center text-sm font-bold
                                    {{ $driver && $driver->is_online ? 'text-emerald-700' : 'text-white' }}">
                                    {{ $driver && $driver->is_online ? __('app.online') : __('app.offline') }}
                                </span>
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition duration-150 backdrop-blur-sm border border-white/20">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>
                                {{ __('app.log_out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="group bg-white rounded-2xl p-6 border border-gray-100 hover:border-emerald-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">{{ __('app.today_earnings') }}</p>
                            <p class="text-3xl font-extrabold text-gray-900">TK {{ number_format($todayEarnings, 2) }}</p>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl p-6 border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">{{ __('app.completed_today') }}</p>
                            <p class="text-3xl font-extrabold text-gray-900">{{ $completedToday }}</p>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl p-6 border border-gray-100 hover:border-amber-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">{{ __('app.total_earnings') }}</p>
                            <p class="text-3xl font-extrabold text-gray-900">TK {{ number_format($totalEarnings, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Ride -->
            @if($activeRide)
                <div class="bg-white rounded-2xl p-8 border border-gray-100 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900">{{ __('app.active_ride') }}</h2>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($activeRide->status === 'accepted') bg-blue-100 text-blue-700
                            @elseif($activeRide->status === 'ongoing') bg-green-100 text-green-700
                            @endif">
                            {{ __('app.status_' . $activeRide->status) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="space-y-6">
                            <!-- Rider Info -->
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">{{ __('app.rider') }}</p>
                                    <p class="font-semibold text-gray-900">{{ $activeRide->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $activeRide->user->phone }}</p>
                                </div>
                            </div>

                            <!-- Pickup / Dropoff -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">{{ __('app.pickup') }}</p>
                                        <p class="text-sm font-semibold text-gray-900 mt-1">{{ $activeRide->pickup_address }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">{{ __('app.dropoff') }}</p>
                                        <p class="text-sm font-semibold text-gray-900 mt-1">{{ $activeRide->dropoff_address }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Fare & Distance -->
                            <div class="grid grid-cols-3 gap-4">
                                <div class="p-3 bg-amber-50 rounded-xl text-center">
                                    <p class="text-xs text-amber-600 font-medium">{{ __('app.fare') }}</p>
                                    <p class="text-lg font-bold text-amber-700">TK {{ number_format($activeRide->fare_amount, 0) }}</p>
                                </div>
                                <div class="p-3 bg-blue-50 rounded-xl text-center">
                                    <p class="text-xs text-blue-600 font-medium">{{ __('app.distance') }}</p>
                                    <p class="text-lg font-bold text-blue-700">{{ number_format($activeRide->distance_km, 1) }} km</p>
                                </div>
                                <div class="p-3 bg-purple-50 rounded-xl text-center">
                                    <p class="text-xs text-purple-600 font-medium">{{ __('app.payment') }}</p>
                                    <p class="text-lg font-bold text-purple-700 capitalize">{{ $activeRide->payment_method }}</p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3">
                                @if($activeRide->status === 'accepted')
                                    <form method="POST" action="{{ route('driver.start-ride', $activeRide) }}" class="flex-1">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold transition">
                                            {{ __('app.start_ride') }}
                                        </button>
                                    </form>
                                @elseif($activeRide->status === 'ongoing')
                                    <form method="POST" action="{{ route('driver.complete-ride', $activeRide) }}" class="flex-1">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition">
                                            {{ __('app.complete_ride') }}
                                        </button>
                                    </form>
                                @endif

                                <form method="POST" action="{{ route('driver.cancel-ride', $activeRide) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-6 py-3 bg-red-100 hover:bg-red-200 text-red-700 rounded-xl font-semibold transition">
                                        {{ __('app.cancel') }}
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Active Ride Map -->
                        @if($activeRide->pickup_lat && $activeRide->dropoff_lat)
                            <div id="active-ride-map"
                                 class="h-64 lg:h-auto lg:min-h-[320px] rounded-xl overflow-hidden"
                                 data-pickup-lat="{{ $activeRide->pickup_lat }}"
                                 data-pickup-lng="{{ $activeRide->pickup_lng }}"
                                 data-dropoff-lat="{{ $activeRide->dropoff_lat }}"
                                 data-dropoff-lng="{{ $activeRide->dropoff_lng }}">
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Pending Ride Requests -->
            @if($driver && $driver->is_online && $pendingRides->count() > 0)
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">{{ __('app.ride_requests') }} ({{ $pendingRides->count() }})</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($pendingRides as $ride)
                            <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:border-primary-200 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-2">
                                        <span class="text-2xl">{{ $ride->service->icon ?? '🚗' }}</span>
                                        <span class="font-semibold text-gray-900 text-sm">{{ $ride->service->name ?? '' }}</span>
                                    </div>
                                    <span class="text-lg font-bold text-gray-900">TK {{ number_format($ride->fare_amount, 0) }}</span>
                                </div>

                                <div class="space-y-3 mb-4">
                                    <div class="flex items-start gap-2">
                                        <div class="w-2 h-2 rounded-full bg-emerald-500 mt-1.5 shrink-0"></div>
                                        <p class="text-sm text-gray-700">{{ $ride->pickup_address }}</p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <div class="w-2 h-2 rounded-full bg-red-500 mt-1.5 shrink-0"></div>
                                        <p class="text-sm text-gray-700">{{ $ride->dropoff_address }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                                    <span>{{ number_format($ride->distance_km, 1) }} km</span>
                                    <span class="capitalize">{{ $ride->payment_method }}</span>
                                </div>

                                <form method="POST" action="{{ route('driver.accept-ride', $ride) }}">
                                    @csrf
                                    <button type="submit" class="w-full py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-semibold text-sm transition">
                                        {{ __('app.accept_ride') }}
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @elseif($driver && $driver->is_online && !$activeRide)
                <div class="bg-white rounded-2xl p-12 border border-gray-100 text-center">
                    <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ __('app.waiting_for_requests') }}</h3>
                    <p class="text-gray-500">{{ __('app.no_pending_rides') }}</p>
                </div>
            @elseif($driver && !$driver->is_online)
                <div class="bg-white rounded-2xl p-12 border border-gray-100 text-center">
                    <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ __('app.you_are_offline') }}</h3>
                    <p class="text-gray-500">{{ __('app.go_online_to_receive') }}</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const activeMapEl = document.getElementById('active-ride-map');
            if (activeMapEl) {
                const pickupLat = parseFloat(activeMapEl.dataset.pickupLat);
                const pickupLng = parseFloat(activeMapEl.dataset.pickupLng);
                const dropoffLat = parseFloat(activeMapEl.dataset.dropoffLat);
                const dropoffLng = parseFloat(activeMapEl.dataset.dropoffLng);

                const map = L.map(activeMapEl).setView([pickupLat, pickupLng], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors',
                    maxZoom: 19,
                }).addTo(map);

                const pickupIcon = L.divIcon({
                    className: 'custom-marker',
                    html: '<div style="background:#10b981;width:24px;height:24px;border-radius:50%;border:3px solid white;box-shadow:0 2px 6px rgba(0,0,0,0.3);"></div>',
                    iconSize: [24, 24],
                    iconAnchor: [12, 12],
                });

                const dropoffIcon = L.divIcon({
                    className: 'custom-marker',
                    html: '<div style="background:#ef4444;width:24px;height:24px;border-radius:50%;border:3px solid white;box-shadow:0 2px 6px rgba(0,0,0,0.3);"></div>',
                    iconSize: [24, 24],
                    iconAnchor: [12, 12],
                });

                L.marker([pickupLat, pickupLng], { icon: pickupIcon }).addTo(map);
                L.marker([dropoffLat, dropoffLng], { icon: dropoffIcon }).addTo(map);

                L.polyline(
                    [[pickupLat, pickupLng], [dropoffLat, dropoffLng]],
                    { color: '#6366f1', weight: 5, opacity: 0.8, dashArray: '10, 10' }
                ).addTo(map);

                map.fitBounds(
                    L.latLngBounds([pickupLat, pickupLng], [dropoffLat, dropoffLng]),
                    { padding: [50, 50] }
                );
            }
        });
    </script>
</x-app-layout>
