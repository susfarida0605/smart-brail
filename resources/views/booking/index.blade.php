
@extends('layout')

@section('title', 'Daftar Booking - SMART BRAIL')

@section('heading', 'Daftar Booking Ruangan')

@section('content')

<style>
    .booking-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 24px;
        box-shadow: 0 3px 12px #0f172a08;
    }

    .booking-table-wrapper {
        width: 100%;
        overflow-x: auto;
        margin-top: 20px;
    }

    .booking-table {
        width: 100%;
        min-width: 1000px;
        border-collapse: collapse;
        font-size: 13px;
    }

    .booking-table th,
    .booking-table td {
        padding: 13px 12px;
        border-bottom: 1px solid #e2e8f0;
        text-align: left;
        white-space: nowrap;
    }

    .booking-table th {
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
    }

    .booking-table tr:hover {
        background: #f8fafc;
    }

    .booking-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        background: #dcfce7;
        color: #15803d;
        font-size: 11px;
        font-weight: 600;
    }

    .booking-status.cancelled {
        background: #fee2e2;
        color: #b91c1c;
    }

    .booking-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .booking-header p {
        color: #64748b;
        font-size: 13px;
        margin: 8px 0 0;
    }

    .booking-message {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .booking-message.success {
        background: #dcfce7;
        color: #166534;
    }

    .booking-message.error {
        background: #fee2e2;
        color: #991b1b;
    }

    .btn-danger {
        background: #dc2626;
        color: white;
        border: none;
        cursor: pointer;
        font-family: inherit;
    }

    .btn-danger:hover {
        background: #b91c1c;
    }
</style>

<div class="booking-card">

    {{-- Pesan berhasil --}}
    @if (session('success'))
        <div class="booking-message success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan gagal --}}
    @if (session('error'))
        <div class="booking-message error">
            {{ session('error') }}
        </div>
    @endif

    <div class="booking-header">
        <div>
            <h2 style="margin: 0; font-size: 20px;">
                Data Booking
            </h2>

            <p>
                Daftar pemesanan ruangan SMART BRAIL
            </p>
        </div>

        <a href="{{ route('booking.create') }}" class="btn btn-primary">
            + Booking Baru
        </a>
    </div>

    <div class="booking-table-wrapper">
        <table class="booking-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>NIM</th>
                    <th>Cluster</th>
                    <th>Kelompok</th>
                    <th>Ruangan</th>
                    <th>Mesin</th>
                    <th>Tanggal</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->user_name }}</td>
                        <td>{{ $booking->nim }}</td>
                        <td>{{ $booking->cluster }}</td>
                        <td>{{ $booking->group_name }}</td>
                        <td>{{ $booking->room }}</td>
                        <td>{{ $booking->machine ?? '-' }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->start_time }}</td>
                        <td>{{ $booking->end_time }}</td>

                        <td>
                            <span class="booking-status {{ $booking->status === 'cancelled' ? 'cancelled' : '' }}">
                                {{ $booking->status === 'cancelled' ? 'Cancelled' : 'Booked' }}
                            </span>
                        </td>

                        <td>
                            @if ($booking->status === 'booked')
                                <form
                                    action="{{ route('booking.cancel', $booking->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin membatalkan booking ini?')"
                                >
                                    @csrf

                                    <button type="submit" class="btn btn-danger">
                                        Batalkan
                                    </button>
                                </form>
                            @else
                                -
                            @endif
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="11" style="text-align: center; padding: 30px;">
                            Belum ada data booking ruangan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
