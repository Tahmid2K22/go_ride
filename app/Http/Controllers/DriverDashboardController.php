<?php

namespace App\Http\Controllers;

use App\Models\DriverProfile;
use App\Models\Ride;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DriverDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $driver = auth()->user()->driverProfile;

        $activeRide = Ride::where('driver_id', auth()->id())
            ->whereIn('status', ['accepted', 'ongoing'])
            ->with('user', 'service')
            ->latest()
            ->first();

        $pendingRides = Ride::where('status', 'pending')
            ->whereNull('driver_id')
            ->with('user', 'service')
            ->latest()
            ->get();

        $todayEarnings = Ride::where('driver_id', auth()->id())
            ->where('status', 'completed')
            ->whereDate('updated_at', today())
            ->sum('fare_amount');

        $totalEarnings = Ride::where('driver_id', auth()->id())
            ->where('status', 'completed')
            ->sum('fare_amount');

        $completedToday = Ride::where('driver_id', auth()->id())
            ->where('status', 'completed')
            ->whereDate('updated_at', today())
            ->count();

        return view('driver-dashboard', compact(
            'driver',
            'activeRide',
            'pendingRides',
            'todayEarnings',
            'totalEarnings',
            'completedToday',
        ));
    }

    public function acceptRide(Ride $ride): RedirectResponse
    {
        if ($ride->status !== 'pending' || $ride->driver_id !== null) {
            return redirect()->route('driver.dashboard')
                ->with('error', __('app.ride_already_taken'));
        }

        $ride->update([
            'driver_id' => auth()->id(),
            'status' => 'accepted',
        ]);

        return redirect()->route('driver.dashboard')
            ->with('success', __('app.ride_accepted'));
    }

    public function startRide(Ride $ride): RedirectResponse
    {
        if ($ride->status !== 'accepted' || $ride->driver_id !== auth()->id()) {
            return redirect()->route('driver.dashboard')
                ->with('error', __('app.cannot_start_ride'));
        }

        $ride->update(['status' => 'ongoing']);

        return redirect()->route('driver.dashboard')
            ->with('success', __('app.ride_started'));
    }

    public function completeRide(Ride $ride): RedirectResponse
    {
        if ($ride->status !== 'ongoing' || $ride->driver_id !== auth()->id()) {
            return redirect()->route('driver.dashboard')
                ->with('error', __('app.cannot_complete_ride'));
        }

        $ride->update(['status' => 'completed']);

        return redirect()->route('driver.dashboard')
            ->with('success', __('app.ride_completed'));
    }

    public function cancelRide(Ride $ride): RedirectResponse
    {
        if (!in_array($ride->status, ['accepted', 'ongoing']) || $ride->driver_id !== auth()->id()) {
            return redirect()->route('driver.dashboard')
                ->with('error', __('app.cannot_cancel_ride'));
        }

        $ride->update([
            'driver_id' => null,
            'status' => 'pending',
        ]);

        return redirect()->route('driver.dashboard')
            ->with('success', __('app.ride_cancelled'));
    }

    public function toggleOnline(): RedirectResponse
    {
        $profile = auth()->user()->driverProfile;

        if (!$profile) {
            return redirect()->route('driver.dashboard')
                ->with('error', __('app.no_driver_profile'));
        }

        $profile->update(['is_online' => !$profile->is_online]);

        $status = $profile->is_online ? 'online' : 'offline';

        return redirect()->route('driver.dashboard')
            ->with('success', __('app.now_' . $status));
    }
}
