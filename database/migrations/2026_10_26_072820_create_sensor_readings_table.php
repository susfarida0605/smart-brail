<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel riwayat pembacaan sensor.
     */
    public function up(): void
    {
        Schema::create('sensor_readings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('room_id')
                ->constrained('rooms')
                ->cascadeOnDelete();

            $table->decimal('temperature', 5, 2)->nullable();
            $table->decimal('humidity', 5, 2)->nullable();
            $table->decimal('power', 10, 2)->nullable();

            $table->timestamp('recorded_at')->useCurrent();

            $table->timestamps();

            $table->index(['room_id', 'recorded_at']);
        });
    }

    /**
     * Menghapus tabel riwayat sensor jika migration di-rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_readings');
    }
};
