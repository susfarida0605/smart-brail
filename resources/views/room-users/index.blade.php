@extends('layout')

@section('content')

<div style="padding: 30px; color: #4A3425;">

    <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 8px;">
        Room User
    </h1>

    <p style="color: #8C6548; margin-bottom: 25px;">
        Daftar pemesanan ruangan dan mesin SMART BRAIL
    </p>

    @if ($bookings->isEmpty())

        <div style="
            background: #FFF4E8;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #F0D6B8;
        ">
            <p style="font-weight: bold;">
                Belum ada data pemesanan.
            </p>

            <p style="margin-top: 8px;">
                Silakan buat pemesanan terlebih dahulu melalui halaman Booking.
            </p>

            <a href="{{ route('booking.create') }}"
               style="
                   display: inline-block;
                   margin-top: 15px;
                   background: #E87828;
                   color: white;
                   padding: 10px 18px;
                   border-radius: 8px;
                   text-decoration: none;
               ">
                Buat Booking
            </a>
        </div>

    @else

        <div style="
            overflow-x: auto;
            background: #FFFFFF;
            border: 1px solid #E8D8C8;
            border-radius: 12px;
        ">

            <table style="
                width: 100%;
                border-collapse: collapse;
                min-width: 900px;
            ">

                <thead style="background: #FFF0DF;">

                    <tr>
                        <th style="padding: 14px; text-align: left;">No</th>
                        <th style="padding: 14px; text-align: left;">Nama</th>
                        <th style="padding: 14px; text-align: left;">NIM</th>
                        <th style="padding: 14px; text-align: left;">Ruangan</th>
                        <th style="padding: 14px; text-align: left;">Mesin</th>
                        <th style="padding: 14px; text-align: left;">Cluster</th>
                        <th style="padding: 14px; text-align: left;">Kelompok</th>
                        <th style="padding: 14px; text-align: left;">Tanggal</th>
                        <th style="padding: 14px; text-align: left;">Jam</th>
                        <th style="padding: 14px; text-align: left;">Status</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach ($bookings as $booking)

                        <tr style="border-top: 1px solid #F0E4D8;">

                            <td style="padding: 14px;">
                                {{ $loop->iteration }}
                            </td>

                            <td style="padding: 14px;">
                                {{ $booking->user_name }}
                            </td>

                            <td style="padding: 14px;">
                                {{ $booking->nim }}
                            </td>

                            <td style="padding: 14px;">
                                @switch($booking->room)
                                    @case('meeting')
                                        Meeting
                                        @break

                                    @case('mechanical')
                                        Mechanical
                                        @break

                                    @case('solder')
                                        Solder
                                        @break

                                    @case('3d')
                                        3D Printer
                                        @break

                                    @default
                                        {{ $booking->room }}
                                @endswitch
                            </td>

                            <td style="padding: 14px;">
                                @switch($booking->machine)
                                    @case('bor')
                                        Mesin Bor
                                        @break

                                    @case('laser_cutting')
                                        Laser Cutting
                                        @break

                                    @case('bubut')
                                        Mesin Bubut
                                        @break

                                    @case('gerinda')
                                        Gerinda
                                        @break

                                    @default
                                        -
                                @endswitch
                            </td>

                            <td style="padding: 14px;">
                                {{ $booking->cluster }}
                            </td>

                            <td style="padding: 14px;">
                                {{ $booking->group_name }}
                            </td>

                            <td style="padding: 14px;">
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d-m-Y') }}
                            </td>

                            <td style="padding: 14px;">
                                {{ substr($booking->start_time, 0, 5) }}
                                -
                                {{ substr($booking->end_time, 0, 5) }}
                            </td>

                            <td style="padding: 14px;">
                                <span style="
                                    background: #FFF0DF;
                                    color: #A65316;
                                    padding: 6px 10px;
                                    border-radius: 20px;
                                    font-size: 12px;
                                ">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @endif

</div>

@endsection