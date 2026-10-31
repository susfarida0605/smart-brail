<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Machine;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Mengambil data semua ruangan dari database.
     */
    private function rooms(): array
    {
        return Room::all()->keyBy('slug')->map(function ($room) {
            return [
                'name' => $room->name,

                'icon' => match ($room->slug) {
                    'meeting' => '🏢',
                    'mechanical' => '⚙️',
                    'solder' => '🔧',
                    '3d' => '🖨️',
                    default => '🏠',
                },

                'temp' => $room->temperature,
                'hum' => $room->humidity,
                'power' => $room->power,
                'people' => $room->people,
                'status' => $room->status,
'light_on' => (bool) $room->light_on,
'updated_at' => $room->updated_at,  
            ];
        })->all();
    }

    /**
     * Halaman Overview.
     */
    public function overview()
    {
        $rooms = $this->rooms();

        $totalRooms = count($rooms);

        $availableRooms = collect($rooms)
            ->filter(fn ($room) => ($room['status'] ?? '') === 'available')
            ->count();

        $occupiedRooms = collect($rooms)
            ->filter(fn ($room) => ($room['status'] ?? '') === 'occupied')
            ->count();

        return view('overview', [
            'rooms' => $rooms,
            'totalRooms' => $totalRooms,
            'availableRooms' => $availableRooms,
            'occupiedRooms' => $occupiedRooms,
        ]);
    }

    /**
     * Halaman Room Monitoring.
     */
    public function monitoring(Request $request, $room = null)
    {
        return $this->roomView('monitoring', $room);
    }

    /**
     * Halaman Room Control.
     */
    public function control(Request $request, $room = null)
    {
        return $this->roomView('control', $room);
    }

    /**
     * Menyiapkan data untuk halaman monitoring dan control.
     */
    private function roomView(string $page, $slug = null)
    {
        $rooms = $this->rooms();

        if ($slug !== null && !isset($rooms[$slug])) {
            abort(404, 'Ruangan tidak ditemukan');
        }

        $machines = collect();

        if ($slug !== null) {
            $machines = Machine::where('room_slug', $slug)
                ->orderBy('name')
                ->get();
        }

        return view($page, [
            'rooms' => $rooms,
            'room' => $slug !== null ? $rooms[$slug] : null,
            'slug' => $slug,
            'machines' => $machines,
        ]);
    }

    /**
     * Mengubah status lampu ruangan.
     */
    public function toggleLight(string $room)
    {
        $roomData = Room::where('slug', $room)->firstOrFail();

        $roomData->light_on = !$roomData->light_on;
        $roomData->save();

        return redirect()
            ->route('control', $roomData->slug)
            ->with('success', 'Status lampu berhasil diubah.');
    }

    /**
     * Halaman Sensor Data.
     */
    
public function sensorData()
{
    $rooms = Room::orderBy('name')->get();

    $readings = \App\Models\SensorReading::with('room')
        ->orderByDesc('recorded_at')
        ->limit(20)
        ->get();

    return view('sensor-data', [
        'rooms' => $rooms,
        'readings' => $readings,
    ]);
}


    /**
     * Halaman umum berdasarkan key route.
     */
    public function page(Request $request)
    {
        $key = $request->route()->defaults['key'] ?? 'page';

        return view('page', [
            'key' => $key,
            'title' => ucfirst(str_replace('-', ' ', $key)),
        ]);
    }
}
