<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ride extends Model
{
    protected $fillable = [
        'user_id',
        'driver_id',
        'service_id',
        'pickup_address',
        'dropoff_address',
        'distance_km',
        'fare_amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'distance_km' => 'decimal:2',
            'fare_amount' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
