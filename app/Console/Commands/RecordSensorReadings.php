<?php

namespace App\Console\Commands;

use App\Models\Room;
use App\Models\SensorReading;
use Illuminate\Console\Command;

class RecordSensorReadings extends Command
{
    protected $signature = 'sensors:record';

    protected $description = 'Menyimpan snapshot data ruangan ke riwayat sensor';

    public function handle(): int
    {
        $rooms = Room::all();

        if ($rooms->isEmpty()) {
            $this->warn('Belum ada data ruangan untuk dicatat.');

            return self::SUCCESS;
        }

        $recordedAt = now();
        $count = 0;

        foreach ($rooms as $room) {
            SensorReading::create([
                'room_id' => $room->id,
                'temperature' => $room->temperature,
                'humidity' => $room->humidity,
                'power' => $room->power,
                'recorded_at' => $recordedAt,
            ]);

            $count++;
        }

        $this->info("Berhasil mencatat {$count} ruangan ke riwayat sensor.");
        $this->warn('Catatan ini berasal dari database aplikasi, bukan pembacaan sensor fisik.');

        return self::SUCCESS;
    }
}
