<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use App\Models\Service;
use App\Services\RideCalculator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RideController extends Controller
{
    public function __construct(
        private readonly RideCalculator $calculator,
    ) {}

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'pickup_address' => ['required', 'string', 'max:255'],
            'pickup_lat' => ['required', 'numeric', 'between:-90,90'],
            'pickup_lng' => ['required', 'numeric', 'between:-180,180'],
            'dropoff_address' => ['required', 'string', 'max:255'],
            'dropoff_lat' => ['required', 'numeric', 'between:-90,90'],
            'dropoff_lng' => ['required', 'numeric', 'between:-180,180'],
            'payment_method' => ['required', 'in:cash,bkash'],
        ]);

        $service = Service::findOrFail($validated['service_id']);

        $distance = $this->calculator->calculateDistance(
            $validated['pickup_lat'],
            $validated['pickup_lng'],
            $validated['dropoff_lat'],
            $validated['dropoff_lng'],
        );

        $fare = $this->calculator->calculateFare($service, $distance);

        Ride::create([
            'user_id' => auth()->id(),
            'service_id' => $validated['service_id'],
            'pickup_address' => $validated['pickup_address'],
            'pickup_lat' => $validated['pickup_lat'],
            'pickup_lng' => $validated['pickup_lng'],
            'dropoff_address' => $validated['dropoff_address'],
            'dropoff_lat' => $validated['dropoff_lat'],
            'dropoff_lng' => $validated['dropoff_lng'],
            'distance_km' => $distance,
            'fare_amount' => $fare,
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard');
    }
}
