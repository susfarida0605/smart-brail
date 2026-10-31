
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Identitas pengguna
            $table->string('user_name');
            $table->string('nim');

            // Ruangan dan mesin yang dipilih
            $table->string('room');
            $table->string('machine')->nullable();

            // Cluster dan kelompok
            $table->unsignedTinyInteger('cluster');
            $table->string('group_name');

            // Jadwal pemesanan
            $table->date('booking_date');
            $table->time('start_time');
            $table->time('end_time');

            // Status pemesanan
            $table->string('status')->default('booked');

            $table->timestamps();

            $table->index(['booking_date', 'room']);
            $table->index('nim');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
