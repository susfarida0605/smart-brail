
@extends('layout')

@section('title', 'Overview - SMART BRAIL')
@section('heading', 'Overview')

@section('content')

<style>
    .overview-page {
        width: 100%;
        color: #172033;
    }

    .overview-topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 24px;
    }

    .overview-title {
        margin: 0;
        font-size: 25px;
        font-weight: 700;
        color: #172033;
    }

    .overview-user {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .overview-user-name {
        color: #475569;
        font-size: 13px;
        font-weight: 600;
    }

    .overview-logout {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 16px;
        border: 0;
        border-radius: 8px;
        background: #dc2626;
        color: #fff;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .overview-logout:hover {
        background: #b91c1c;
    }

    .overview-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .overview-card {
        min-width: 0;
        padding: 22px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, 0.04);
    }

    .overview-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
    }

    .overview-card-title {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #172033;
        overflow-wrap: anywhere;
    }

    .room-status-badge {
        display: inline-block;
        flex-shrink: 0;
        padding: 6px 10px;
        border-radius: 20px;
        background: #e2e8f0;
        color: #334155;
        font-size: 11px;
        font-weight: 700;
    }

    .room-status-available {
        background: #dcfce7;
        color: #166534;
    }

    .room-status-occupied {
        background: #ffedd5;
        color: #9a3412;
    }

    .room-status-other {
        background: #e2e8f0;
        color: #334155;
    }

    .room-light {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding: 12px 14px;
        margin-bottom: 18px;
        background: #f8fafc;
        border-radius: 9px;
    }

    .room-light-label,
    .overview-data-label {
        font-size: 12px;
        color: #64748b;
    }

    .room-light-value {
        font-size: 12px;
        font-weight: 700;
    }

    .light-on {
        color: #15803d;
    }

    .light-off {
        color: #dc2626;
    }

    .overview-room-data {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .overview-data-item {
        min-width: 0;
        padding: 14px;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 9px;
    }

    .overview-data-label {
        margin-bottom: 8px;
    }

    .overview-data-value {
        font-size: 18px;
        font-weight: 700;
        color: #172033;
        overflow-wrap: anywhere;
    }

    .overview-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 9px;
        margin-top: 20px;
        padding-top: 18px;
        border-top: 1px solid #e2e8f0;
    }

    .overview-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 40px;
        padding: 10px 13px;
        border: 0;
        border-radius: 8px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: background 0.15s ease;
    }

    .overview-button-primary {
        background: #f97316;
        color: #fff;
    }

    .overview-button-primary:hover {
        background: #ea580c;
    }

    .overview-button-secondary {
        background: #e2e8f0;
        color: #334155;
    }

    .overview-button-secondary:hover {
        background: #cbd5e1;
    }

    .overview-empty {
        padding: 28px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        color: #64748b;
        text-align: center;
    }

    .overview-note {
        margin-top: 18px;
        padding: 12px 14px;
        border: 1px solid #fed7aa;
        border-radius: 9px;
        background: #fff7ed;
        color: #9a3412;
        font-size: 12px;
        line-height: 1.6;
    }

    @media (max-width: 900px) {
        .overview-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .overview-card {
            padding: 16px;
        }

        .overview-card-title {
            font-size: 16px;
        }

        .overview-room-data {
            gap: 9px;
        }

        .overview-data-item {
            padding: 11px;
        }

        .overview-data-value {
            font-size: 16px;
        }

        .overview-actions {
            flex-direction: column;
        }

        .overview-actions form,
        .overview-actions a,
        .overview-actions .overview-button {
            width: 100%;
            box-sizing: border-box;
        }
    }
</style>

