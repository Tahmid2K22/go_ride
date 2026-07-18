<?php

namespace Database\Seeders;

use App\Models\Ride;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class RideSeeder extends Seeder
{
    public function run(): void
    {
        $rider = User::where('email', 'rider@goride.com.bd')->first();
        $carDriver = User::where('email', 'driver.car@goride.com.bd')->first();

        $moto = Service::where('slug', 'moto')->first();
        $carAc = Service::where('slug', 'car-ac')->first();

        if (! $rider || ! $moto || ! $carAc) {
            return;
        }

        Ride::updateOrCreate(
            [
                'user_id' => $rider->id,
                'service_id' => $moto->id,
                'pickup_address' => 'Dhanmondi 27, Dhaka',
                'dropoff_address' => 'Gulshan 2, Dhaka',
            ],
            [
                'distance_km' => 8.50,
                'fare_amount' => 132.00,
                'status' => 'pending',
            ]
        );

        Ride::updateOrCreate(
            [
                'user_id' => $rider->id,
                'service_id' => $carAc->id,
                'pickup_address' => 'Uttara Sector 3, Dhaka',
                'dropoff_address' => 'Banani Block 11, Dhaka',
            ],
            [
                'driver_id' => $carDriver?->id,
                'distance_km' => 10.00,
                'fare_amount' => 450.00,
                'status' => 'completed',
            ]
        );
    }
}
