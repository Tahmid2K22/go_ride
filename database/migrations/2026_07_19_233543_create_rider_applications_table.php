<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rider_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->enum('vehicle_type', ['bike', 'car', 'cng'])->comment('Vehicle type: bike, car, or cng');
            $table->string('license_plate')->comment('Vehicle license plate number');
            $table->json('verification_documents')->comment('JSON array of document paths: nid_front, nid_back, driving_license');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->index();
            $table->text('rejection_reason')->nullable()->comment('Admin note when rejecting application');
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete()->comment('Admin who approved');
            $table->timestamps();

            // Indexes for common queries
            $table->index(['status', 'vehicle_type']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rider_applications');
    }
};