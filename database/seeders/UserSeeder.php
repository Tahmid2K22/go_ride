<?php

namespace Database\Seeders;

use App\Models\DriverProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');

        $admin = User::updateOrCreate(
            ['email' => 'admin@goride.com.bd'],
            [
                'name' => 'System Admin',
                'phone' => '+8801700000000',
                'password' => $password,
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        $rider = User::updateOrCreate(
            ['email' => 'rider@goride.com.bd'],
            [
                'name' => 'Tanvir Ahmed',
                'phone' => '+8801711112233',
                'password' => $password,
                'role' => 'rider',
                'is_active' => true,
            ]
        );

        $bikeDriver = User::updateOrCreate(
            ['email' => 'driver.bike@goride.com.bd'],
            [
                'name' => 'Rahim Uddin',
                'phone' => '+8801811223344',
                'password' => $password,
                'role' => 'driver',
                'is_active' => true,
            ]
        );

        DriverProfile::updateOrCreate(
            ['user_id' => $bikeDriver->id],
            [
                'nid_number' => '19922691234567891',
                'license_number' => 'DH-8821942',
                'vehicle_type' => 'moto',
                'vehicle_plate_number' => 'Dhaka Metro-HA-12-3456',
                'verification_status' => 'approved',
                'is_online' => true,
            ]
        );

        $carDriver = User::updateOrCreate(
            ['email' => 'driver.car@goride.com.bd'],
            [
                'name' => 'Karem Hossain',
                'phone' => '+8801911223344',
                'password' => $password,
                'role' => 'driver',
                'is_active' => true,
            ]
        );

        DriverProfile::updateOrCreate(
            ['user_id' => $carDriver->id],
            [
                'nid_number' => '19882691234567892',
                'license_number' => 'DH-9921831',
                'vehicle_type' => 'car-ac',
                'vehicle_plate_number' => 'Dhaka Metro-GA-45-6789',
                'verification_status' => 'approved',
                'is_online' => false,
            ]
        );
    }
}
