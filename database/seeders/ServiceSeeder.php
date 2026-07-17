<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Moto',
                'slug' => 'moto',
                'icon' => '🏍️',
                'base_fare' => 30.00,
                'per_km_rate' => 12.00,
                'is_active' => true,
            ],
            [
                'name' => 'Car',
                'slug' => 'car',
                'icon' => '🚗',
                'base_fare' => 100.00,
                'per_km_rate' => 35.00,
                'is_active' => true,
            ],
            [
                'name' => 'Parcel',
                'slug' => 'parcel',
                'icon' => '📦',
                'base_fare' => 50.00,
                'per_km_rate' => 15.00,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['slug' => $service['slug']],
                $service
            );
        }
    }
}
