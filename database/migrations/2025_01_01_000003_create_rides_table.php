<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('driver_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->string('pickup_address');
            $table->string('dropoff_address');
            $table->decimal('distance_km', 8, 2)->default(5.00);
            $table->decimal('fare_amount', 8, 2);
            $table->enum('status', ['pending', 'accepted', 'ongoing', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
