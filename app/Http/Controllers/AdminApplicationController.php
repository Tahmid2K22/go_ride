<?php

namespace App\Http\Controllers;

use App\Models\RiderApplication;
use App\Models\User;
use App\Mail\DriverCredentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = RiderApplication::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('vehicle_type')) {
            $query->where('vehicle_type', $request->vehicle_type);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $applications = $query->latest()->paginate(20)->withQueryString();

        return view('admin.applications.index', compact('applications'));
    }

    public function show(RiderApplication $application)
    {
        return view('admin.applications.show', compact('application'));
    }

    public function approve(Request $request, RiderApplication $application)
    {
        if ($application->status !== 'pending') {
            return back()->with('error', 'This application has already been processed.');
        }

        try {
            DB::transaction(function () use ($application) {
                $temporaryPassword = Str::random(12);

                $user = $application->user;
                if ($user) {
                    $user->update([
                        'role' => 'driver',
                        'is_active' => true,
                    ]);

                    $user->driverProfile()->create([
                        'vehicle_type' => $application->vehicle_type,
                        'vehicle_plate_number' => $application->license_plate,
                        'is_online' => false,
                        'verification_status' => 'approved',
                        'is_verified' => true,
                        'rating' => 5.0,
                        'total_rides' => 0,
                    ]);

                    $user->update(['password' => Hash::make($temporaryPassword)]);
                } else {
                    $user = User::create([
                        'name' => $application->name,
                        'email' => $application->email,
                        'phone' => $application->phone,
                        'password' => Hash::make($temporaryPassword),
                        'role' => 'driver',
                        'is_active' => true,
                    ]);

                    $user->driverProfile()->create([
                        'vehicle_type' => $application->vehicle_type,
                        'vehicle_plate_number' => $application->license_plate,
                        'is_online' => false,
                        'verification_status' => 'approved',
                        'is_verified' => true,
                        'rating' => 5.0,
                        'total_rides' => 0,
                    ]);
                }

                $application->update([
                    'status' => 'approved',
                    'approved_at' => now(),
                    'approved_by' => auth()->id(),
                ]);

                try {
                    Mail::to($application->email)->send(
                        new DriverCredentials($application->name, $application->email, $temporaryPassword)
                    );
                } catch (\Exception $mailException) {
                    \Log::warning('Failed to send driver credentials email', [
                        'application_id' => $application->id,
                        'error' => $mailException->getMessage(),
                    ]);
                }
            });

            return back()->with('success', 'Application approved! Driver account created and credentials sent via email.');
        } catch (\Exception $e) {
            \Log::error('Driver registration failed', [
                'application_id' => $application->id,
                'error' => $e->getMessage(),
            ]);
            return back()->with('error', 'Failed to approve application: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, RiderApplication $application)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        if ($application->status !== 'pending') {
            return back()->with('error', 'This application has already been processed.');
        }

        $application->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        return back()->with('success', 'Application rejected.');
    }
}
