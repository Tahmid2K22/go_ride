<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ride extends Model
{
    protected $fillable = [
        'user_id',
        'driver_id',
        'service_id',
        'pickup_address',
        'pickup_lat',
        'pickup_lng',
        'dropoff_address',
        'dropoff_lat',
        'dropoff_lng',
        'distance_km',
        'fare_amount',
        'payment_method',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'pickup_lat'  => 'decimal:7',
            'pickup_lng'  => 'decimal:7',
            'dropoff_lat' => 'decimal:7',
            'dropoff_lng' => 'decimal:7',
            'distance_km' => 'decimal:2',
            'fare_amount' => 'decimal:2',
        ];
    }

    // ─── Relationships ────────────────────────────────────────────────────────

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

    /**
     * The archived history record for this ride (created by DB trigger
     * when status changes to 'completed' or 'cancelled').
     */
    public function history(): HasOne
    {
        return $this->hasOne(RideHistory::class);
    }
}
