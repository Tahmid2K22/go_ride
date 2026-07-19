<?php

namespace App\Services;

use App\Models\Service;

class RideCalculator
{
    private const EARTH_RADIUS_KM = 6371;

    public function calculateDistance(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $lat1 = deg2rad($lat1);
        $lng1 = deg2rad($lng1);
        $lat2 = deg2rad($lat2);
        $lng2 = deg2rad($lng2);

        $dLat = $lat2 - $lat1;
        $dLng = $lng2 - $lng1;

        $a = sin($dLat / 2) ** 2 + cos($lat1) * cos($lat2) * sin($dLng / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round(self::EARTH_RADIUS_KM * $c, 2);
    }

    public function calculateFare(Service $service, float $distanceKm): float
    {
        return round($service->base_fare + ($service->per_km_rate * $distanceKm), 2);
    }

}
