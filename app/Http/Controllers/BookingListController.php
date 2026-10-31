<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BookingListController extends Controller
{
    public function index(): View
    {
        $bookings = DB::table('bookings')
            ->orderByDesc('booking_date')
            ->orderByDesc('start_time')
            ->get();

        return view('booking.index', [
            'bookings' => $bookings,
        ]);
    }
}
