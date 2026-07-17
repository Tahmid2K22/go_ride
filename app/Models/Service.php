<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'base_fare',
        'per_km_rate',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'base_fare' => 'decimal:2',
            'per_km_rate' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function rides(): HasMany
    {
        return $this->hasMany(Ride::class);
    }
}
