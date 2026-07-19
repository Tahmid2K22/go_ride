<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: create_ride_histories_table
 *
 * Stores an archived record of every completed or cancelled ride.
 * This table is populated automatically by a MySQL trigger (see next migration).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ride_histories', function (Blueprint $table) {
            $table->id();

            // Foreign key back to the original ride request
            $table->foreignId('ride_id')
                  ->constrained('rides')
                  ->cascadeOnDelete();

            // The rider who made the request
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Denormalised snapshot of the trip (so history is preserved even if rides row changes)
            $table->string('pickup_location');
            $table->string('dropoff_location');
            $table->string('vehicle_type')->nullable();   // service name, e.g. "Moto", "Economy"
            $table->decimal('fare', 10, 2)->default(0);

            // Final outcome status: 'completed' | 'cancelled'
            $table->enum('final_status', ['completed', 'cancelled'])->default('completed');

            // When the trip ended
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ride_histories');
    }
};
