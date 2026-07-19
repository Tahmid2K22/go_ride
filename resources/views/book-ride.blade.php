<x-app-layout>
{{-- ═══════════════════════════════════════════════════════════════════════════
     BOOK-RIDE — Modern Split-Screen Layout
     Left ~400px sidebar: form | Right: full-height Leaflet map
     ═══════════════════════════════════════════════════════════════════════════ --}}

{{-- Leaflet CSS --}}
<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />

<style>
    /* ── Page chrome ─────────────────────────────────────────── */
    html, body { height: 100%; margin: 0; }

    /* Remove default app-layout padding on this page */
    main.pb-24, main.pb-0 { padding-bottom: 0 !important; }

    /* Hide bottom navbar on book-ride (full-screen page) */
    nav.fixed.bottom-5 { display: none !important; }

    /* ── Sidebar scrollable form area ────────────────────────── */
    #booking-sidebar {
        width: 400px;
        min-width: 320px;
        max-width: 100vw;
        display: flex;
        flex-direction: column;
        height: 100%;
        background: #ffffff;
        box-shadow: 4px 0 24px rgba(0,0,0,0.08);
        z-index: 20;
        overflow: hidden;
    }

    #sidebar-scroll {
        flex: 1;
        overflow-y: auto;
        padding: 24px;
        scrollbar-width: thin;
        scrollbar-color: #e5e7eb transparent;
    }

    /* ── Location connector dots + dotted line ───────────────── */
    .location-connector {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 4px 0;
        margin-right: 12px;
        gap: 0;
    }
    .dot-pickup  { width: 12px; height: 12px; border-radius: 50%; background: #10b981; flex-shrink: 0; }
    .dot-dropoff { width: 12px; height: 12px; border-radius: 50%; background: #ef4444; flex-shrink: 0; }
    .connector-line {
        width: 2px;
        flex: 1;
        min-height: 24px;
        background: repeating-linear-gradient(
            to bottom,
            #d1d5db 0px, #d1d5db 4px,
            transparent 4px, transparent 8px
        );
        margin: 3px 0;
    }

    /* ── Suggestion dropdown ─────────────────────────────────── */
    .suggestions-list {
        position: absolute;
        left: 0; right: 0;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        z-index: 9999;
        max-height: 220px;
        overflow-y: auto;
        margin-top: 4px;
    }
    .suggestion-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        cursor: pointer;
        border-bottom: 1px solid #f3f4f6;
        transition: background 0.15s;
    }
    .suggestion-item:last-child { border-bottom: none; }
    .suggestion-item:hover { background: #f9fafb; }

    /* ── Vehicle cards ───────────────────────────────────────── */
    .vehicle-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px;
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        cursor: pointer;
        transition: all 0.18s ease;
        background: #fff;
        margin-bottom: 10px;
    }
    .vehicle-card:hover  { border-color: #9ca3af; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(0,0,0,0.07); }
    .vehicle-card.active { border-color: #10b981 !important; background: #f0fdf4; box-shadow: 0 4px 16px rgba(16,185,129,0.15); }

    /* ── Map ─────────────────────────────────────────────────── */
    #ride-map {
        flex: 1;
        height: 100%;
    }
    .leaflet-container { font-family: inherit; }

    /* ── Route polyline animation ────────────────────────────── */
    @keyframes dash-flow {
        to { stroke-dashoffset: -20; }
    }
    .animated-route {
        stroke-dasharray: 10 6;
        animation: dash-flow 0.7s linear infinite;
    }

    /* ── Mobile stacked layout ───────────────────────────────── */
    @media (max-width: 767px) {
        #book-ride-shell  { flex-direction: column !important; }
        #booking-sidebar  { width: 100% !important; height: 55vh; }
        #ride-map         { height: 45vh; }
    }
</style>

{{-- ═══════════════════════════════════════════════════════════════════════════
     OUTER SHELL — fills entire viewport
     ═══════════════════════════════════════════════════════════════════════════ --}}
<div id="book-ride-shell"
     style="display:flex; flex-direction:row; height:100vh; width:100vw; overflow:hidden;"
     data-services='@json($services)'>

    {{-- ── LEFT SIDEBAR ────────────────────────────────────────────────────── --}}
    <aside id="booking-sidebar">

        {{-- Header: logo + back button --}}
        <div style="display:flex; align-items:center; justify-content:space-between; padding:18px 20px 14px; border-bottom:1px solid #f3f4f6; flex-shrink:0;">
            <a href="{{ route('dashboard') }}"
               style="display:flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:50%; background:#f3f4f6;"
               title="Back">
                <svg style="width:18px;height:18px;color:#374151;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>

            <div style="display:flex; align-items:center; gap:8px;">
                {{-- GoRide wordmark --}}
                <span style="font-size:20px; font-weight:900; letter-spacing:-0.5px; color:#111827;">
                    Go<span style="color:#10b981;">Ride</span>
                </span>
            </div>

            {{-- Step indicator pill --}}
            <span id="step-pill"
                  style="font-size:10px; font-weight:700; letter-spacing:0.05em; text-transform:uppercase; padding:4px 10px; border-radius:20px; background:#ecfdf5; color:#059669;">
                Step 1 of 3
            </span>
        </div>

        {{-- Scrollable form body --}}
        <div id="sidebar-scroll">

            <h2 style="font-size:22px; font-weight:800; color:#111827; margin:0 0 20px;">
                Where are you going?
            </h2>

            {{-- ── LOCATION INPUTS ─────────────────────────────────────────── --}}
            <div style="display:flex; align-items:stretch; gap:0; margin-bottom:20px;">

                {{-- Connector dots + line --}}
                <div class="location-connector" style="justify-content:flex-start; padding-top:14px;">
                    <div class="dot-pickup"></div>
                    <div class="connector-line"></div>
                    <div class="dot-dropoff"></div>
                </div>

                {{-- Input fields stack --}}
                <div style="flex:1; display:flex; flex-direction:column; gap:8px;">

                    {{-- Pickup input --}}
                    <div style="position:relative;">
                        <label style="display:block; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; color:#6b7280; margin-bottom:4px;">
                            Pickup Location
                        </label>
                        <div style="display:flex; align-items:center; background:#f9fafb; border:2px solid #e5e7eb; border-radius:14px; padding:10px 12px; transition:border-color 0.2s;"
                             id="pickup-wrap">
                            <input id="pickup-input"
                                   type="text"
                                   autocomplete="off"
                                   placeholder="Where are you?"
                                   style="flex:1; background:transparent; border:none; outline:none; font-size:13px; font-weight:500; color:#111827; min-width:0;"
                                   />
                            {{-- Locate-me icon --}}
                            <button type="button" id="locate-btn"
                                    title="Use my location"
                                    style="margin-left:6px; padding:2px; background:none; border:none; cursor:pointer; color:#10b981; flex-shrink:0;">
                                <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 1v2m0 18v2M4.22 4.22l1.42 1.42m12.72 12.72l1.42 1.42M1 12h2m18 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                                </svg>
                            </button>
                            {{-- Set-on-map icon --}}
                            <button type="button" data-set-map="pickup"
                                    title="Pick from map"
                                    style="margin-left:4px; padding:2px; background:none; border:none; cursor:pointer; color:#6b7280; flex-shrink:0;">
                                <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 9m0 8V9m0 0L9 7"/>
                                </svg>
                            </button>
                        </div>
                        <div id="pickup-suggestions" class="suggestions-list" style="display:none;"></div>
                    </div>

                    {{-- Dropoff input --}}
                    <div style="position:relative;">
                        <label style="display:block; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; color:#6b7280; margin-bottom:4px;">
                            Drop-off Location
                        </label>
                        <div style="display:flex; align-items:center; background:#f9fafb; border:2px solid #e5e7eb; border-radius:14px; padding:10px 12px; transition:border-color 0.2s;"
                             id="dropoff-wrap">
                            <input id="dropoff-input"
                                   type="text"
                                   autocomplete="off"
                                   placeholder="Where to?"
                                   style="flex:1; background:transparent; border:none; outline:none; font-size:13px; font-weight:500; color:#111827; min-width:0;"
                                   />
                            {{-- Clear icon --}}
                            <button type="button" id="clear-dropoff"
                                    style="margin-left:6px; padding:2px; background:none; border:none; cursor:pointer; color:#9ca3af; flex-shrink:0; display:none;">
                                <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                            {{-- Set-on-map icon --}}
                            <button type="button" data-set-map="dropoff"
                                    title="Pick from map"
                                    style="margin-left:4px; padding:2px; background:none; border:none; cursor:pointer; color:#6b7280; flex-shrink:0;">
                                <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 9m0 8V9m0 0L9 7"/>
                                </svg>
                            </button>
                        </div>
                        <div id="dropoff-suggestions" class="suggestions-list" style="display:none;"></div>
                    </div>
                </div>
            </div>

            {{-- Map-picking hint banner --}}
            <div id="map-hint" style="display:none; margin-bottom:14px; padding:10px 14px; background:#eff6ff; border-radius:10px; font-size:12px; font-weight:600; color:#1d4ed8;">
                📍 Click anywhere on the map to set location
            </div>

            {{-- Route summary (distance + ETA) — shown after both locations set --}}
            <div id="route-summary" style="display:none; margin-bottom:20px; padding:14px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:14px;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div style="display:flex; align-items:center; gap:6px; font-size:13px; font-weight:700; color:#065f46;">
                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m-8-5h8m-8-5h9M6 7H5a2 2 0 00-2 2v9a2 2 0 002 2h1"/></svg>
                        <span id="distance-km">—</span> km
                    </div>
                    <div style="display:flex; align-items:center; gap:6px; font-size:13px; font-weight:700; color:#065f46;">
                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        ~<span id="eta-min">—</span> min
                    </div>
                </div>
            </div>

            {{-- ── VEHICLE SELECTION ───────────────────────────────────────── --}}
            <div id="vehicle-section" style="display:none;">
                <h3 style="font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; color:#6b7280; margin:0 0 12px;">
                    Choose your ride
                </h3>
                <div id="vehicle-list"></div>
            </div>

        </div>{{-- end sidebar-scroll --}}

        {{-- ── BOOK BUTTON (sticky footer) ─────────────────────────────────── --}}
        <div style="padding:16px 20px; border-top:1px solid #f3f4f6; flex-shrink:0; background:#fff;">
            <button id="book-btn"
                    disabled
                    style="width:100%; padding:16px; border-radius:16px; border:none; background:#10b981; color:#fff; font-size:16px; font-weight:800; cursor:pointer; transition:all 0.2s; display:flex; align-items:center; justify-content:center; gap:10px; opacity:0.45;">

                {{-- Idle state --}}
                <span id="btn-idle" style="display:flex; align-items:center; gap:8px;">
                    <svg style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 9m0 8V9m0 0L9 7"/>
                    </svg>
                    Request Ride
                </span>

                {{-- Loading state --}}
                <span id="btn-loading" style="display:none; align-items:center; gap:8px;">
                    <span style="width:20px;height:20px;border:3px solid rgba(255,255,255,0.4);border-top-color:#fff;border-radius:50%;animation:spin 0.8s linear infinite;"></span>
                    Matching with a driver...
                </span>

                {{-- Success state --}}
                <span id="btn-success" style="display:none; align-items:center; gap:8px;">
                    <svg style="width:20px;height:20px;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Ride booked! Redirecting...
                </span>
            </button>
        </div>

    </aside>{{-- end sidebar --}}

    {{-- ── RIGHT MAP PANEL ─────────────────────────────────────────────────── --}}
    <div style="flex:1; position:relative; overflow:hidden;">
        <div id="ride-map" style="width:100%; height:100%;"></div>

        {{-- Floating map controls --}}
        <div style="position:absolute; top:16px; right:16px; display:flex; flex-direction:column; gap:8px; z-index:400;">
            {{-- Zoom in --}}
            <button id="zoom-in"
                    style="width:38px;height:38px;background:#fff;border:none;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.15);cursor:pointer;font-size:22px;display:flex;align-items:center;justify-content:center;">
                <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12M6 12h12"/></svg>
            </button>
            {{-- Zoom out --}}
            <button id="zoom-out"
                    style="width:38px;height:38px;background:#fff;border:none;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.15);cursor:pointer;display:flex;align-items:center;justify-content:center;">
                <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12h12"/></svg>
            </button>
        </div>

        {{-- Map legend --}}
        <div style="position:absolute; bottom:16px; right:16px; background:#fff; border-radius:12px; padding:10px 14px; box-shadow:0 2px 12px rgba(0,0,0,0.12); display:flex; gap:14px; align-items:center; z-index:400;">
            <div style="display:flex;align-items:center;gap:6px;">
                <div style="width:10px;height:10px;border-radius:50%;background:#10b981;"></div>
                <span style="font-size:11px;color:#4b5563;font-weight:600;">Pickup</span>
            </div>
            <div style="width:1px;height:14px;background:#e5e7eb;"></div>
            <div style="display:flex;align-items:center;gap:6px;">
                <div style="width:10px;height:10px;border-radius:50%;background:#ef4444;"></div>
                <span style="font-size:11px;color:#4b5563;font-weight:600;">Drop-off</span>
            </div>
        </div>
    </div>

</div>{{-- end shell --}}

{{-- ═══════════════════════════════════════════════════════════════════════════
     LEAFLET + BOOKING JAVASCRIPT
     ═══════════════════════════════════════════════════════════════════════════ --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
<style>@keyframes spin{to{transform:rotate(360deg)}}</style>

<script>
(function () {
'use strict';

// ── Helpers ────────────────────────────────────────────────────────────────
const $ = id => document.getElementById(id);
const debounce = (fn, ms = 400) => {
    let t; return (...a) => { clearTimeout(t); t = setTimeout(() => fn(...a), ms); };
};

// ── State ──────────────────────────────────────────────────────────────────
const SERVICES  = JSON.parse(document.querySelector('[data-services]')?.dataset.services || '[]');
const CSRF      = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
const DASHBOARD = '{{ route("dashboard") }}';

const state = {
    pickup  : { address: '', lat: null, lng: null },
    dropoff : { address: '', lat: null, lng: null },
    mapTarget   : null,   // 'pickup' | 'dropoff' | null
    selectedSvc : null,   // service object
    distanceKm  : 0,
    etaMin      : 0,
};

// ── Map setup ──────────────────────────────────────────────────────────────
const map = L.map('ride-map', { zoomControl: false }).setView([23.8103, 90.4125], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    maxZoom: 19,
}).addTo(map);

const makeIcon = color => L.divIcon({
    className: '',
    html: `<div style="width:18px;height:18px;border-radius:50%;background:${color};border:3px solid #fff;box-shadow:0 2px 8px rgba(0,0,0,.3);"></div>`,
    iconSize: [18,18], iconAnchor: [9,9],
});

const PICKUP_ICON  = makeIcon('#10b981');
const DROPOFF_ICON = makeIcon('#ef4444');

let pickupMarker  = null;
let dropoffMarker = null;

// Initialize Routing Control along actual roads using OSRM backend
const routingControl = L.Routing.control({
    router: L.Routing.osrmv1({
        serviceUrl: 'https://router.project-osrm.org/route/v1'
    }),
    show: false,
    addWaypoints: false,
    draggableWaypoints: false,
    lineOptions: {
        styles: [
            { color: '#10b981', weight: 4, opacity: 0.85, dashArray: '10 6', className: 'animated-route' }
        ]
    },
    createMarker: function() { return null; }
}).addTo(map);

// Bind routesfound event to extract driving metrics & update state/UI
routingControl.on('routesfound', function (e) {
    const routes = e.routes;
    if (routes && routes.length > 0) {
        const route = routes[0];
        const summary = route.summary;
        
        state.distanceKm = summary.totalDistance / 1000;
        state.etaMin     = Math.ceil(summary.totalTime / 60);

        renderVehicleCards();
        updateUi();
    }
});

// ── Map zoom controls ──────────────────────────────────────────────────────
$('zoom-in') .addEventListener('click', () => map.zoomIn());
$('zoom-out').addEventListener('click', () => map.zoomOut());

// ── IP Geolocation on page load ────────────────────────────────────────────
// Uses ipapi.co (HTTPS, free) to detect user city + coordinates
(async function detectLocation() {
    try {
        const res  = await fetch('https://ipapi.co/json/');
        const data = await res.json();

        if (data && data.latitude && data.longitude) {
            const lat     = parseFloat(data.latitude);
            const lng     = parseFloat(data.longitude);
            const city    = data.city || data.region || 'Your location';
            const country = data.country_name || '';

            // Centre the map on detected location
            map.setView([lat, lng], 14);

            // Pre-fill pickup field
            setPickup(lat, lng, `${city}, ${country}`);
        }
    } catch (e) {
        console.warn('[GoRide] IP geolocation failed, using default map view.', e);
    }
})();

// ── Browser GPS (locate-me button) ────────────────────────────────────────
$('locate-btn').addEventListener('click', () => {
    if (!navigator.geolocation) return;
    navigator.geolocation.getCurrentPosition(
        pos => {
            setPickup(pos.coords.latitude, pos.coords.longitude, 'Current Location');
            map.setView([pos.coords.latitude, pos.coords.longitude], 15);
        },
        () => alert('Unable to access GPS location.')
    );
});

// ── Set-on-map icon buttons ────────────────────────────────────────────────
document.querySelectorAll('[data-set-map]').forEach(btn => {
    btn.addEventListener('click', () => {
        const kind = btn.dataset.setMap; // 'pickup' | 'dropoff'
        state.mapTarget = state.mapTarget === kind ? null : kind;
        updateMapHint();
    });
});

// ── Map click handler ──────────────────────────────────────────────────────
map.on('click', async e => {
    const { lat, lng } = e.latlng;

    if (state.mapTarget === 'pickup') {
        const addr = await reverseGeocode(lat, lng);
        setPickup(lat, lng, addr);
        state.mapTarget = null;
    } else if (state.mapTarget === 'dropoff') {
        const addr = await reverseGeocode(lat, lng);
        setDropoff(lat, lng, addr);
        state.mapTarget = null;
    } else if (!state.pickup.lat) {
        const addr = await reverseGeocode(lat, lng);
        setPickup(lat, lng, addr);
    } else if (!state.dropoff.lat) {
        const addr = await reverseGeocode(lat, lng);
        setDropoff(lat, lng, addr);
    }

    updateMapHint();
    updateUi();
});

// ── Input focus highlights ─────────────────────────────────────────────────
['pickup-input', 'dropoff-input'].forEach(id => {
    const el   = $(id);
    const wrap = $(id.replace('-input', '-wrap'));
    el.addEventListener('focus', () => wrap.style.borderColor = '#10b981');
    el.addEventListener('blur',  () => wrap.style.borderColor = '#e5e7eb');
});

// ── Pickup input → Nominatim suggestions ──────────────────────────────────
$('pickup-input').addEventListener('input', debounce(async () => {
    const val = $('pickup-input').value.trim();
    state.pickup.address = val;
    if (val.length >= 3) await showSuggestions(val, 'pickup');
    else $('pickup-suggestions').style.display = 'none';
}, 400));

// ── Dropoff input → Nominatim suggestions ─────────────────────────────────
$('dropoff-input').addEventListener('input', debounce(async () => {
    const val = $('dropoff-input').value.trim();
    state.dropoff.address = val;
    $('clear-dropoff').style.display = val ? 'flex' : 'none';
    if (val.length >= 3) await showSuggestions(val, 'dropoff');
    else $('dropoff-suggestions').style.display = 'none';
}, 400));

// ── Clear dropoff ─────────────────────────────────────────────────────────
$('clear-dropoff').addEventListener('click', () => {
    $('dropoff-input').value = '';
    $('clear-dropoff').style.display = 'none';
    $('dropoff-suggestions').style.display = 'none';
    state.dropoff = { address: '', lat: null, lng: null };
    if (dropoffMarker) { map.removeLayer(dropoffMarker); dropoffMarker = null; }
    clearRoute();
    updateUi();
});

// ── Hide suggestions on outside click ────────────────────────────────────
document.addEventListener('click', e => {
    if (!e.target.closest('#pickup-input'))   $('pickup-suggestions').style.display = 'none';
    if (!e.target.closest('#dropoff-input'))  $('dropoff-suggestions').style.display = 'none';
});

// ── Suggestions fetch (Nominatim) ────────────────────────────────────────
async function showSuggestions(query, kind) {
    const listEl = $(kind + '-suggestions');
    try {
        const url  = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=5&countrycodes=bd`;
        const data = await fetch(url).then(r => r.json());

        listEl.innerHTML = '';
        if (!Array.isArray(data) || !data.length) { listEl.style.display = 'none'; return; }

        data.forEach(item => {
            const parts    = item.display_name.split(',');
            const title    = parts[0].trim();
            const subtitle = parts.slice(1, 3).join(',').trim();
            const div      = document.createElement('div');
            div.className  = 'suggestion-item';
            div.innerHTML  = `
                <div style="width:32px;height:32px;border-radius:50%;background:#f3f4f6;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg style="width:14px;height:14px;color:#6b7280;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                </div>
                <div style="min-width:0;">
                    <div style="font-size:13px;font-weight:600;color:#111827;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${title}</div>
                    <div style="font-size:11px;color:#6b7280;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${subtitle}</div>
                </div>`;

            div.addEventListener('click', () => {
                const lat = parseFloat(item.lat);
                const lng = parseFloat(item.lon);
                if (kind === 'pickup')  setPickup(lat, lng, item.display_name);
                else                    setDropoff(lat, lng, item.display_name);
                listEl.style.display = 'none';
                updateUi();
            });
            listEl.appendChild(div);
        });

        listEl.style.display = 'block';
    } catch (e) {
        console.warn('[GoRide] Suggestions failed:', e);
    }
}

// ── Reverse geocode a lat/lng to address string ────────────────────────────
async function reverseGeocode(lat, lng) {
    try {
        const url  = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=16`;
        const data = await fetch(url).then(r => r.json());
        return data?.display_name ?? `${lat.toFixed(5)}, ${lng.toFixed(5)}`;
    } catch { return `${lat.toFixed(5)}, ${lng.toFixed(5)}`; }
}

// ── Place pickup marker ────────────────────────────────────────────────────
function setPickup(lat, lng, address) {
    state.pickup = { lat, lng, address };
    const short = address.split(',').slice(0, 2).join(',').trim();
    $('pickup-input').value = short;

    if (pickupMarker) map.removeLayer(pickupMarker);
    pickupMarker = L.marker([lat, lng], { icon: PICKUP_ICON }).addTo(map)
        .bindPopup('<b>Pickup</b><br>' + short);

    fitBounds();
    computeRoute();
}

// ── Place dropoff marker ────────────────────────────────────────────────────
function setDropoff(lat, lng, address) {
    state.dropoff = { lat, lng, address };
    const short = address.split(',').slice(0, 2).join(',').trim();
    $('dropoff-input').value = short;
    $('clear-dropoff').style.display = 'flex';

    if (dropoffMarker) map.removeLayer(dropoffMarker);
    dropoffMarker = L.marker([lat, lng], { icon: DROPOFF_ICON }).addTo(map)
        .bindPopup('<b>Drop-off</b><br>' + short);

    fitBounds();
    computeRoute();
}

// ── Fit map to show both markers ───────────────────────────────────────────
function fitBounds() {
    const { pickup: p, dropoff: d } = state;
    if (p.lat && d.lat) {
        map.fitBounds([[p.lat, p.lng], [d.lat, d.lng]], { padding: [60, 60] });
    } else if (p.lat) {
        map.setView([p.lat, p.lng], 14);
    } else if (d.lat) {
        map.setView([d.lat, d.lng], 14);
    }
}

// ── Routing control waypoints setup ────────────────────────────────────────
function computeRoute() {
    const { pickup: p, dropoff: d } = state;
    if (!p.lat || !d.lat) { clearRoute(); return; }

    const pickupLatLng = L.latLng(p.lat, p.lng);
    const dropoffLatLng = L.latLng(d.lat, d.lng);

    routingControl.setWaypoints([pickupLatLng, dropoffLatLng]);
}

function clearRoute() {
    if (routingControl) {
        routingControl.setWaypoints([]);
    }
    state.distanceKm = 0;
    state.etaMin     = 0;
    state.selectedSvc = null;
    $('vehicle-list').innerHTML = '';
    $('vehicle-section').style.display = 'none';
}

// ── Render vehicle selection cards ─────────────────────────────────────────
function renderVehicleCards() {
    const wrap = $('vehicle-list');
    wrap.innerHTML = '';

    if (!SERVICES.length) {
        // Fallback fleet if DB has no services
        renderFallbackFleet(wrap);
        return;
    }

    SERVICES.forEach(svc => {
        const km    = Math.max(state.distanceKm, 1);
        const fare  = svc.base_fare + svc.per_km_rate * km;
        const card  = document.createElement('div');
        card.className = 'vehicle-card';
        card.dataset.svcId = svc.id;
        card.innerHTML = `
            <div style="font-size:28px;width:48px;height:48px;border-radius:12px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                ${svc.icon || '🚗'}
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-size:14px;font-weight:700;color:#111827;">${svc.name}</div>
                <div style="font-size:12px;color:#6b7280;margin-top:2px;">${km.toFixed(1)} km away</div>
            </div>
            <div style="text-align:right;flex-shrink:0;">
                <div style="font-size:16px;font-weight:800;color:#111827;">৳${fare.toFixed(0)}</div>
                <div style="font-size:11px;color:#9ca3af;">est. fare</div>
            </div>`;

        card.addEventListener('click', () => {
            state.selectedSvc = { ...svc, fare };
            document.querySelectorAll('.vehicle-card').forEach(c => c.classList.remove('active'));
            card.classList.add('active');
            updateUi();
        });

        wrap.appendChild(card);
    });

    $('vehicle-section').style.display = 'block';
}

// Fallback mock fleet (if no DB services)
function renderFallbackFleet(wrap) {
    const FLEET = [
        { id: 1, name: 'Moto',        icon: '🏍️', base_fare: 30, per_km_rate: 12 },
        { id: 2, name: 'Car Economy', icon: '🚗', base_fare: 60, per_km_rate: 22 },
        { id: 3, name: 'Car Premium', icon: '🚙', base_fare: 100, per_km_rate: 35 },
    ];
    FLEET.forEach(svc => {
        const km   = Math.max(state.distanceKm, 1);
        const fare = svc.base_fare + svc.per_km_rate * km;
        const card = document.createElement('div');
        card.className = 'vehicle-card';
        card.dataset.svcId = svc.id;
        card.innerHTML = `
            <div style="font-size:28px;width:48px;height:48px;border-radius:12px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;">${svc.icon}</div>
            <div style="flex:1;"><div style="font-size:14px;font-weight:700;color:#111827;">${svc.name}</div></div>
            <div style="text-align:right;"><div style="font-size:16px;font-weight:800;color:#111827;">৳${fare.toFixed(0)}</div></div>`;
        card.addEventListener('click', () => {
            state.selectedSvc = { ...svc, fare };
            document.querySelectorAll('.vehicle-card').forEach(c => c.classList.remove('active'));
            card.classList.add('active');
            updateUi();
        });
        wrap.appendChild(card);
    });
    $('vehicle-section').style.display = 'block';
}

// ── Update UI reactive state ───────────────────────────────────────────────
function updateUi() {
    const { pickup: p, dropoff: d, selectedSvc, distanceKm, etaMin } = state;
    const bothSet = p.lat && d.lat;

    // Step pill
    $('step-pill').textContent = selectedSvc ? 'Step 3 of 3' : bothSet ? 'Step 2 of 3' : 'Step 1 of 3';

    // Route summary
    if (bothSet && distanceKm > 0) {
        $('route-summary').style.display = 'block';
        $('distance-km').textContent = distanceKm.toFixed(1);
        $('eta-min').textContent     = etaMin;
    } else {
        $('route-summary').style.display = 'none';
    }

    // Book button state
    const btn = $('book-btn');
    const canBook = bothSet && selectedSvc;
    btn.disabled = !canBook;
    btn.style.opacity  = canBook ? '1' : '0.45';
    btn.style.cursor   = canBook ? 'pointer' : 'not-allowed';
    btn.style.boxShadow = canBook ? '0 4px 20px rgba(16,185,129,0.35)' : 'none';
}

function updateMapHint() {
    const hint = $('map-hint');
    if (state.mapTarget) {
        hint.textContent = `📍 Click on the map to set your ${state.mapTarget} location`;
        hint.style.display = 'block';
        map.getContainer().style.cursor = 'crosshair';
    } else {
        hint.style.display = 'none';
        map.getContainer().style.cursor = '';
    }
}

// ── Book button click → AJAX POST ─────────────────────────────────────────
$('book-btn').addEventListener('click', async () => {
    const { pickup: p, dropoff: d, selectedSvc } = state;
    if (!p.lat || !d.lat || !selectedSvc) return;

    // Show loading spinner
    $('btn-idle').style.display    = 'none';
    $('btn-loading').style.display = 'flex';
    $('book-btn').disabled         = true;
    $('book-btn').style.background = '#059669';

    try {
        const res = await fetch('/ride-requests', {
            method: 'POST',
            headers: {
                'Content-Type'     : 'application/json',
                'Accept'           : 'application/json',
                'X-CSRF-TOKEN'     : CSRF,
            },
            body: JSON.stringify({
                service_id      : selectedSvc.id,
                pickup_address  : p.address,
                pickup_lat      : p.lat,
                pickup_lng      : p.lng,
                dropoff_address : d.address,
                dropoff_lat     : d.lat,
                dropoff_lng     : d.lng,
                distance_km     : state.distanceKm,
                payment_method  : 'cash',
            }),
        });

        const json = await res.json();

        if (res.ok && json.success) {
            // Show success state briefly then redirect
            $('btn-loading').style.display = 'none';
            $('btn-success').style.display = 'flex';
            $('book-btn').style.background = '#16a34a';

            setTimeout(() => {
                window.location.href = json.redirect_url ?? DASHBOARD;
            }, 1400);
        } else {
            showBookingError(json.message ?? 'Something went wrong. Please try again.');
        }

    } catch (e) {
        showBookingError('Network error. Please check your connection.');
        console.error('[GoRide] Booking request failed:', e);
    }
});

function showBookingError(msg) {
    $('btn-loading').style.display = 'none';
    $('btn-idle').style.display    = 'flex';
    $('book-btn').disabled         = false;
    $('book-btn').style.background = '#ef4444';
    $('book-btn').style.opacity    = '1';
    setTimeout(() => {
        $('book-btn').style.background = '#10b981';
        updateUi();
    }, 2500);
    alert(msg);
}

// ── Initial UI render ─────────────────────────────────────────────────────
updateUi();

})(); // IIFE end
</script>

</x-app-layout>