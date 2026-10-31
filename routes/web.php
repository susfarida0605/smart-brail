
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingListController;
use App\Http\Controllers\StudentBookingController;
use App\Http\Controllers\RoomUserController;
use App\Models\Room;
use App\Models\SensorReading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman utama website
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $rooms = Room::all()
        ->keyBy('slug')
        ->map(function ($room) {
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
            ];
        })->all();

    return view('welcome', compact('rooms'));
})->name('home');


/*
|--------------------------------------------------------------------------
| Dashboard setelah login
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login');
    }

    if (in_array($user->role, ['admin', 'laboran'], true)) {
        return redirect()->route('smartbrail.overview');
    }

    if ($user->role === 'mahasiswa') {
        return redirect()->route('booking.create');
    }

    if ($user->role === 'dosen') {
        return redirect()->route('home');
    }

    abort(403, 'Role akun tidak dikenali.');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Dashboard khusus mahasiswa
|--------------------------------------------------------------------------
*/

Route::get('/dashboard-mahasiswa', function () {
    return redirect()->route('booking.create');
})
    ->middleware(['auth', 'verified', 'role:mahasiswa'])
    ->name('dashboard.mahasiswa');


/*
|--------------------------------------------------------------------------
| Dashboard pengelola
|--------------------------------------------------------------------------
*/

Route::get('/dashboard-pengelola', function () {
    return redirect()->route('smartbrail.overview');
})
    ->middleware(['auth', 'verified', 'role:admin,laboran'])
    ->name('dashboard.pengelola');


/*
|--------------------------------------------------------------------------
| Halaman pengelola: admin dan laboran
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified',
    'role:admin,laboran',
])->group(function () {

    // Dashboard utama
    Route::get('/smartbrail', [DashboardController::class, 'overview'])
        ->name('smartbrail.overview');

    // Monitoring ruangan
    Route::get('/room-monitoring/{room?}', [DashboardController::class, 'monitoring'])
        ->name('monitoring');

    // Data sensor
    Route::get('/sensor-data', [DashboardController::class, 'sensorData'])
        ->name('sensor.data');

    // Monitoring energi
    Route::get('/energy-monitoring', function (Request $request) {
        $rooms = Room::orderBy('name')->get();

        $period = $request->query('period', '24h');

        if (!in_array($period, ['24h', '7d', '30d'], true)) {
            $period = '24h';
        }

        $since = match ($period) {
            '7d' => now()->subDays(7),
            '30d' => now()->subDays(30),
            default => now()->subDay(),
        };

        $roomSlug = $request->query('room', '');
        $validRoomSlugs = $rooms->pluck('slug')->all();

        if (!in_array($roomSlug, $validRoomSlugs, true)) {
            $roomSlug = '';
        }

        $readingsQuery = SensorReading::with('room')
            ->where('recorded_at', '>=', $since);

        if ($roomSlug !== '') {
            $readingsQuery->whereHas('room', function ($query) use ($roomSlug) {
                $query->where('slug', $roomSlug);
            });
        }

        $readings = $readingsQuery
            ->orderByDesc('recorded_at')
            ->limit(500)
            ->get()
            ->sortBy('recorded_at')
            ->values();

        return view('energy-monitoring', [
            'rooms' => $rooms,
            'readings' => $readings,
            'selectedPeriod' => $period,
            'selectedRoom' => $roomSlug,
        ]);
    })->name('energy.monitoring');

    // Kontrol ruangan
    Route::get('/room-control/{room?}', [DashboardController::class, 'control'])
        ->name('control');

    Route::post('/room-control/{room}/lamp', [DashboardController::class, 'toggleLight'])
        ->name('light.toggle');

    // Daftar seluruh booking untuk admin/laboran
    Route::get('/booking-list', [BookingListController::class, 'index'])
        ->name('booking.list');

    // Pembatalan booking oleh admin/laboran
    Route::post('/booking-list/{id}/cancel', [BookingController::class, 'cancel'])
        ->whereNumber('id')
        ->name('booking.cancel');

    // Pengguna ruangan
    Route::get('/room-users', [RoomUserController::class, 'index'])
        ->name('room-users');
});


/*
|--------------------------------------------------------------------------
| Halaman booking khusus mahasiswa
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified',
    'role:mahasiswa',
])->group(function () {

    // Form pemesanan ruangan
    Route::get('/booking', [BookingController::class, 'create'])
        ->name('booking.create');

    // Simpan pemesanan baru
    Route::post('/booking', [BookingController::class, 'store'])
        ->name('booking.store');

    // Daftar booking milik mahasiswa sendiri
    Route::get('/booking-saya', [StudentBookingController::class, 'index'])
        ->name('mahasiswa.bookings');

    // Pembatalan booking milik mahasiswa sendiri
    Route::post('/booking-saya/{id}/cancel', [StudentBookingController::class, 'cancel'])
        ->whereNumber('id')
        ->name('mahasiswa.bookings.cancel');
});


/*
|--------------------------------------------------------------------------
| Profil pengguna yang sudah login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Route autentikasi Breeze
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
