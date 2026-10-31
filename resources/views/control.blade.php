
@extends('layout')

@section('content')

<div style="padding: 30px; color: #4A3425;">

    <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 8px;">
        Room Control
    </h1>

    <p style="color: #8C6548; margin-bottom: 25px;">
        Pilih ruangan untuk melihat informasi perangkat dan penggunaannya.
    </p>

    {{-- Pesan berhasil --}}
    @if (session('success'))
        <div style="
            background: #E8F5E9;
            color: #256029;
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 20px;
        ">
            {{ session('success') }}
        </div>
    @endif

    {{-- Daftar ruangan --}}
    <div style="
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 18px;
    ">

        @foreach ($rooms as $roomSlug => $roomData)

            <a href="{{ route('control', $roomSlug) }}"
               style="
                   display: block;
                   text-decoration: none;
                   color: #4A3425;
                   background: #FFF8EF;
                   border: 1px solid #E8D5C0;
                   border-radius: 16px;
                   padding: 22px;
                   box-shadow: 0 3px 10px rgba(100, 60, 20, 0.05);
               ">

                <div style="font-size: 32px; margin-bottom: 12px;">
                    {{ $roomData['icon'] }}
                </div>

                <h2 style="font-size: 20px; font-weight: bold; margin-bottom: 12px;">
                    {{ $roomData['name'] }}
                </h2>

                <p style="font-size: 14px; color: #8C6548;">
                    Suhu: {{ $roomData['temp'] }} °C
                </p>

                <p style="font-size: 14px; color: #8C6548;">
                    Kelembapan: {{ $roomData['hum'] }} %
                </p>

                <p style="font-size: 14px; color: #8C6548;">
                    Daya: {{ $roomData['power'] }} kW
                </p>

                <p style="font-size: 14px; color: #8C6548;">
                    Pengguna: {{ $roomData['people'] }} orang
                </p>

                <div style="
                    margin-top: 18px;
                    display: inline-block;
                    background: #E87828;
                    color: white;
                    padding: 9px 15px;
                    border-radius: 8px;
                    font-size: 13px;
                ">
                    Lihat Detail →
                </div>

            </a>

        @endforeach

    </div>

    {{-- Detail ruangan --}}
    @if ($room)

        <div style="
            margin-top: 35px;
            background: #FFFFFF;
            border: 1px solid #E8D5C0;
            border-radius: 16px;
            padding: 25px;
        ">

            <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">
                {{ $room['icon'] }} {{ $room['name'] }}
            </h2>

            {{-- Data ruangan --}}
            <div style="
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 15px;
            ">

                <div style="background: #FFF4E8; padding: 16px; border-radius: 10px;">
                    <p style="font-size: 13px; color: #8C6548;">Suhu</p>
                    <h3 style="font-size: 22px; font-weight: bold;">
                        {{ $room['temp'] }} °C
                    </h3>
                </div>

                <div style="background: #FFF4E8; padding: 16px; border-radius: 10px;">
                    <p style="font-size: 13px; color: #8C6548;">Kelembapan</p>
                    <h3 style="font-size: 22px; font-weight: bold;">
                        {{ $room['hum'] }} %
                    </h3>
                </div>

                <div style="background: #FFF4E8; padding: 16px; border-radius: 10px;">
                    <p style="font-size: 13px; color: #8C6548;">Daya</p>
                    <h3 style="font-size: 22px; font-weight: bold;">
                        {{ $room['power'] }} kW
                    </h3>
                </div>

                <div style="background: #FFF4E8; padding: 16px; border-radius: 10px;">
                    <p style="font-size: 13px; color: #8C6548;">Pengguna</p>
                    <h3 style="font-size: 22px; font-weight: bold;">
                        {{ $room['people'] }} orang
                    </h3>
                </div>

            </div>

            {{-- Ruang Meeting: RFID dan data ruangan --}}
            @if ($slug === 'meeting')

                <div style="
                    margin-top: 25px;
                    padding: 20px;
                    background: #FFF4E8;
                    border: 1px solid #E8D5C0;
                    border-radius: 12px;
                ">
                    <h3 style="font-size: 20px; font-weight: bold;">
                        RFID Access
                    </h3>

                    <p style="margin-top: 8px; color: #8C6548;">
                        Ruang Meeting menggunakan RFID untuk akses pengguna.
                        Informasi ruangan dan penggunaan dapat dipantau di sini.
                    </p>

                    <p style="margin-top: 8px; color: #8C6548;">
                        Kontrol lampu tidak tersedia pada halaman ini.
                    </p>
                </div>

            @endif

            {{-- Ruang Mekanik: mesin dari database --}}
            @if ($slug === 'mechanical')

                <h3 style="
                    font-size: 20px;
                    font-weight: bold;
                    margin-top: 30px;
                    margin-bottom: 15px;
                ">
                    Daftar Mesin Ruang Mekanik
                </h3>

                @if ($machines->isEmpty())

                    <p style="color: #8C6548;">
                        Belum ada data mesin untuk ruangan ini.
                    </p>

                @else

                    <div style="
                        display: grid;
                        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
                        gap: 15px;
                    ">

                        @foreach ($machines as $machine)

                            <div style="
                                background: #FFF8EF;
                                border: 1px solid #E8D5C0;
                                border-radius: 12px;
                                padding: 18px;
                            ">

                                <h4 style="
                                    font-size: 17px;
                                    font-weight: bold;
                                    margin-bottom: 12px;
                                ">
                                    ⚙️ {{ $machine->name }}
                                </h4>

                                <p style="font-size: 14px; color: #8C6548;">
                                    Status:
                                    {{ $machine->status === 'available' ? 'Tersedia' : $machine->status }}
                                </p>

                                <p style="font-size: 14px; color: #8C6548;">
                                    Daya: {{ $machine->power ?? 0 }} kW
                                </p>

                                <p style="font-size: 14px; color: #8C6548;">
                                    Pengguna:
                                    {{ $machine->current_user_name ?? 'Belum ada' }}
                                </p>

                                <p style="font-size: 14px; color: #8C6548;">
                                    Mulai:
                                    {{ $machine->started_at ? $machine->started_at->format('d-m-Y H:i') : '-' }}
                                </p>

                                <p style="font-size: 14px; color: #8C6548;">
                                    Selesai:
                                    {{ $machine->ends_at ? $machine->ends_at->format('d-m-Y H:i') : '-' }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                @endif

            @endif

            {{-- Ruang Solder --}}
            @if ($slug === 'solder')

                <div style="
                    margin-top: 25px;
                    padding: 20px;
                    background: #FFF4E8;
                    border: 1px solid #E8D5C0;
                    border-radius: 12px;
                ">
                    <h3 style="font-size: 20px; font-weight: bold;">
                        🔧 Area Solder
                    </h3>

                    <p style="margin-top: 8px; color: #8C6548;">
                        Data penggunaan, daya listrik, dan timer Area Solder
                        dikelola secara terpisah dari 3D Printing.
                    </p>

                </div>

            @endif

            {{-- Ruang 3D Printing --}}
            @if ($slug === '3d')

                <div style="
                    margin-top: 25px;
                    padding: 20px;
                    background: #FFF4E8;
                    border: 1px solid #E8D5C0;
                    border-radius: 12px;
                ">
                    <h3 style="font-size: 20px; font-weight: bold;">
                        🖨️ Area 3D Printing
                    </h3>

                    <p style="margin-top: 8px; color: #8C6548;">
                        Data penggunaan, daya listrik, dan timer 3D Printing
                        dikelola secara terpisah dari Area Solder.
                    </p>

                </div>

            @endif

            {{-- Link monitoring --}}
            <a href="{{ route('monitoring', $slug) }}"
               style="
                   display: inline-block;
                   margin-top: 25px;
                   background: #E87828;
                   color: white;
                   padding: 11px 18px;
                   border-radius: 8px;
                   text-decoration: none;
               ">
                Lihat Room Monitoring
            </a>

        </div>

    @endif

</div>

@endsection
