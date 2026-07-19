<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use App\Models\Service;
use App\Services\RideCalculator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RideController extends Controller
{
    public function __construct(
        private readonly RideCalculator $calculator,
    ) {}

    /**
     * Show the book-ride page.
     * Passes all services as JSON-safe array for the JS vehicle cards.
     */
    public function create(): View
    {
        $services = Service::all()->map(fn($s) => [
            'id'          => $s->id,
            'name'        => $s->name,
            'icon'        => $s->icon,
            'base_fare'   => (float) $s->base_fare,
            'per_km_rate' => (float) $s->per_km_rate,
        ])->values()->toArray();

        return view('book-ride', compact('services'));
    }

    /**
     * Store a new ride request.
     *
     * Supports two response modes:
     *   1. AJAX / JSON  → returns HTTP 201 JSON (used by the new JS booking flow)
     *   2. Regular form → redirects to dashboard (backward-compatible)
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'service_id'      => ['required', 'exists:services,id'],
            'pickup_address'  => ['required', 'string', 'max:500'],
            'pickup_lat'      => ['required', 'numeric', 'between:-90,90'],
            'pickup_lng'      => ['required', 'numeric', 'between:-180,180'],
            'dropoff_address' => ['required', 'string', 'max:500'],
            'dropoff_lat'     => ['required', 'numeric', 'between:-90,90'],
            'dropoff_lng'     => ['required', 'numeric', 'between:-180,180'],
            'payment_method'  => ['required', 'in:cash,bkash'],
        ]);

        // Compute distance (haversine) and fare using existing service
        $service = Service::findOrFail($validated['service_id']);

        $distance = $this->calculator->calculateDistance(
            $validated['pickup_lat'],
            $validated['pickup_lng'],
            $validated['dropoff_lat'],
            $validated['dropoff_lng'],
        );

        $fare = $this->calculator->calculateFare($service, $distance);

        // Persist the ride as 'pending' — awaiting driver acceptance
        $ride = Ride::create([
            'user_id'         => auth()->id(),
            'service_id'      => $validated['service_id'],
            'pickup_address'  => $validated['pickup_address'],
            'pickup_lat'      => $validated['pickup_lat'],
            'pickup_lng'      => $validated['pickup_lng'],
            'dropoff_address' => $validated['dropoff_address'],
            'dropoff_lat'     => $validated['dropoff_lat'],
            'dropoff_lng'     => $validated['dropoff_lng'],
            'distance_km'     => $distance,
            'fare_amount'     => $fare,
            'payment_method'  => $validated['payment_method'],
            'status'          => 'pending',
        ]);

        // ── AJAX path (used by the new frontend JS) ───────────────────────────
        if ($request->expectsJson()) {
            return response()->json([
                'success'      => true,
                'message'      => 'Ride request submitted. Looking for a driver...',
                'ride_id'      => $ride->id,
                'fare'         => number_format($fare, 2),
                'distance_km'  => round($distance, 2),
                'redirect_url' => route('dashboard'),
            ], 201);
        }

        // ── Regular form path (backward-compatible) ───────────────────────────
        return redirect()->route('dashboard');
    }
}
