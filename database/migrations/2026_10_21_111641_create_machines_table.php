<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();

            // Identitas mesin
            $table->string('slug')->unique();
            $table->string('name');

            // Lokasi mesin
            $table->string('room_slug')->default('mechanical');

            // Data listrik
            $table->decimal('power', 8, 2)->default(0);

            // Status penggunaan, bukan tombol ON/OFF
            $table->string('status')->default('available');

            // Pengguna yang sedang memakai mesin
            $table->string('current_user_name')->nullable();
            $table->string('current_user_nim')->nullable();

            // Waktu pemakaian
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ends_at')->nullable();

            // Hubungan ke booking
            $table->foreignId('booking_id')
                ->nullable()
                ->constrained('bookings')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['room_slug', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};