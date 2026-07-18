<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DriverProfile extends Model
{
    protected $fillable = [
        'user_id',
        'nid_number',
        'license_number',
        'vehicle_type',
        'vehicle_plate_number',
        'verification_status',
        'is_online',
    ];

    protected function casts(): array
    {
        return [
            'is_online' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
