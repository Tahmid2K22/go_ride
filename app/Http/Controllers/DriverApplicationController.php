<?php

namespace App\Http\Controllers;

use App\Models\RiderApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DriverApplicationController extends Controller
{
    public function create()
    {
        session()->forget('driver_application');

        return view('driver-application.step1');
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('rider_applications', 'email'), Rule::unique('users', 'email')],
            'phone' => ['required', 'string', 'max:20', 'regex:/^[\+]?[0-9\s\-\(\)]{10,}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request->session()->put('driver_application.step1', $validated);

        return redirect()->route('driver-apply.step2');
    }

    public function step2()
    {
        if (!session()->has('driver_application.step1')) {
            return redirect()->route('driver-apply.create');
        }

        return view('driver-application.step2');
    }

    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'vehicle_type' => ['required', Rule::in(['bike', 'car'])],
            'license_plate' => ['required', 'string', 'max:20', 'alpha_dash'],
        ]);

        $applicationData = array_merge(
            session('driver_application.step1'),
            $validated
        );

        DB::transaction(function () use ($applicationData) {
            $user = User::create([
                'name' => $applicationData['name'],
                'email' => $applicationData['email'],
                'phone' => $applicationData['phone'],
                'password' => $applicationData['password'],
                'role' => 'pending_rider',
                'is_active' => false,
            ]);

            RiderApplication::create(array_merge($applicationData, [
                'user_id' => $user->id,
                'verification_documents' => [],
            ]));
        });

        $request->session()->forget('driver_application');

        return redirect()->route('driver-apply.success');
    }

    public function success()
    {
        return view('driver-application.success');
    }
}
