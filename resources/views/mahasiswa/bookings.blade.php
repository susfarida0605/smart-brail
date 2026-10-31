
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Saya - SMART BRAIL</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        header {
            background: #172033;
            color: white;
            padding: 20px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        header h2 { margin: 0; font-size: 20px; }

        header p {
            margin: 5px 0 0;
            color: #cbd5e1;
            font-size: 13px;
        }

        nav {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 14px;
        }

        nav a.active, nav a:hover {
            background: #f97316;
        }

        main {
            max-width: 1150px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        h1 { margin: 0 0 8px; font-size: 28px; }

        .muted { color: #64748b; font-size: 14px; }

        .button {
            display: inline-block;
            border: 0;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .primary { background: #f97316; color: white; }
        .primary:hover { background: #ea580c; }

        .danger { background: #fee2e2; color: #b91c1c; }

        .message {
            background: #dcfce7;
            color: #166534;
            border-radius: 8px;
            padding: 13px 16px;
            margin-bottom: 15px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            border-radius: 8px;
            padding: 13px 16px;
            margin-bottom: 15px;
        }

        .table-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }

        th {
            background: #f8fafc;
            color: #475569;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .booked { background: #dcfce7; color: #166534; }
        .cancelled { background: #fee2e2; color: #991b1b; }

        .empty {
            text-align: center;
            padding: 45px 20px;
            color: #64748b;
        }

        footer {
            text-align: center;
            color: #64748b;
            font-size: 12px;
            padding: 25px;
        }
    </style>
</head>

<body>
<header>
    <div>
        <h2>SMART BRAIL</h2>
        <p>Portal Mahasiswa</p>
    </div>

    <nav>
        <a href="{{ route('booking.create') }}">Booking Ruangan</a>
        <a href="{{ route('mahasiswa.bookings') }}" class="active">Booking Saya</a>
    </nav>
</header>

<main>
    <div class="heading">
        <div>
            <h1>Booking Saya</h1>
            <div class="muted">
                Halo, {{ auth()->user()->name }}. Berikut daftar booking milik Anda.
            </div>
        </div>

        <a href="{{ route('booking.create') }}" class="button primary">
            + Booking Ruangan
        </a>
    </div>

    @if (session('success'))
        <div class="message">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <div class="table-card">
        @if ($bookings->isEmpty())
            <div class="empty">
                <h3>Belum ada booking</h3>
                <p>Booking yang Anda buat akan muncul di halaman ini.</p>
                <a href="{{ route('booking.create') }}" class="button primary">
                    Buat Booking
                </a>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Ruangan</th>
                        <th>Mesin</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Kelompok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucfirst($booking->room) }}</td>
                            <td>{{ $booking->machine ? ucfirst(str_replace('_', ' ', $booking->machine)) : '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d-m-Y') }}</td>
                            <td>{{ substr($booking->start_time, 0, 5) }}–{{ substr($booking->end_time, 0, 5) }}</td>
                            <td>{{ $booking->group_name }}</td>
                            <td>
                                @if ($booking->status === 'booked')
                                    <span class="status booked">Aktif</span>
                                @else
                                    <span class="status cancelled">Dibatalkan</span>
                                @endif
                            </td>
                            <td>
                                @if ($booking->status === 'booked')
                                    <form
                                        action="{{ route('mahasiswa.bookings.cancel', $booking->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin membatalkan booking ini?')"
                                    >
                                        @csrf
                                        <button type="submit" class="button danger">
                                            Batalkan
                                        </button>
                                    </form>
                                @else
                                    <span class="muted">Tidak ada aksi</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</main>

<footer>
    SMART BRAIL &copy; {{ date('Y') }} — Portal Mahasiswa
</footer>
</body>
</html>
