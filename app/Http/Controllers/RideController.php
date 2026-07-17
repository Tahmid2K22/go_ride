<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RideController extends Controller
{
    public function dashboard(): View
    {
        $services = Service::where('is_active', true)->get();

        $activeRide = Ride::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'accepted', 'ongoing'])
            ->latest()
            ->first();

        return view('dashboard', compact('services', 'activeRide'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'pickup_address' => ['required', 'string', 'max:255'],
            'dropoff_address' => ['required', 'string', 'max:255'],
        ]);

        $service = Service::findOrFail($validated['service_id']);
        $fareAmount = $service->base_fare + ($service->per_km_rate * 5.0);

        Ride::create([
            'user_id' => auth()->id(),
            'service_id' => $validated['service_id'],
            'pickup_address' => $validated['pickup_address'],
            'dropoff_address' => $validated['dropoff_address'],
            'distance_km' => 5.0,
            'fare_amount' => $fareAmount,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard');
    }
}
