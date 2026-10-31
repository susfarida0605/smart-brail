
@extends('layout')

@section('title', 'Sensor Data - SMART BRAIL')
@section('heading', 'Sensor Data')

@section('content')

<style>
    .sensor-page {
        color: #172033;
    }

    .sensor-heading {
        margin: 0 0 8px;
        font-size: 24px;
        font-weight: 700;
    }

    .sensor-description {
        margin: 0 0 20px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }

    .sensor-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 22px;
        padding: 16px 18px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
    }

    .sensor-status {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: #475569;
    }

    .sensor-status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #f59e0b;
        flex-shrink: 0;
    }

    .sensor-status strong {
        display: block;
        margin-bottom: 3px;
        color: #92400e;
    }

    .sensor-refresh {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 15px;
        background: #f97316;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }

    .sensor-refresh:hover {
        background: #ea580c;
    }

    .sensor-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 22px;
    }

    .sensor-summary-card {
        padding: 18px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
    }

    .sensor-summary-label {
        margin-bottom: 8px;
        color: #64748b;
        font-size: 13px;
    }

    .sensor-summary-value {
        font-size: 25px;
        font-weight: 700;
        color: #172033;
    }

    .sensor-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .sensor-card {
        min-width: 0;
        padding: 22px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 3px 12px #0f172a08;
    }

    .sensor-card h2 {
        margin: 0 0 8px;
        font-size: 18px;
        color: #172033;
    }

    .sensor-id {
        margin-bottom: 18px;
        color: #64748b;
        font-size: 12px;
    }

    .sensor-values {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .sensor-item {
        min-width: 0;
        padding: 16px;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 10px;
    }

    .sensor-label {
        margin-bottom: 10px;
        color: #64748b;
        font-size: 12px;
    }

    .sensor-value {
        overflow-wrap: anywhere;
        color: #172033;
        font-size: 23px;
        font-weight: 700;
    }

    .sensor-unit {
        font-size: 13px;
        font-weight: 400;
    }

    .sensor-card-status {
        display: inline-block;
        margin-top: 16px;
        padding: 6px 10px;
        color: #92400e;
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .sensor-note {
        margin-top: 12px;
        padding: 12px 14px;
        background: #fff7ed;
        border: 1px solid #fed7aa;
        border-radius: 9px;
        color: #9a3412;
        font-size: 12px;
        line-height: 1.6;
    }

    .sensor-updated {
        margin-top: 12px;
        color: #64748b;
        font-size: 11px;
        line-height: 1.6;
    }

    .sensor-empty {
        padding: 24px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        color: #64748b;
    }

.sensor-history {
    margin-top: 24px;
    padding: 22px;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    box-shadow: 0 3px 12px #0f172a08;
}

.sensor-history h2 {
    margin: 0 0 8px;
    color: #172033;
    font-size: 18px;
}

.sensor-history-description {
    margin: 0 0 18px;
    color: #64748b;
    font-size: 13px;
    line-height: 1.6;
}

.sensor-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.sensor-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
    white-space: nowrap;
}

.sensor-table th {
    padding: 12px;
    background: #fff7ed;
    color: #9a3412;
    text-align: left;
    font-weight: 700;
    border-bottom: 1px solid #fed7aa;
}

.sensor-table td {
    padding: 12px;
    color: #334155;
    border-bottom: 1px solid #e2e8f0;
}

.sensor-table tbody tr:hover {
    background: #f8fafc;
}

.sensor-history-empty {
    padding: 18px;
    color: #64748b;
    background: #f8fafc;
    border-radius: 9px;
    font-size: 13px;
}

    @media (max-width: 900px) {
        .sensor-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .sensor-summary {
            grid-template-columns: 1fr;
        }

        .sensor-values {
            grid-template-columns: 1fr;
        }

        .sensor-toolbar {
            align-items: flex-start;
            flex-direction: column;
        }
    }
    
    .history-section {
        margin-top: 26px;
        padding: 22px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 3px 12px #0f172a08;
    }

    .history-heading {
        margin: 0 0 8px;
        color: #172033;
        font-size: 19px;
        font-weight: 700;
    }

    .history-description {
        margin: 0 0 18px;
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
    }

    .history-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .history-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
        white-space: nowrap;
    }

    .history-table th {
        padding: 13px 14px;
        background: #fff7ed;
        color: #9a3412;
        text-align: left;
        border-bottom: 1px solid #fed7aa;
    }

    .history-table td {
        padding: 13px 14px;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }

    .history-table tbody tr:hover {
        background: #fffaf5;
    }

    .history-empty {
        padding: 22px;
        text-align: center;
        color: #64748b;
        background: #f8fafc;
        border-radius: 8px;
        font-size: 13px;
    }

    .history-badge {
        display: inline-block;
        padding: 5px 9px;
        color: #92400e;
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

</style>

<div class="sensor-page">

    <h2 class="sensor-heading">Pemantauan Sensor Ruangan</h2>

    <p class="sensor-description">
        Pantau suhu, kelembapan, daya, dan jumlah pengguna
        pada setiap ruangan SMART BRAIL.
    </p>

    <div class="sensor-toolbar">
        <div class="sensor-status">
            <span class="sensor-status-dot"></span>

            <div>
                <strong>Mode data aplikasi</strong>
                Data sensor fisik belum terhubung.
            </div>
        </div>

        <a href="{{ url()->current() }}" class="sensor-refresh">
            &#8635; Muat Ulang Data
        </a>
    </div>

    @if ($rooms->isNotEmpty())

        <div class="sensor-summary">

            <div class="sensor-summary-card">
                <div class="sensor-summary-label">Total Ruangan</div>
                <div class="sensor-summary-value">
                    {{ $rooms->count() }}
                </div>
            </div>

            <div class="sensor-summary-card">
                <div class="sensor-summary-label">Suhu Rata-rata</div>
                <div class="sensor-summary-value">
                    @php
                        $temperatures = $rooms
                            ->pluck('temperature')
                            ->filter(fn ($value) => $value !== null);

                        $averageTemperature = $temperatures->isNotEmpty()
                            ? round($temperatures->avg(), 1)
                            : null;
                    @endphp

                    {{ $averageTemperature !== null ? $averageTemperature : '—' }}
                    <span class="sensor-unit">°C</span>
                </div>
            </div>

            <div class="sensor-summary-card">
                <div class="sensor-summary-label">Total Pengguna</div>
                <div class="sensor-summary-value">
                    {{ $rooms->sum('people') }}
                    <span class="sensor-unit">orang</span>
                </div>
            </div>

        </div>

        <div class="sensor-grid">

            @foreach ($rooms as $room)

                <section class="sensor-card">

                    <h2>{{ $room->name }}</h2>

                    <div class="sensor-id">
                        ID Ruangan: {{ $room->slug }}
                    </div>

                    <div class="sensor-values">

                        <div class="sensor-item">
                            <div class="sensor-label">Suhu</div>
                            <div class="sensor-value">
                                {{ $room->temperature !== null ? $room->temperature : '—' }}
                                <span class="sensor-unit">°C</span>
                            </div>
                        </div>

                        <div class="sensor-item">
                            <div class="sensor-label">Kelembapan</div>
                            <div class="sensor-value">
                                {{ $room->humidity !== null ? $room->humidity : '—' }}
                                <span class="sensor-unit">%</span>
                            </div>
                        </div>

                        <div class="sensor-item">
                            <div class="sensor-label">Daya</div>
                            <div class="sensor-value">
                                {{ $room->power !== null ? $room->power : '—' }}
                            </div>
                            <div class="sensor-label">
                                Satuan belum diverifikasi
                            </div>
                        </div>

                        <div class="sensor-item">
                            <div class="sensor-label">Jumlah Pengguna</div>
                            <div class="sensor-value">
                                {{ $room->people !== null ? $room->people : '—' }}
                                <span class="sensor-unit">orang</span>
                            </div>
                        </div>

                    </div>

                    <div class="sensor-card-status">
                        DATA DATABASE
                    </div>

                    <div class="sensor-note">
                        Nilai ini berasal dari database aplikasi dan
                        belum dikonfirmasi oleh sensor fisik.
                    </div>

                    <div class="sensor-updated">
                        Terakhir diubah di database:
                        {{ $room->updated_at
                            ? $room->updated_at->format('d-m-Y H:i:s')
                            : 'Belum tersedia' }}
                    </div>

                </section>

            @endforeach

        </div>

    @else

        <div class="sensor-empty">
            <strong>Data ruangan belum tersedia.</strong>
            <p>Belum ada data ruangan di database aplikasi.</p>
        </div>

   
    @endif

    {{-- Riwayat pencatatan sensor --}}
    <section class="sensor-history">
        <h2>Riwayat Sensor</h2>

        <p class="sensor-history-description">
            Menampilkan maksimal 20 catatan terbaru dari database aplikasi.
            Data ini belum berasal dari sensor fisik.
        </p>

        @if (isset($readings) && $readings->isNotEmpty())
            <div class="sensor-table-wrapper">
                <table class="sensor-table">
                    <thead>
                        <tr>
                            <th>Waktu Pencatatan</th>
                            <th>Ruangan</th>
                            <th>Suhu (°C)</th>
                            <th>Kelembapan (%)</th>
                            <th>Daya*</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($readings as $reading)
                            <tr>
                                <td>
                                    {{ $reading->recorded_at
                                        ? $reading->recorded_at->format('d-m-Y H:i:s')
                                        : '—' }}
                                </td>

                                <td>
                                    {{ $reading->room?->name ?? 'Ruangan tidak tersedia' }}
                                </td>

                                <td>{{ $reading->temperature ?? '—' }}</td>
                                <td>{{ $reading->humidity ?? '—' }}</td>
                                <td>{{ $reading->power ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p class="sensor-history-description" style="margin-top: 14px; margin-bottom: 0;">
                * Satuan daya belum diverifikasi.
            </p>
        @else
            <div class="sensor-history-empty">
                Belum ada riwayat pencatatan. Jalankan perintah
                <code>php artisan sensors:record</code>
                untuk menyimpan snapshot data ruangan.
            </div>
        @endif
    </section>

</div>

    
    {{-- RIWAYAT SENSOR --}}
    <section class="history-section">
        <h2 class="history-heading">Riwayat Sensor</h2>
        <p class="history-description">
            Maksimal 20 rekaman terbaru dari database aplikasi.
        </p>

        @if (isset($readings) && $readings->isNotEmpty())
            <div class="history-table-wrapper">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Ruangan</th>
                            <th>Suhu</th>
                            <th>Kelembapan</th>
                            <th>Daya</th>
                            <th>Waktu Rekaman</th>
                            <th>Sumber</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($readings as $reading)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $reading->room?->name ?? 'Ruangan tidak ditemukan' }}</td>
                                <td>{{ $reading->temperature !== null ? number_format($reading->temperature, 1) . ' °C' : '—' }}</td>
                                <td>{{ $reading->humidity !== null ? number_format($reading->humidity, 1) . ' %' : '—' }}</td>
                                <td>{{ $reading->power !== null ? number_format($reading->power, 2) : '—' }}</td>
                                <td>{{ $reading->recorded_at?->format('d-m-Y H:i:s') ?? '—' }}</td>
                                <td><span class="history-badge">Database aplikasi</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="history-empty">
                Belum ada riwayat sensor.
            </div>
        @endif
    </section>
@endsection

