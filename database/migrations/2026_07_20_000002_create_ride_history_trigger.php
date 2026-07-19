<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Migration: create_ride_history_trigger
 *
 * Creates a MySQL AFTER UPDATE trigger on the `rides` table.
 *
 * LOGIC: When a ride's status changes TO 'completed' or 'cancelled'
 *        (and it wasn't already in that state), automatically insert
 *        an archive row into `ride_histories`.
 *
 * NOTE: Uses raw SQL because Laravel's Schema builder does not support
 *       creating database triggers. The trigger runs in the DB engine,
 *       so it fires even on direct SQL updates, Tinker, or admin tools.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Drop any pre-existing version of the trigger to make this idempotent
        DB::unprepared('DROP TRIGGER IF EXISTS `archive_ride_on_status_change`');

        DB::unprepared("
            CREATE TRIGGER `archive_ride_on_status_change`
            AFTER UPDATE ON `rides`
            FOR EACH ROW
            BEGIN
                -- Only fire when status actually changed TO a terminal state
                IF NEW.status IN ('completed', 'cancelled')
                   AND OLD.status NOT IN ('completed', 'cancelled')
                THEN
                    INSERT INTO `ride_histories`
                        (ride_id, user_id, pickup_location, dropoff_location,
                         vehicle_type, fare, final_status, completed_at,
                         created_at, updated_at)
                    VALUES
                        (
                            NEW.id,
                            NEW.user_id,
                            NEW.pickup_address,
                            NEW.dropoff_address,
                            -- Fetch the service name at trigger time for denormalisation
                            (SELECT name FROM services WHERE id = NEW.service_id LIMIT 1),
                            NEW.fare_amount,
                            NEW.status,             -- 'completed' or 'cancelled'
                            NOW(),                  -- completed_at
                            NOW(),
                            NOW()
                        );
                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `archive_ride_on_status_change`');
    }
};
