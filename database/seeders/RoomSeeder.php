<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            [
                'slug' => 'meeting',
                'name' => 'Room Meeting',
                'temperature' => 24.5,
                'humidity' => 55,
                'power' => 1.2,
                'people' => 8,
                'status' => 'Aktif',
            ],
            [
                'slug' => 'mechanical',
                'name' => 'Room Mechanical',
                'temperature' => 28.1,
                'humidity' => 60,
                'power' => 3.4,
                'people' => 5,
                'status' => 'Aktif',
            ],
            [
                'slug' => 'solder',
                'name' => 'Room Solder',
                'temperature' => 30.2,
                'humidity' => 48,
                'power' => 2.1,
                'people' => 3,
                'status' => 'Peringatan',
            ],
            [
                'slug' => '3d',
                'name' => 'Room 3D Printer',
                'temperature' => 26,
                'humidity' => 52,
                'power' => 1.8,
                'people' => 2,
                'status' => 'Aktif',
            ],
        ];

        foreach ($rooms as $room) {
            Room::updateOrCreate(
                ['slug' => $room['slug']],
                $room
            );
        }
    }
}