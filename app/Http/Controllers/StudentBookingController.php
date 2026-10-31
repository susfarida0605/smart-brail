<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentBookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = DB::table('bookings')
            ->where('user_id', $request->user()->id)
            ->orderByDesc('booking_date')
            ->orderByDesc('start_time')
            ->get();

        return view('mahasiswa.bookings', compact('bookings'));
    }

    public function cancel(Request $request, int $id)
    {
        $booking = DB::table('bookings')
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$booking) {
            return redirect()
                ->route('mahasiswa.bookings')
                ->with('error', 'Booking tidak ditemukan atau bukan milik Anda.');
        }

        if ($booking->status !== 'booked') {
            return redirect()
                ->route('mahasiswa.bookings')
                ->with('error', 'Booking ini sudah tidak aktif.');
        }

        DB::table('bookings')
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->where('status', 'booked')
            ->update([
                'status' => 'cancelled',
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('mahasiswa.bookings')
            ->with('success', 'Booking berhasil dibatalkan.');
    }
}
