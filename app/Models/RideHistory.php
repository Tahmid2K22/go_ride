<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model: RideHistory
 *
 * Represents an archived trip record — auto-populated by the MySQL trigger
 * when a ride reaches 'completed' or 'cancelled' status.
 *
 * @property int         $id
 * @property int         $ride_id
 * @property int         $user_id
 * @property string      $pickup_location
 * @property string      $dropoff_location
 * @property string|null $vehicle_type
 * @property float       $fare
 * @property string      $final_status      'completed' | 'cancelled'
 * @property \Carbon\Carbon|null $completed_at
 */
class RideHistory extends Model
{
    protected $fillable = [
        'ride_id',
        'user_id',
        'pickup_location',
        'dropoff_location',
        'vehicle_type',
        'fare',
        'final_status',
        'completed_at',
    ];

    protected $casts = [
        'fare'         => 'decimal:2',
        'completed_at' => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    /** The original ride request this history record belongs to */
    public function ride(): BelongsTo
    {
        return $this->belongsTo(Ride::class);
    }

    /** The rider who took this trip */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    /** Returns a short pickup label (first segment before comma) */
    public function shortPickup(): string
    {
        return explode(',', $this->pickup_location)[0];
    }

    /** Returns a short dropoff label (first segment before comma) */
    public function shortDropoff(): string
    {
        return explode(',', $this->dropoff_location)[0];
    }
}
