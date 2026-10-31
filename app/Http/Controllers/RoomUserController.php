<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class RoomUserController extends Controller
{
    public function index()
    {
        $bookings = DB::table('bookings')
            ->orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();

        return view('room-users.index', compact('bookings'));
    }
}