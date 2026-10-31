<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    /**
     * Menampilkan formulir booking.
     */
    public function create()
    {
        return view('booking.create');
    }

    /**
     * Menyimpan booking baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:50'],
            'room' => ['required', 'in:meeting,mechanical,solder,3d'],

            'machine' => [
                'nullable',
                'required_if:room,mechanical',
                'in:bor,cnc_router,bubut,gerinda,bench_grinder',
            ],

            'cluster' => ['required', 'integer', 'between:1,8'],
            'group_name' => ['required', 'string', 'max:255'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i'],
        ], [
            'machine.required_if' => 'Silakan pilih mesin yang ingin digunakan.',
            'machine.in' => 'Pilihan mesin tidak valid.',
            'booking_date.after_or_equal' => 'Tanggal booking tidak boleh sebelum hari ini.',
        ]);

        // Mesin hanya berlaku untuk ruang mekanik.
        if ($validated['room'] !== 'mechanical') {
            $validated['machine'] = null;
        }

        // Gabungkan tanggal dan jam.
        $start = Carbon::parse(
            $validated['booking_date'] . ' ' . $validated['start_time']
        );

        $end = Carbon::parse(
            $validated['booking_date'] . ' ' . $validated['end_time']
        );

        // Jam selesai harus setelah jam mulai.
        if ($end->lessThanOrEqualTo($start)) {
            throw ValidationException::withMessages([
                'end_time' => 'Jam selesai harus setelah jam mulai.',
            ]);
        }

        // Durasi maksimal lima jam.
        if ($start->diffInMinutes($end) > 300) {
            throw ValidationException::withMessages([
                'end_time' => 'Durasi pemesanan maksimal 5 jam.',
            ]);
        }

        // Periksa jadwal yang bertabrakan.
        $conflict = DB::table('bookings')
            ->where('room', $validated['room'])
            ->where('booking_date', $validated['booking_date'])
            ->where('status', 'booked')
            ->where('start_time', '<', $validated['end_time'])
            ->where('end_time', '>', $validated['start_time']);

        // Untuk ruang mekanik, setiap mesin memiliki jadwal sendiri.
        if ($validated['room'] === 'mechanical') {
            $conflict->where('machine', $validated['machine']);
        }

        if ($conflict->exists()) {
            throw ValidationException::withMessages([
                'start_time' => 'Jadwal sudah dipesan. Silakan pilih waktu lain.',
            ]);
        }

        // Simpan booking beserta ID akun yang sedang login.
        DB::table('bookings')->insert([
            'user_id' => $request->user()->id,
            'user_name' => $validated['user_name'],
            'nim' => $validated['nim'],
            'room' => $validated['room'],
            'machine' => $validated['machine'],
            'cluster' => $validated['cluster'],
            'group_name' => $validated['group_name'],
            'booking_date' => $validated['booking_date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'status' => 'booked',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Mahasiswa diarahkan ke halaman booking miliknya.
        if ($request->user()->role === 'mahasiswa') {
            return redirect()
                ->route('mahasiswa.bookings')
                ->with('success', 'Pemesanan ruangan berhasil disimpan.');
        }

        // Perilaku untuk pengguna selain mahasiswa tetap seperti sebelumnya.
        return redirect()
            ->route('booking.create')
            ->with('success', 'Pemesanan ruangan berhasil disimpan.');
    }

    /**
     * Membatalkan booking melalui fitur yang sudah ada.
     */
    public function cancel($id)
    {
        $booking = DB::table('bookings')
            ->where('id', $id)
            ->first();

        if (!$booking) {
            return redirect()
                ->route('booking.list')
                ->with('error', 'Data booking tidak ditemukan.');
        }

        if ($booking->status !== 'booked') {
            return redirect()
                ->route('booking.list')
                ->with('error', 'Booking ini sudah tidak berstatus aktif.');
        }

        DB::table('bookings')
            ->where('id', $id)
            ->update([
                'status' => 'cancelled',
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('booking.list')
            ->with('success', 'Booking berhasil dibatalkan.');
    }
}