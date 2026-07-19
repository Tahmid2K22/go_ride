<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiderApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'vehicle_type',
        'license_plate',
        'verification_documents',
        'status',
        'rejection_reason',
        'approved_at',
        'approved_by',
    ];

    protected function casts(): array
    {
        return [
            'verification_documents' => 'array',
            'approved_at' => 'datetime',
        ];
    }

    /**
     * Get the admin user who approved this application.
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Scope for pending applications
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for approved applications
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for rejected applications
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Check if application is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Get human-readable vehicle type
     */
    public function getVehicleTypeLabel(): string
    {
        return match ($this->vehicle_type) {
            'bike' => 'Motorcycle / Bike',
            'car' => 'Car',
            'cng' => 'CNG / Auto-rickshaw',
            default => ucfirst($this->vehicle_type),
        };
    }

    /**
     * Get status badge color for Filament
     */
    public function getStatusColor(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'gray',
        };
    }

    /**
     * Get document path by key
     */
    public function getDocument(string $key): ?string
    {
        $docs = $this->verification_documents ?? [];
        return $docs[$key] ?? null;
    }
};