<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Ride;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $services = Service::where('is_active', true)->get();

        $activeRide = Ride::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'accepted', 'ongoing'])
            ->latest()
            ->first();

        return view('dashboard', compact('services', 'activeRide'));
    }
}
