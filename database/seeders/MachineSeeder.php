<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MachineSeeder extends Seeder
{
    public function run(): void
    {
        $machines = [
            [
                'slug' => 'mesin-bor',
                'name' => 'Mesin Bor',
                'room_slug' => 'mechanical',
            ],
            [
                'slug' => 'laser-cutting',
                'name' => 'Laser Cutting',
                'room_slug' => 'mechanical',
            ],
            [
                'slug' => 'mesin-bubut',
                'name' => 'Mesin Bubut',
                'room_slug' => 'mechanical',
            ],
            [
                'slug' => 'gerinda',
                'name' => 'Gerinda',
                'room_slug' => 'mechanical',
            ],
            [
                'slug' => 'area-solder',
                'name' => 'Area Solder',
                'room_slug' => 'solder',
            ],
            [
                'slug' => 'printer-3d',
                'name' => '3D Printer',
                'room_slug' => '3d',
            ],
        ];

        foreach ($machines as $machine) {
            DB::table('machines')->updateOrInsert(
                ['slug' => $machine['slug']],
                [
                    'name' => $machine['name'],
                    'room_slug' => $machine['room_slug'],
                    'power' => 0,
                    'status' => 'available',
                ]
            );
        }
    }
}