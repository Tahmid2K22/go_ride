<?php

namespace App\Http\Controllers;

use App\Models\RiderApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DriverApplicationController extends Controller
{
    /**
     * Show the driver application form (Step 1 - Personal Info)
     */
    public function create()
    {
        // Clear any existing session data
        session()->forget('driver_application');
        
        return view('driver-application.step1');
    }

    /**
     * Handle Step 1 submission and show Step 2 (Vehicle Info)
     */
    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('rider_applications', 'email'), Rule::unique('users', 'email')],
            'phone' => ['required', 'string', 'max:20', 'regex:/^[\+]?[0-9\s\-\(\)]{10,}$/'],
        ]);

        // Store in session for multi-step form
        $request->session()->put('driver_application.step1', $validated);

        return redirect()->route('driver-apply.step2');
    }

    /**
     * Show Step 2 - Vehicle Information
     */
    public function step2()
    {
        // Check if step 1 data exists
        if (!session()->has('driver_application.step1')) {
            return redirect()->route('driver-apply.create');
        }

        return view('driver-application.step2');
    }

    /**
     * Handle Step 2 submission and show Step 3 (Documents)
     */
    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'vehicle_type' => ['required', Rule::in(['bike', 'car', 'cng'])],
            'license_plate' => ['required', 'string', 'max:20', 'alpha_dash'],
        ]);

        $request->session()->put('driver_application.step2', $validated);

        return redirect()->route('driver-apply.step3');
    }

    /**
     * Show Step 3 - Document Upload
     */
    public function step3()
    {
        if (!session()->has('driver_application.step1') || !session()->has('driver_application.step2')) {
            return redirect()->route('driver-apply.create');
        }

        return view('driver-application.step3');
    }

    /**
     * Handle final submission - Store application with documents
     */
    public function storeStep3(Request $request)
    {
        $validated = $request->validate([
            'nid_front' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'nid_back' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'driving_license' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ]);

        // Store uploaded files
        $documents = [
            'nid_front' => $request->file('nid_front')->store('driver-applications/nid', 'public'),
            'nid_back' => $request->file('nid_back')->store('driver-applications/nid', 'public'),
            'driving_license' => $request->file('driving_license')->store('driver-applications/license', 'public'),
        ];

        // Combine all step data
        $applicationData = array_merge(
            session('driver_application.step1'),
            session('driver_application.step2'),
            ['verification_documents' => $documents]
        );

        // Create the application
        RiderApplication::create($applicationData);

        // Clear session
        $request->session()->forget('driver_application');

        return redirect()->route('driver-apply.success');
    }

    /**
     * Show success page after submission
     */
    public function success()
    {
        return view('driver-application.success');
    }
}