<div class="overview-page">

    <div class="overview-topbar">
        <h2 class="overview-title">Dashboard SMART BRAIL</h2>

        @auth
            <div class="overview-user">
                <span class="overview-user-name">
                    Halo, {{ auth()->user()->name ?? 'Pengguna' }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="overview-logout">
                        Logout
                    </button>
                </form>
            </div>
        @endauth
    </div>

    @if (!empty($rooms) && count($rooms) > 0)

        <div class="overview-grid">

            @foreach ($rooms as $slug => $room)

                @php
                    $roomStatus = $room['status'] ?? 'unknown';

                    $statusClass = match ($roomStatus) {
                        'available' => 'room-status-available',
                        'occupied' => 'room-status-occupied',
                        default => 'room-status-other',
                    };

                    $statusLabel = match ($roomStatus) {
                        'available' => 'Tersedia',
                        'occupied' => 'Terpakai',
                        default => ucfirst(str_replace('_', ' ', $roomStatus)),
                    };

                    $lightOn = (bool) ($room['light_on'] ?? false);
                    $isMeeting = $slug === 'meeting';
                @endphp

                <section class="overview-card">

                    <div class="overview-card-header">
                        <h2 class="overview-card-title">
                            {{ $room['icon'] ?? '🏠' }}
                            {{ $room['name'] ?? 'Ruangan' }}
                        </h2>

                        <span class="room-status-badge {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>
                    </div>

                    <div class="room-light">
                        <span class="room-light-label">
                            {{ $isMeeting ? 'Akses Ruangan' : 'Status Lampu' }}
                        </span>

                        @if ($isMeeting)
                            <span class="room-light-value">RFID</span>
                        @elseif ($lightOn)
                            <span class="room-light-value light-on">
                                ● MENYALA
                            </span>
                        @else
                            <span class="room-light-value light-off">
                                ● MATI
                            </span>
                        @endif
                    </div>

                    <div class="overview-room-data">

                        <div class="overview-data-item">
                            <div class="overview-data-label">Suhu</div>
                            <div class="overview-data-value">
                                {{ $room['temp'] ?? '—' }}{{ isset($room['temp']) ? ' °C' : '' }}
                            </div>
                        </div>

                        <div class="overview-data-item">
                            <div class="overview-data-label">Kelembapan</div>
                            <div class="overview-data-value">
                                {{ $room['hum'] ?? '—' }}{{ isset($room['hum']) ? ' %' : '' }}
                            </div>
                        </div>

                        <div class="overview-data-item">
                            <div class="overview-data-label">Daya</div>
                            <div class="overview-data-value">
                                {{ $room['power'] ?? '—' }}
                            </div>
                            <div class="overview-data-label" style="margin: 5px 0 0;">
                                Satuan perlu diverifikasi
                            </div>
                        </div>

                        <div class="overview-data-item">
                            <div class="overview-data-label">Pengguna</div>
                            <div class="overview-data-value">
                                {{ $room['people'] ?? 0 }} orang
                            </div>
                        </div>

                    </div>

                    <div class="overview-actions">

                        @if (!$isMeeting)
                            <form method="POST"
                                  action="{{ route('light.toggle', $slug) }}">
                                @csrf

                                <button type="submit"
                                        class="overview-button overview-button-primary">
                                    {{ $lightOn ? 'Matikan Lampu' : 'Nyalakan Lampu' }}
                                </button>
                            </form>
                        @else
                            <span class="overview-button overview-button-secondary">
                                RFID Access
                            </span>
                        @endif

                        <a href="{{ route('monitoring', $slug) }}"
                           class="overview-button overview-button-secondary">
                            Lihat Monitoring
                        </a>

                        <a href="{{ route('control', $slug) }}"
                           class="overview-button overview-button-secondary">
                            {{ $isMeeting ? 'Lihat Akses Ruangan' : 'Kontrol Perangkat' }}
                        </a>

                    </div>

                </section>

            @endforeach

        </div>

        <div class="overview-note">
            Data pada halaman ini belum terhubung ke sensor fisik.
            Angka yang ditampilkan merupakan data demo dan tidak boleh
            dianggap sebagai hasil pengukuran aktual.
        </div>

    @else

        <div class="overview-empty">
            <h3>Belum Ada Data Ruangan</h3>
            <p>Data ruangan belum tersedia. Silakan periksa data ruangan di database.</p>
        </div>

    @endif

</div>

@endsection
