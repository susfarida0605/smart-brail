
@extends('layout')

@section('title', 'Room Monitoring - SMART BRAIL')
@section('heading', 'Room Monitoring')

@section('content')

<style>
    .monitor-page {
        color: #172033;
    }

    .monitor-heading {
        margin: 0 0 8px;
        font-size: 24px;
        font-weight: 700;
    }

    .monitor-description {
        margin: 0 0 24px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }

    .monitor-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 26px;
    }

    .monitor-summary-card,
    .monitor-card,
    .monitor-detail-card {
        min-width: 0;
        padding: 22px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 3px 12px #0f172a08;
    }

    .monitor-summary-label {
        margin-bottom: 10px;
        color: #64748b;
        font-size: 13px;
    }

    .monitor-summary-value {
        font-size: 28px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .monitor-section-title {
        margin: 0 0 16px;
        font-size: 19px;
        font-weight: 700;
    }

    .monitor-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .monitor-card {
        display: flex;
        flex-direction: column;
    }

    .monitor-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 20px;
    }

    .monitor-card-title {
        margin: 0 0 7px;
        font-size: 18px;
        font-weight: 700;
    }

    .monitor-muted {
        color: #64748b;
        font-size: 12px;
    }

    .monitor-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: #fff7ed;
        font-size: 24px;
    }

    .monitor-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .monitor-status.available {
        color: #166534;
        background: #dcfce7;
        border: 1px solid #bbf7d0;
    }

    .monitor-status.occupied {
        color: #9a3412;
        background: #ffedd5;
        border: 1px solid #fed7aa;
    }

    .monitor-status.other {
        color: #475569;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
    }

    .monitor-metrics {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 18px;
    }

    .monitor-metric {
        padding: 15px;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 10px;
    }

    .monitor-metric-label {
        margin-bottom: 8px;
        color: #64748b;
        font-size: 12px;
    }

    .monitor-metric-value {
        font-size: 22px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .monitor-metric-unit {
        font-size: 12px;
        font-weight: 400;
    }

    .monitor-detail {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 13px;
    }

    .monitor-detail:last-child {
        border-bottom: none;
    }

    .monitor-detail-label {
        color: #64748b;
    }

    .monitor-detail-value {
        text-align: right;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .monitor-card-footer {
        margin-top: auto;
        padding-top: 18px;
    }

    .monitor-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 16px;
        background: #f97316;
        border-radius: 8px;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .monitor-button:hover {
        background: #ea580c;
    }

    .monitor-button-secondary {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #9a3412;
    }

    .monitor-button-secondary:hover {
        background: #ffedd5;
    }

    .monitor-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
    }

    .monitor-filter {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .monitor-select {
        min-width: 190px;
        padding: 11px 12px;
        background: #fff;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        color: #172033;
        font-size: 13px;
    }

    .monitor-note {
        margin-top: 18px;
        padding: 13px 15px;
        background: #fff7ed;
        border: 1px solid #fed7aa;
        border-radius: 9px;
        color: #9a3412;
        font-size: 12px;
        line-height: 1.6;
    }

    .monitor-empty {
        padding: 24px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        color: #64748b;
    }

    @media (max-width: 900px) {
        .monitor-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 650px) {
        .monitor-summary {
            grid-template-columns: 1fr;
        }

        .monitor-toolbar {
            align-items: stretch;
            flex-direction: column;
        }

        .monitor-filter {
            align-items: stretch;
            flex-direction: column;
        }

        .monitor-select,
        .monitor-filter .monitor-button {
            width: 100%;
        }
    }
</style>

<div class="monitor-page">

    @php
        $totalRooms = count($rooms);

        $availableRooms = collect($rooms)
            ->filter(fn ($item) => ($item['status'] ?? '') === 'available')
            ->count();

        $occupiedRooms = collect($rooms)
            ->filter(fn ($item) => ($item['status'] ?? '') === 'occupied')
            ->count();

        $roomIcons = [
            'meeting' => '🏢',
            'mechanical' => '⚙️',
            'solder' => '🔧',
            '3d' => '🖨️',
        ];

        $statusLabels = [
            'available' => 'Tersedia',
            'occupied' => 'Digunakan',
            'maintenance' => 'Pemeliharaan',
        ];
    @endphp

    <h2 class="monitor-heading">
        @if ($room !== null)
            Detail Pemantauan Ruangan
        @else
            Pemantauan Ruangan
        @endif
    </h2>

    <p class="monitor-description">
        @if ($room !== null)
            Pantau informasi dan kondisi ruangan yang dipilih.
        @else
            Pantau status, suhu, kelembapan, daya, dan jumlah pengguna
            seluruh ruangan SMART BRAIL.
        @endif
    </p>

    {{-- RINGKASAN --}}
    <div class="monitor-summary">

        <div class="monitor-summary-card">
            <div class="monitor-summary-label">Total Ruangan</div>
            <div class="monitor-summary-value">{{ $totalRooms }}</div>
        </div>

        <div class="monitor-summary-card">
            <div class="monitor-summary-label">Ruangan Tersedia</div>
            <div class="monitor-summary-value" style="color:#16a34a;">
                {{ $availableRooms }}
            </div>
        </div>

        <div class="monitor-summary-card">
            <div class="monitor-summary-label">Ruangan Digunakan</div>
            <div class="monitor-summary-value" style="color:#ea580c;">
                {{ $occupiedRooms }}
            </div>
        </div>

    </div>

    @if ($room !== null)

        {{-- DETAIL RUANGAN TERPILIH --}}
        <div class="monitor-toolbar">
            <a
                href="{{ route('monitoring') }}"
                class="monitor-button monitor-button-secondary"
            >
                &larr; Kembali ke Semua Ruangan
            </a>

            <a
                href="{{ route('monitoring', ['room' => $slug]) }}"
                class="monitor-button"
            >
                &#8635; Muat Ulang
            </a>
        </div>

        <section class="monitor-detail-card">

            <div class="monitor-card-header">
                <div>
                    <h3 class="monitor-card-title" style="font-size:22px;">
                        {{ $room['name'] }}
                    </h3>

                    <div class="monitor-muted">
                        ID Ruangan: {{ $slug }}
                    </div>
                </div>

                <div class="monitor-icon" aria-hidden="true">
                    {{ $roomIcons[$slug] ?? '🏠' }}
                </div>
            </div>

            <div style="margin-bottom:20px;">
                @php
                    $roomStatus = $room['status'] ?? 'unknown';

                    $statusClass = in_array(
                        $roomStatus,
                        ['available', 'occupied'],
                        true
                    ) ? $roomStatus : 'other';
                @endphp

                <span class="monitor-status {{ $statusClass }}">
                    {{ $statusLabels[$roomStatus] ?? ucfirst($roomStatus) }}
                </span>
            </div>

            <div class="monitor-metrics">

                <div class="monitor-metric">
                    <div class="monitor-metric-label">Suhu Ruangan</div>
                    <div class="monitor-metric-value">
                        {{ $room['temp'] !== null ? number_format((float) $room['temp'], 1, ',', '.') : '—' }}
                        <span class="monitor-metric-unit">°C</span>
                    </div>
                </div>

                <div class="monitor-metric">
                    <div class="monitor-metric-label">Kelembapan</div>
                    <div class="monitor-metric-value">
                        {{ $room['hum'] !== null ? number_format((float) $room['hum'], 1, ',', '.') : '—' }}
                        <span class="monitor-metric-unit">%</span>
                    </div>
                </div>

                <div class="monitor-metric">
                    <div class="monitor-metric-label">Nilai Daya</div>
                    <div class="monitor-metric-value">
                        {{ $room['power'] !== null ? number_format((float) $room['power'], 1, ',', '.') : '—' }}
                        <span class="monitor-metric-unit">satuan belum diverifikasi</span>
                    </div>
                </div>

                <div class="monitor-metric">
                    <div class="monitor-metric-label">Jumlah Pengguna</div>
                    <div class="monitor-metric-value">
                        {{ $room['people'] ?? '—' }}
                        <span class="monitor-metric-unit">orang</span>
                    </div>
                </div>

            </div>

            <h3 class="monitor-section-title">
                Informasi Tambahan
            </h3>

            <div class="monitor-detail">
                <span class="monitor-detail-label">Nama Ruangan</span>
                <span class="monitor-detail-value">{{ $room['name'] }}</span>
            </div>

            <div class="monitor-detail">
                <span class="monitor-detail-label">Status</span>
                <span class="monitor-detail-value">
                    {{ $statusLabels[$roomStatus] ?? ucfirst($roomStatus) }}
                </span>
            </div>

            <div class="monitor-detail">
                <span class="monitor-detail-label">Status Lampu</span>
                <span class="monitor-detail-value">
                    @if ($slug === 'meeting')
                        Tidak ditampilkan untuk ruang Meeting
                    @else
                        {{ ($room['light_on'] ?? false) ? 'Menyala' : 'Mati' }}
                    @endif
                </span>
            </div>

            <div class="monitor-note">
                Data pada halaman ini diambil dari database SMART BRAIL.
                Nilai suhu, kelembapan, daya, dan pengguna belum tentu
                merupakan pembacaan langsung dari perangkat fisik.
            </div>

        </section>

    @else

        {{-- DAFTAR SEMUA RUANGAN --}}
        <div class="monitor-toolbar">

            <h3 class="monitor-section-title" style="margin:0;">
                Daftar Ruangan
            </h3>

            <div class="monitor-filter">
                <label for="room-filter" class="monitor-muted">
                    Pilih ruangan:
                </label>

                <select
                    id="room-filter"
                    class="monitor-select"
                    onchange="if(this.value){window.location.href=this.value;}"
                >
                    <option value="">Semua Ruangan</option>

                    @foreach ($rooms as $roomSlug => $roomData)
                        <option value="{{ route('monitoring', ['room' => $roomSlug]) }}">
                            {{ $roomData['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        @if (count($rooms) > 0)

            <div class="monitor-grid">

                @foreach ($rooms as $roomSlug => $roomData)

                    @php
                        $roomStatus = $roomData['status'] ?? 'unknown';

                        $statusClass = in_array(
                            $roomStatus,
                            ['available', 'occupied'],
                            true
                        ) ? $roomStatus : 'other';
                    @endphp

                    <section class="monitor-card">

                        <div class="monitor-card-header">

                            <div>
                                <h3 class="monitor-card-title">
                                    {{ $roomData['name'] }}
                                </h3>

                                <div class="monitor-muted">
                                    ID Ruangan: {{ $roomSlug }}
                                </div>
                            </div>

                            <div class="monitor-icon" aria-hidden="true">
                                {{ $roomIcons[$roomSlug] ?? '🏠' }}
                            </div>

                        </div>

                        
<div style="margin-bottom:18px; display:flex; flex-wrap:wrap; align-items:center; gap:8px;">
    <span class="monitor-status {{ $statusClass }}">
        {{ $statusLabels[$roomStatus] ?? ucfirst($roomStatus) }}
    </span>

    @if ($roomData['temp'] !== null && $roomData['hum'] !== null)
        <span class="monitor-status available">
            Data suhu & kelembapan tersedia
        </span>
    @else
        <span class="monitor-status other">
            Data sensor belum lengkap
        </span>
    @endif
</div>


                        <div class="monitor-metrics">

                            <div class="monitor-metric">
                                <div class="monitor-metric-label">Suhu</div>
                                <div class="monitor-metric-value">
                                    {{ $roomData['temp'] !== null ? number_format((float) $roomData['temp'], 1, ',', '.') : '—' }}
                                    <span class="monitor-metric-unit">°C</span>
                                </div>
                            </div>

                            <div class="monitor-metric">
                                <div class="monitor-metric-label">Kelembapan</div>
                                <div class="monitor-metric-value">
                                    {{ $roomData['hum'] !== null ? number_format((float) $roomData['hum'], 1, ',', '.') : '—' }}
                                    <span class="monitor-metric-unit">%</span>
                                </div>
                            </div>

                            <div class="monitor-metric">
                                <div class="monitor-metric-label">Nilai Daya</div>
                                <div class="monitor-metric-value">
                                    {{ $roomData['power'] !== null ? number_format((float) $roomData['power'], 1, ',', '.') : '—' }}
                                </div>
                            </div>

                            <div class="monitor-metric">
                                <div class="monitor-metric-label">Pengguna</div>
                                <div class="monitor-metric-value">
                                    {{ $roomData['people'] ?? '—' }}
                                    <span class="monitor-metric-unit">orang</span>
                                </div>
                            </div>

                        </div>

                        <div class="monitor-detail">
                            <span class="monitor-detail-label">Status Ruangan</span>

                            <span class="monitor-detail-value">
                                {{ $statusLabels[$roomStatus] ?? ucfirst($roomStatus) }}
                            </span>
                        </div>

                        
<div class="monitor-detail">
    <span class="monitor-detail-label">ID Ruangan</span>
    <span class="monitor-detail-value">{{ $roomSlug }}</span>
</div>

<div class="monitor-detail">
    <span class="monitor-detail-label">Pembaruan database</span>
    <span class="monitor-detail-value">
        {{ !empty($roomData['updated_at'])
            ? \Illuminate\Support\Carbon::parse($roomData['updated_at'])->format('d/m/Y H:i:s')
            : 'Belum tersedia' }}
    </span>
</div>


                        <div class="monitor-card-footer">
                            <a
                                href="{{ route('monitoring', ['room' => $roomSlug]) }}"
                                class="monitor-button"
                            >
                                Lihat Detail Ruangan &rarr;
                            </a>
                        </div>

                    </section>

                @endforeach

            </div>

        @else

            <div class="monitor-empty">
                Belum ada data ruangan yang dapat ditampilkan.
            </div>

        @endif

        <div class="monitor-note">
            Informasi yang ditampilkan berasal dari database aplikasi.
            Angka daya belum memiliki satuan terverifikasi dan data sensor
            belum dapat dianggap sebagai pengukuran fisik langsung.
        </div>

    @endif

</div>

@endsection
