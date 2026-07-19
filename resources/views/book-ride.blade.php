<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <div class="fixed inset-0 z-40"
         x-data="rideBooking({
             services: {{ Js::from($services->map(fn($s) => ['id' => $s->id, 'name' => $s->name, 'icon' => $s->icon, 'base_fare' => $s->base_fare, 'per_km_rate' => $s->per_km_rate])) }},
             orsApiKey: '{{ config('services.ors.key') }}',
             errors: {{ Js::from($errors->getMessages()) }}
         })"
         x-init="init()">

        <!-- Full Screen Map -->
        <div id="ride-map" class="absolute inset-0"></div>

        <!-- Back Button -->
        <a href="{{ route('dashboard') }}" class="absolute top-4 left-4 z-50 bg-white rounded-full shadow-lg p-3 hover:bg-gray-50 transition">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        </a>

        <!-- Locate Me Button -->
        <button @click="locateMe()" class="absolute top-4 right-4 z-50 bg-white rounded-full shadow-lg p-3 hover:bg-gray-50 transition">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
        </button>

        <!-- Top Step Indicator -->
        <div class="absolute top-4 left-1/2 -translate-x-1/2 z-50 bg-white rounded-full shadow-lg px-4 py-2 flex items-center gap-2">
            <template x-if="step === 'location'">
                <span class="text-sm font-semibold text-gray-800">{{ __('app.set_location') }}</span>
            </template>
            <template x-if="step === 'service'">
                <span class="text-sm font-semibold text-gray-800">{{ __('app.choose_ride') }}</span>
            </template>
            <template x-if="step === 'confirm'">
                <span class="text-sm font-semibold text-gray-800">{{ __('app.confirm_ride') }}</span>
            </template>
        </div>

        <!-- Step 1 & 2: Bottom Sheet - Location + Service -->
        <div x-show="step === 'location' || step === 'service'"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full"
             class="absolute bottom-0 left-0 right-0 z-50 bg-white rounded-t-3xl shadow-2xl max-h-[70vh] overflow-y-auto">

            <!-- Drag Handle -->
            <div class="flex justify-center pt-3 pb-2">
                <div class="w-10 h-1 bg-gray-300 rounded-full"></div>
            </div>

            <div class="px-5 pb-8">
                <!-- Pickup Input -->
                <div class="mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-green-500 shrink-0"></div>
                        <div class="flex-1 relative">
                            <input type="text" x-model="pickupAddress"
                                   @input.debounce.500ms="geocodePickup()"
                                   class="w-full bg-gray-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500"
                                   placeholder="{{ __('app.pickup_placeholder') }}">
                            <div class="absolute right-3 top-1/2 -translate-y-1/2" x-show="pickupLoading" x-transition>
                                <div class="w-4 h-4 border-2 border-primary-500 border-t-transparent rounded-full animate-spin"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dropoff Input -->
                <div class="mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-red-500 shrink-0"></div>
                        <div class="flex-1 relative">
                            <input type="text" x-model="dropoffAddress"
                                   @input.debounce.500ms="geocodeDropoff()"
                                   class="w-full bg-gray-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500"
                                   placeholder="{{ __('app.dropoff_placeholder') }}">
                            <div class="absolute right-3 top-1/2 -translate-y-1/2" x-show="dropoffLoading" x-transition>
                                <div class="w-4 h-4 border-2 border-primary-500 border-t-transparent rounded-full animate-spin"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="pickup_address" :value="pickupAddress">
                <input type="hidden" name="pickup_lat" :value="pickupLat">
                <input type="hidden" name="pickup_lng" :value="pickupLng">
                <input type="hidden" name="dropoff_address" :value="dropoffAddress">
                <input type="hidden" name="dropoff_lat" :value="dropoffLat">
                <input type="hidden" name="dropoff_lng" :value="dropoffLng">

                <!-- Distance & Time -->
                <div x-show="distance > 0" class="flex items-center gap-4 mb-4 px-1">
                    <div class="flex items-center gap-1.5 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" /></svg>
                        <span x-text="distance.toFixed(1) + ' km'"></span>
                    </div>
                    <div class="flex items-center gap-1.5 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span x-text="estimatedTime + ' min'"></span>
                    </div>
                </div>

                <!-- Service Selection (Step 2) -->
                <div x-show="step === 'service'" x-transition class="mb-4">
                    <p class="text-sm font-semibold text-gray-700 mb-3">{{ __('app.select_service') }}</p>
                    <div class="space-y-2">
                        @foreach($services as $service)
                            <label class="flex items-center gap-4 p-4 rounded-2xl border-2 cursor-pointer transition-all duration-200"
                                   :class="selectedServiceId == {{ $service->id }} ? 'border-primary-500 bg-primary-50' : 'border-gray-100 hover:border-gray-200'"
                                   @click="selectService({{ $service->id }})">
                                <div class="text-3xl">{{ $service->icon }}</div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900">{{ $service->name }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5" x-text="estimatedTime + ' min'"></p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900" x-text="'TK ' + ({{ $service->base_fare }} + {{ $service->per_km_rate }} * (distance > 0 ? distance : 5)).toFixed(0)"></p>
                                    <p class="text-xs text-gray-500">{{ __('app.fare') }}</p>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center"
                                     :class="selectedServiceId == {{ $service->id }} ? 'border-primary-500 bg-primary-500' : 'border-gray-300'">
                                    <svg x-show="selectedServiceId == {{ $service->id }}" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Error Messages -->
                <div x-show="errors.length > 0" class="mb-4 p-3 bg-red-50 rounded-xl">
                    <template x-for="err in errors" :key="err">
                        <p class="text-sm text-red-600" x-text="err"></p>
                    </template>
                </div>

                <!-- Action Button -->
                <template x-if="step === 'location'">
                    <button @click="step = 'service'"
                            :disabled="!pickupLat || !dropoffLat"
                            :class="{ 'opacity-50 cursor-not-allowed': !pickupLat || !dropoffLat }"
                            class="w-full py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-2xl transition text-lg">
                        {{ __('app.choose_ride') }}
                    </button>
                </template>
                <template x-if="step === 'service'">
                    <button @click="step = 'confirm'"
                            :disabled="!selectedServiceId"
                            :class="{ 'opacity-50 cursor-not-allowed': !selectedServiceId }"
                            class="w-full py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-2xl transition text-lg">
                        {{ __('app.confirm_ride') }}
                    </button>
                </template>
            </div>
        </div>

        <!-- Step 3: Confirm Booking -->
        <div x-show="step === 'confirm'"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full"
             class="absolute bottom-0 left-0 right-0 z-50 bg-white rounded-t-3xl shadow-2xl">

            <div class="flex justify-center pt-3 pb-2">
                <div class="w-10 h-1 bg-gray-300 rounded-full"></div>
            </div>

            <div class="px-5 pb-8">
                <!-- Back to service selection -->
                <button @click="step = 'service'" class="flex items-center gap-1 text-sm text-gray-500 mb-4 hover:text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    {{ __('app.back') }}
                </button>

                <!-- Ride Summary -->
                <div class="bg-gray-50 rounded-2xl p-4 mb-4">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <p class="text-sm text-gray-700" x-text="pickupAddress || '---'"></p>
                    </div>
                    <div class="w-px h-4 bg-gray-300 ml-1.5 mb-3"></div>
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <p class="text-sm text-gray-700" x-text="dropoffAddress || '---'"></p>
                    </div>
                </div>

                <!-- Fare Breakdown -->
                <div class="mb-4 space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">{{ __('app.distance') }}</span>
                        <span class="text-sm font-semibold" x-text="distance.toFixed(2) + ' km'"></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">{{ __('app.estimated_time') }}</span>
                        <span class="text-sm font-semibold" x-text="estimatedTime + ' min'"></span>
                    </div>
                    <div class="border-t border-gray-100 pt-2 flex justify-between items-center">
                        <span class="font-semibold text-gray-800">{{ __('app.total_fare') }}</span>
                        <span class="text-xl font-bold text-primary-600" x-text="'TK ' + estimatedFare.toFixed(2)"></span>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('app.payment_method') }}</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative cursor-pointer" @click="paymentMethod = 'cash'">
                            <input type="radio" name="payment_method" value="cash" class="peer sr-only" :checked="paymentMethod === 'cash'">
                            <div class="p-3 rounded-xl border-2 flex items-center gap-2 transition-all"
                                 :class="paymentMethod === 'cash' ? 'border-primary-500 bg-primary-50' : 'border-gray-200'">
                                <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                                </div>
                                <p class="font-semibold text-sm text-gray-900">Cash</p>
                            </div>
                        </label>
                        <label class="relative cursor-pointer" @click="paymentMethod = 'bkash'">
                            <input type="radio" name="payment_method" value="bkash" class="peer sr-only" :checked="paymentMethod === 'bkash'">
                            <div class="p-3 rounded-xl border-2 flex items-center gap-2 transition-all"
                                 :class="paymentMethod === 'bkash' ? 'border-primary-500 bg-primary-50' : 'border-gray-200'">
                                <div class="w-8 h-8 rounded-lg bg-pink-100 flex items-center justify-center shrink-0">
                                    <span class="text-pink-600 font-bold text-xs">bK</span>
                                </div>
                                <p class="font-semibold text-sm text-gray-900">bKash</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Confirm Button -->
                <form method="POST" action="{{ route('rides.store') }}">
                    @csrf
                    <input type="hidden" name="service_id" :value="selectedServiceId">
                    <input type="hidden" name="pickup_address" :value="pickupAddress">
                    <input type="hidden" name="pickup_lat" :value="pickupLat">
                    <input type="hidden" name="pickup_lng" :value="pickupLng">
                    <input type="hidden" name="dropoff_address" :value="dropoffAddress">
                    <input type="hidden" name="dropoff_lat" :value="dropoffLat">
                    <input type="hidden" name="dropoff_lng" :value="dropoffLng">
                    <input type="hidden" name="payment_method" :value="paymentMethod">

                    <button type="submit"
                            :disabled="!canSubmit"
                            :class="{ 'opacity-50 cursor-not-allowed': !canSubmit }"
                            class="w-full py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-2xl transition text-lg shadow-lg shadow-primary-600/30">
                        {{ __('app.confirm_booking') }} &mdash; <span x-text="'TK ' + estimatedFare.toFixed(2)"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function rideBooking({ services, orsApiKey, errors }) {
            return {
                services,
                orsApiKey,
                errors,
                step: 'location',
                selectedServiceId: null,
                pickupAddress: '',
                pickupLat: null,
                pickupLng: null,
                dropoffAddress: '',
                dropoffLat: null,
                dropoffLng: null,
                paymentMethod: 'cash',
                distance: 0,
                estimatedTime: 0,
                pickupLoading: false,
                dropoffLoading: false,
                map: null,
                pickupMarker: null,
                dropoffMarker: null,
                routeLine: null,

                init() {
                    this.initMap();
                },

                initMap() {
                    this.map = L.map('ride-map', {
                        zoomControl: false,
                    }).setView([23.8103, 90.4125], 12);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19,
                    }).addTo(this.map);

                    this.map.on('click', (e) => {
                        if (!this.pickupLat) {
                            this.placePickup(e.latlng.lat, e.latlng.lng);
                        } else if (!this.dropoffLat) {
                            this.placeDropoff(e.latlng.lat, e.latlng.lng);
                        }
                    });
                },

                locateMe() {
                    if (!navigator.geolocation) return;
                    navigator.geolocation.getCurrentPosition(
                        (pos) => {
                            const { latitude, longitude } = pos.coords;
                            this.map.setView([latitude, longitude], 15);
                            if (!this.pickupLat) {
                                this.placePickup(latitude, longitude);
                            }
                        },
                        () => {}
                    );
                },

                placePickup(lat, lng) {
                    this.pickupLat = lat;
                    this.pickupLng = lng;
                    if (this.pickupMarker) this.map.removeLayer(this.pickupMarker);

                    const icon = L.divIcon({
                        className: '',
                        html: '<div style="background:#10b981;width:28px;height:28px;border-radius:50%;border:3px solid white;box-shadow:0 2px 8px rgba(0,0,0,0.3);"></div>',
                        iconSize: [28, 28],
                        iconAnchor: [14, 14],
                    });
                    this.pickupMarker = L.marker([lat, lng], { icon }).addTo(this.map);
                    this.reverseGeocode(lat, lng, 'pickup');
                    this.fitMapBounds();
                    this.fetchRoute();
                },

                placeDropoff(lat, lng) {
                    this.dropoffLat = lat;
                    this.dropoffLng = lng;
                    if (this.dropoffMarker) this.map.removeLayer(this.dropoffMarker);

                    const icon = L.divIcon({
                        className: '',
                        html: '<div style="background:#ef4444;width:28px;height:28px;border-radius:50%;border:3px solid white;box-shadow:0 2px 8px rgba(0,0,0,0.3);"></div>',
                        iconSize: [28, 28],
                        iconAnchor: [14, 14],
                    });
                    this.dropoffMarker = L.marker([lat, lng], { icon }).addTo(this.map);
                    this.reverseGeocode(lat, lng, 'dropoff');
                    this.fitMapBounds();
                    this.fetchRoute();
                },

                fitMapBounds() {
                    if (this.pickupLat && this.dropoffLat) {
                        const bounds = L.latLngBounds(
                            [this.pickupLat, this.pickupLng],
                            [this.dropoffLat, this.dropoffLng]
                        );
                        this.map.fitBounds(bounds, { padding: [80, 80] });
                    } else if (this.pickupLat) {
                        this.map.setView([this.pickupLat, this.pickupLng], 15);
                    }
                },

                async reverseGeocode(lat, lng, type) {
                    try {
                        const response = await fetch(
                            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18`
                        );
                        const data = await response.json();
                        if (data.display_name) {
                            const short = data.display_name.split(',').slice(0, 3).join(',');
                            if (type === 'pickup') this.pickupAddress = short;
                            else this.dropoffAddress = short;
                        }
                    } catch (e) {
                        console.warn('Reverse geocoding failed:', e);
                    }
                },

                async geocodePickup() {
                    if (!this.pickupAddress || this.pickupAddress.length < 3) return;
                    this.pickupLoading = true;
                    try {
                        const response = await fetch(
                            `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(this.pickupAddress)}&limit=1&countrycodes=bd`
                        );
                        const data = await response.json();
                        if (data.length > 0) {
                            this.placePickup(parseFloat(data[0].lat), parseFloat(data[0].lon));
                        }
                    } catch (e) {
                        console.warn('Geocoding failed:', e);
                    } finally {
                        this.pickupLoading = false;
                    }
                },

                async geocodeDropoff() {
                    if (!this.dropoffAddress || this.dropoffAddress.length < 3) return;
                    this.dropoffLoading = true;
                    try {
                        const response = await fetch(
                            `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(this.dropoffAddress)}&limit=1&countrycodes=bd`
                        );
                        const data = await response.json();
                        if (data.length > 0) {
                            this.placeDropoff(parseFloat(data[0].lat), parseFloat(data[0].lon));
                        }
                    } catch (e) {
                        console.warn('Geocoding failed:', e);
                    } finally {
                        this.dropoffLoading = false;
                    }
                },

                async fetchRoute() {
                    if (!this.pickupLat || !this.dropoffLat) return;
                    if (!this.orsApiKey) {
                        this.calculateSimpleDistance();
                        return;
                    }
                    try {
                        const response = await fetch(
                            `https://api.openrouteservice.org/v2/directions/driving-car/geojson`,
                            {
                                method: 'POST',
                                headers: {
                                    'Authorization': this.orsApiKey,
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    coordinates: [
                                        [this.pickupLng, this.pickupLat],
                                        [this.dropoffLng, this.dropoffLat],
                                    ],
                                }),
                            }
                        );
                        if (!response.ok) throw new Error('ORS failed');
                        const data = await response.json();
                        const segment = data.features[0].properties.segments[0];
                        this.distance = segment.distance / 1000;
                        this.estimatedTime = Math.ceil(segment.duration / 60);
                        this.drawRoute(data.features[0].geometry.coordinates);
                    } catch (e) {
                        this.calculateSimpleDistance();
                    }
                },

                drawRoute(coordinates) {
                    if (this.routeLine) this.map.removeLayer(this.routeLine);
                    const latLngs = coordinates.map(c => [c[1], c[0]]);
                    this.routeLine = L.polyline(latLngs, {
                        color: '#6366f1', weight: 5, opacity: 0.8,
                    }).addTo(this.map);
                },

                calculateSimpleDistance() {
                    const R = 6371;
                    const dLat = (this.dropoffLat - this.pickupLat) * Math.PI / 180;
                    const dLng = (this.dropoffLng - this.pickupLng) * Math.PI / 180;
                    const a = Math.sin(dLat / 2) ** 2 +
                              Math.cos(this.pickupLat * Math.PI / 180) * Math.cos(this.dropoffLat * Math.PI / 180) *
                              Math.sin(dLng / 2) ** 2;
                    this.distance = R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                    this.estimatedTime = Math.ceil(this.distance * 3);

                    if (this.routeLine) this.map.removeLayer(this.routeLine);
                    this.routeLine = L.polyline(
                        [[this.pickupLat, this.pickupLng], [this.dropoffLat, this.dropoffLng]],
                        { color: '#6366f1', weight: 5, opacity: 0.8, dashArray: '10, 10' }
                    ).addTo(this.map);
                },

                get selectedService() {
                    return this.services.find(s => s.id == this.selectedServiceId) || null;
                },

                get estimatedFare() {
                    if (!this.selectedService) return 0;
                    const dist = this.distance > 0 ? this.distance : 5.0;
                    return this.selectedService.base_fare + (this.selectedService.per_km_rate * dist);
                },

                get canSubmit() {
                    return this.selectedServiceId
                        && this.pickupAddress.trim() !== ''
                        && this.dropoffAddress.trim() !== ''
                        && this.pickupLat !== null
                        && this.dropoffLat !== null;
                },

                selectService(id) {
                    this.selectedServiceId = id;
                },
            };
        }
    </script>
</x-app-layout>
