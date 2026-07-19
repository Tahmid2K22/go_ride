<x-app-layout>
    {{-- ============================================================
         HEAD: Leaflet (CDN)
         ============================================================ --}}
    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <style>
        .leaflet-container .animated-dash {
            stroke-dasharray: 10, 10;
            animation: dash-draw 1.5s linear infinite;
        }
        @keyframes dash-draw {
            from { stroke-dashoffset: 0; }
            to { stroke-dashoffset: 20; }
        }
        .leaflet-container .route-line {
            filter: drop-shadow(0 2px 8px rgba(16, 185, 129, 0.3));
        }
        .vehicle-card {
            transition: all 0.2s ease;
        }
        .vehicle-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }
        .vehicle-card.selected {
            border-color: #10b981 !important;
            background-color: #ecfdf5 !important;
        }
        @media (max-width: 1023px) {
            nav.fixed.bottom-5 {
                display: none !important;
            }
            main.pb-24 {
                padding-bottom: 0 !important;
            }
        }
    </style>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    {{-- ============================================================
         PAGE SHELL — Split Side-by-Side Layout
         ============================================================ --}}
    <div class="h-screen w-screen overflow-hidden bg-gray-50 flex flex-col lg:flex-row"
         data-ride-booking
         data-services='@json($services)'>

        {{-- LEFT PANEL (40% width on desktop, containing Form and Ride choice) --}}
        <aside class="w-full lg:w-2/5 xl:w-[450px] h-[60vh] lg:h-full bg-white flex flex-col shadow-2xl z-20 overflow-y-auto order-2 lg:order-1 shrink-0">
            {{-- Header --}}
            <header class="flex items-center justify-between px-5 py-4 border-b border-gray-100 shrink-0">
                <a href="{{ route('dashboard') }}"
                   class="bg-gray-100 hover:bg-gray-200 transition rounded-full p-2"
                   aria-label="Back to dashboard">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h1 class="text-lg font-extrabold tracking-tight text-gray-900">GoRide</h1>
                <span id="step-pill"
                      class="text-xs font-bold px-3 py-1 rounded-full bg-primary-50 text-primary-700 uppercase tracking-wide">
                    Step 1 · Locations
                </span>
            </header>

            {{-- Form body --}}
            <form id="ride-form"
                  class="p-6 flex-1 space-y-6 overflow-y-auto flex flex-col justify-between"
                  method="POST"
                  action="{{ route('rides.store') }}"
                  onsubmit="return window.RideBooking.confirmBeforeSubmit();">
                @csrf

                <div class="space-y-6">
                    <h2 class="text-xl font-extrabold text-gray-900">Request a ride</h2>

                    {{-- Location Inputs Styled like the requested image --}}
                    <div class="space-y-4">
                        {{-- Pickup Input --}}
                        <div class="relative">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-1.5">Pickup Location</label>
                            <div class="flex items-center bg-gray-50 border-2 border-gray-200 rounded-2xl px-4 py-3 focus-within:border-black focus-within:bg-white transition-all">
                                <span class="w-3 h-3 rounded-full bg-black mr-3 shrink-0"></span>
                                <input id="pickup-input"
                                       name="pickup_address"
                                       type="text"
                                       autocomplete="off"
                                       placeholder="Pickup location"
                                       class="flex-1 bg-transparent border-0 p-0 text-sm focus:ring-0 focus:outline-none placeholder-gray-400 font-medium"
                                       required>
                                <button type="button" id="locate-btn-form" class="text-gray-500 hover:text-black focus:outline-none ml-2 shrink-0">
                                    <svg class="w-5 h-5 transform rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 22l10-4 10 4z"/></svg>
                                </button>
                            </div>
                            {{-- Pickup suggestions list --}}
                            <div id="pickup-suggestions" class="hidden absolute left-0 right-0 mt-1.5 bg-white border border-gray-150 rounded-2xl shadow-2xl z-30 max-h-60 overflow-y-auto"></div>
                        </div>

                        {{-- Dropoff Input --}}
                        <div class="relative">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-1.5">Dropoff Location</label>
                            <div class="flex items-center bg-gray-50 border-2 border-gray-200 rounded-2xl px-4 py-3 focus-within:border-black focus-within:bg-white transition-all">
                                <span class="w-3 h-3 bg-black mr-3 shrink-0 rounded-sm"></span>
                                <input id="dropoff-input"
                                       name="dropoff_address"
                                       type="text"
                                       autocomplete="off"
                                       placeholder="Dropoff location"
                                       class="flex-1 bg-transparent border-0 p-0 text-sm focus:ring-0 focus:outline-none placeholder-gray-400 font-medium"
                                       required>
                                <button type="button" id="clear-dropoff" class="text-gray-400 hover:text-black focus:outline-none ml-2 shrink-0 hidden">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                            {{-- Dropoff suggestions list --}}
                            <div id="dropoff-suggestions" class="hidden absolute left-0 right-0 mt-1.5 bg-white border border-gray-150 rounded-2xl shadow-2xl z-30 max-h-60 overflow-y-auto"></div>
                        </div>
                    </div>

                    {{-- Distance / ETA summary --}}
                    <div id="route-summary" class="hidden p-4 rounded-2xl bg-gray-50 border border-gray-100 flex items-center justify-between text-sm">
                        <div class="flex items-center gap-2 font-semibold text-gray-800">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m-8-5h8m-8-5h9M6 7H5a2 2 0 00-2 2v9a2 2 0 002 2h1m-1-4h1m-1-4h1" /></svg>
                            <span>Distance: <span id="distance-km">0</span> km</span>
                        </div>
                        <div class="flex items-center gap-2 font-semibold text-gray-800">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>ETA: ~<span id="eta-min">0</span> min</span>
                        </div>
                    </div>

                    {{-- ====================================================
                         STEP 2 — Vehicle selection
                         ==================================================== --}}
                    <section id="vehicle-section" class="hidden space-y-3">
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Choose your ride</h3>
                        <div id="vehicle-list" class="space-y-2 pb-2">
                            {{-- Cards injected by JS --}}
                        </div>
                        <input type="hidden" name="service_id" id="service-id" required>
                    </section>
                </div>

                {{-- Hidden Fields --}}
                <input type="hidden" name="pickup_lat" id="pickup-lat">
                <input type="hidden" name="pickup_lng" id="pickup-lng">
                <input type="hidden" name="dropoff_lat" id="dropoff-lat">
                <input type="hidden" name="dropoff_lng" id="dropoff-lng">
                <input type="hidden" name="payment_method" value="cash">
            </form>

            {{-- Footer containing Book button --}}
            <footer class="p-6 border-t border-gray-100 bg-white shrink-0">
                <button id="book-btn"
                        type="button"
                        class="w-full py-4 rounded-2xl text-white font-bold text-lg transition-all duration-200 shadow-xl flex items-center justify-center gap-3 bg-black hover:bg-gray-900 disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                    <span id="book-idle" class="flex items-center justify-center gap-2">
                        See prices
                    </span>
                    <span id="book-matching" class="hidden items-center gap-3">
                        <span class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                        Matching you with a driver...
                    </span>
                    <span id="book-success" class="hidden items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                        Ride Booked!
                    </span>
                </button>
            </footer>
        </aside>

        {{-- RIGHT PANEL (60% width on desktop, containing Leaflet map) --}}
        <main class="relative flex-1 h-[40vh] lg:h-full order-1 lg:order-2">
            <div id="ride-map" class="w-full h-full"></div>

            {{-- Floating Controls --}}
            <div class="absolute top-6 right-6 z-20 flex flex-col gap-2">
                <button id="locate-btn"
                        type="button"
                        class="bg-white rounded-xl shadow-lg p-3 hover:bg-gray-50 transition focus:outline-none"
                        title="My location">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>
        </main>
    </div>

    {{-- ============================================================
         JAVASCRIPT
         ============================================================ --}}
    <script>
    (function () {
        'use strict';

        const MOCK_FLEET = [
            { id: 'moto',     name: 'Moto',         icon: '\uD83C\uDFCD\uFE0F', etaMin: 3, priceMultiplier: 0.40 },
            { id: 'economy',  name: 'Car Economy',  icon: '\uD83D\uDE97',     etaMin: 5, priceMultiplier: 0.80 },
            { id: 'premium',  name: 'Car Premium',  icon: '\uD83D\uDE98',     etaMin: 7, priceMultiplier: 1.40 },
        ];

        const $  = (sel, root = document) => root.querySelector(sel);
        const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

        const debounce = (fn, wait = 400) => {
            let t;
            return (...args) => {
                clearTimeout(t);
                t = setTimeout(() => fn.apply(null, args), wait);
            };
        };

        const RideBooking = {
            state: {
                services: [],
                pickup:  { address: '', lat: null, lng: null },
                dropoff: { address: '', lat: null, lng: null },
                activeTarget: null,
                bookingState: 'idle',
                selectedVehicleMockId: null,
                distanceKm: 0,
                etaMin: 0,
            },

            map: null,
            pickupMarker: null,
            dropoffMarker: null,
            routeLine: null,
            pickupIcon: null,
            dropoffIcon: null,

            init() {
                const root = $('[data-ride-booking]');
                if (!root) return;
                try {
                    this.state.services = JSON.parse(root.dataset.services || '[]');
                } catch (_) {
                    this.state.services = [];
                }

                this.bindEvents();
                this.initMap();
                this.renderVehicleList();
                this.updateUi();

                window.addEventListener('resize', () => this.map && this.map.invalidateSize());
                setTimeout(() => this.map && this.map.invalidateSize(), 300);
            },

            bindEvents() {
                $('#locate-btn').addEventListener('click', () => this.locateMe());
                $('#locate-btn-form').addEventListener('click', () => this.locateMe());

                // Suggestions logic
                $('#pickup-input').addEventListener('input', debounce(() => {
                    const val = $('#pickup-input').value;
                    this.state.pickup.address = val;
                    this.fetchSuggestions(val, 'pickup');
                }, 400));

                $('#dropoff-input').addEventListener('input', debounce(() => {
                    const val = $('#dropoff-input').value;
                    this.state.dropoff.address = val;
                    this.fetchSuggestions(val, 'dropoff');
                    $('#clear-dropoff').classList.toggle('hidden', !val);
                }, 400));

                $('#clear-dropoff').addEventListener('click', () => {
                    $('#dropoff-input').value = '';
                    this.state.dropoff = { address: '', lat: null, lng: null };
                    if (this.dropoffMarker) this.map.removeLayer(this.dropoffMarker);
                    this.recomputeRoute();
                    $('#clear-dropoff').classList.add('hidden');
                    this.updateUi();
                });

                // Hide dropdowns when clicking outside
                document.addEventListener('click', (e) => {
                    if (!e.target.closest('#pickup-input')) $('#pickup-suggestions').classList.add('hidden');
                    if (!e.target.closest('#dropoff-input')) $('#dropoff-suggestions').classList.add('hidden');
                });

                $('#book-btn').addEventListener('click', () => this.bookRide());
            },

            async fetchSuggestions(query, kind) {
                const dropdown = $(`#${kind}-suggestions`);
                if (!query || query.length < 3) {
                    dropdown.classList.add('hidden');
                    return;
                }
                try {
                    const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=5&countrycodes=bd`;
                    const res = await fetch(url);
                    const data = await res.json();
                    
                    if (Array.isArray(data) && data.length > 0) {
                        dropdown.innerHTML = '';
                        dropdown.classList.remove('hidden');
                        
                        data.forEach(item => {
                            const parts = item.display_name.split(',');
                            const title = parts[0].trim();
                            const subtitle = parts.slice(1, 4).join(',').trim();
                            
                            const div = document.createElement('div');
                            div.className = 'flex items-center gap-3 px-4 py-3 hover:bg-gray-50 cursor-pointer border-b border-gray-100 last:border-0 transition';
                            div.innerHTML = `
                                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate">${title}</p>
                                    <p class="text-xs text-gray-500 truncate">${subtitle}</p>
                                </div>
                            `;
                            div.addEventListener('click', () => {
                                if (kind === 'pickup') {
                                    this.placePickup(parseFloat(item.lat), parseFloat(item.lon), item.display_name);
                                } else {
                                    this.placeDropoff(parseFloat(item.lat), parseFloat(item.lon), item.display_name);
                                }
                                dropdown.classList.add('hidden');
                            });
                            dropdown.appendChild(div);
                        });
                    } else {
                        dropdown.classList.add('hidden');
                    }
                } catch (e) {
                    console.warn('Suggestions fetch failed:', e);
                }
            },

            initMap() {
                this.map = L.map('ride-map', { zoomControl: false }).setView([23.8103, 90.4125], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors',
                    maxZoom: 19,
                }).addTo(this.map);

                this.pickupIcon = L.divIcon({
                    className: '',
                    html: '<div style="background:#000000;width:24px;height:24px;border-radius:50%;border:4px solid white;box-shadow:0 2px 8px rgba(0,0,0,.3)"></div>',
                    iconSize: [24, 24],
                    iconAnchor: [12, 12],
                });
                this.dropoffIcon = L.divIcon({
                    className: '',
                    html: '<div style="background:#000000;width:24px;height:24px;border:3px solid white;box-shadow:0 2px 8px rgba(0,0,0,.3);border-radius:2px"></div>',
                    iconSize: [24, 24],
                    iconAnchor: [12, 12],
                });
            },

            placePickup(lat, lng, address) {
                this.state.pickup.lat = lat;
                this.state.pickup.lng = lng;
                this.state.pickup.address = address;
                
                const short = address.split(',').slice(0, 3).join(',').trim();
                $('#pickup-input').value = short;

                if (this.pickupMarker) this.map.removeLayer(this.pickupMarker);
                this.pickupMarker = L.marker([lat, lng], { icon: this.pickupIcon }).addTo(this.map);
                
                $('#pickup-lat').value = lat;
                $('#pickup-lng').value = lng;
                
                this.fitBounds();
                this.recomputeRoute();
            },

            placeDropoff(lat, lng, address) {
                this.state.dropoff.lat = lat;
                this.state.dropoff.lng = lng;
                this.state.dropoff.address = address;

                const short = address.split(',').slice(0, 3).join(',').trim();
                $('#dropoff-input').value = short;
                $('#clear-dropoff').classList.remove('hidden');

                if (this.dropoffMarker) this.map.removeLayer(this.dropoffMarker);
                this.dropoffMarker = L.marker([lat, lng], { icon: this.dropoffIcon }).addTo(this.map);
                
                $('#dropoff-lat').value = lat;
                $('#dropoff-lng').value = lng;
                
                this.fitBounds();
                this.recomputeRoute();
            },

            fitBounds() {
                const { pickup, dropoff } = this.state;
                if (pickup.lat != null && dropoff.lat != null) {
                    const bounds = L.latLngBounds([pickup.lat, pickup.lng], [dropoff.lat, dropoff.lng]);
                    this.map.fitBounds(bounds, { padding: [80, 80] });
                } else if (pickup.lat != null) {
                    this.map.setView([pickup.lat, pickup.lng], 15);
                } else if (dropoff.lat != null) {
                    this.map.setView([dropoff.lat, dropoff.lng], 15);
                }
            },

            locateMe() {
                if (!navigator.geolocation) return;
                navigator.geolocation.getCurrentPosition(
                    (pos) => {
                        const { latitude, longitude } = pos.coords;
                        this.placePickup(latitude, longitude, "Current Location");
                    },
                    () => { }
                );
            },

            recomputeRoute() {
                const { pickup, dropoff } = this.state;
                if (pickup.lat == null || dropoff.lat == null) {
                    if (this.routeLine) { this.map.removeLayer(this.routeLine); this.routeLine = null; }
                    this.state.distanceKm = 0;
                    this.state.etaMin = 0;
                    this.updateUi();
                    return;
                }

                const R = 6371;
                const toRad = (deg) => deg * Math.PI / 180;
                const dLat = toRad(dropoff.lat - pickup.lat);
                const dLng = toRad(dropoff.lng - pickup.lng);
                const a = Math.sin(dLat / 2) ** 2
                        + Math.cos(toRad(pickup.lat)) * Math.cos(toRad(dropoff.lat))
                        * Math.sin(dLng / 2) ** 2;
                const km = R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                this.state.distanceKm = km;
                this.state.etaMin = Math.max(1, Math.ceil(km * 3));

                if (this.routeLine) this.map.removeLayer(this.routeLine);
                this.routeLine = L.polyline(
                    [[pickup.lat, pickup.lng], [dropoff.lat, dropoff.lng]],
                    { color: '#000000', weight: 4, opacity: 0.9, className: 'route-line' }
                ).addTo(this.map);

                this.renderVehicleList();
                this.updateUi();
            },

            renderVehicleList() {
                const wrap = $('#vehicle-list');
                if (!wrap) return;
                wrap.innerHTML = '';

                if (this.state.pickup.lat == null || this.state.dropoff.lat == null) return;

                const services = this.state.services;

                MOCK_FLEET.forEach((mock, idx) => {
                    const real = services[idx % Math.max(services.length, 1)];
                    const baseFare = real ? Number(real.base_fare || 0) : 2.0;
                    const km = Math.max(this.state.distanceKm, 2);
                    const price = baseFare + (mock.priceMultiplier * km);

                    const card = document.createElement('label');
                    card.className = 'vehicle-card flex items-center gap-4 p-4 rounded-2xl border-2 cursor-pointer transition-all duration-150 border-gray-100 hover:border-gray-200 bg-white';
                    card.dataset.mockId = mock.id;
                    card.innerHTML = `
                        <div class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-2xl shrink-0">${mock.icon}</div>
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-gray-900 truncate text-sm">${mock.name}</p>
                            <p class="text-xs text-gray-500 mt-0.5">~${mock.etaMin} min away · ${km.toFixed(1)} km</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900 text-base">TK ${price.toFixed(0)}</p>
                        </div>
                        <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center check-circle shrink-0">
                            <svg class="w-3 h-3 text-white hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        </div>
                    `;
                    card.addEventListener('click', () => this.selectVehicle(mock.id, idx));
                    wrap.appendChild(card);
                });
            },

            selectVehicle(mockId, indexInFleet) {
                this.state.selectedVehicleMockId = mockId;

                const services = this.state.services;
                const real = services[indexInFleet % Math.max(services.length, 1)];
                $('#service-id').value = real ? real.id : '';

                $$('#vehicle-list > label').forEach(label => {
                    const isSelected = label.dataset.mockId === mockId;
                    label.classList.toggle('border-black', isSelected);
                    label.classList.toggle('bg-gray-50', isSelected);
                    label.classList.toggle('selected', isSelected);
                    label.classList.toggle('border-gray-100', !isSelected);
                    label.classList.toggle('hover:border-gray-200', !isSelected);
                    const check = label.querySelector('.check-circle');
                    if (check) {
                        check.classList.toggle('border-black', isSelected);
                        check.classList.toggle('bg-black', isSelected);
                        check.classList.toggle('border-gray-300', !isSelected);
                        const svg = check.querySelector('svg');
                        if (svg) svg.classList.toggle('hidden', !isSelected);
                    }
                });

                this.updateUi();
            },

            updateUi() {
                const { pickup, dropoff, bookingState } = this.state;

                const pill = $('#step-pill');
                if (pill) {
                    if (pickup.lat != null && dropoff.lat != null) {
                        pill.textContent = 'Step 2 · Confirm';
                    } else {
                        pill.textContent = 'Step 1 · Locations';
                    }
                }

                $('#vehicle-section').classList.toggle('hidden', !(pickup.lat != null && dropoff.lat != null));

                const summary = $('#route-summary');
                if (this.state.distanceKm > 0) {
                    summary.classList.remove('hidden');
                    summary.classList.add('flex');
                    $('#distance-km').textContent = this.state.distanceKm.toFixed(1);
                    $('#eta-min').textContent     = this.state.etaMin;
                } else {
                    summary.classList.add('hidden');
                    summary.classList.remove('flex');
                }

                const btn     = $('#book-btn');
                const canBook = pickup.lat != null
                             && dropoff.lat != null
                             && this.state.selectedVehicleMockId !== null
                             && bookingState === 'idle';
                
                const label = $('#book-idle');
                const matching = $('#book-matching');
                const success  = $('#book-success');

                matching.classList.toggle('hidden', bookingState !== 'matching');
                success.classList.toggle('hidden',   bookingState !== 'success');

                if (pickup.lat != null && dropoff.lat != null) {
                    label.textContent = "Book GoRide";
                    btn.disabled = !canBook;
                } else {
                    label.textContent = "See prices";
                    btn.disabled = true;
                }

                if (bookingState === 'idle') {
                    label.classList.remove('hidden');
                } else {
                    label.classList.add('hidden');
                }
            },

            bookRide() {
                const { pickup, dropoff } = this.state;
                if (pickup.lat == null || dropoff.lat == null) return;
                if (this.state.selectedVehicleMockId === null) return;
                if (this.state.bookingState !== 'idle') return;

                this.state.bookingState = 'matching';
                this.updateUi();

                setTimeout(() => {
                    this.state.bookingState = 'success';
                    this.updateUi();
                    setTimeout(() => {
                        $('#ride-form').submit();
                    }, 1200);
                }, 2000);
            },

            confirmBeforeSubmit() {
                return this.state.bookingState === 'success';
            },
        };

        window.RideBooking = RideBooking;
        document.addEventListener('DOMContentLoaded', () => RideBooking.init());
    })();
    </script>
</x-app-layout>