
@extends('layout')

@section('title', 'Energy Monitoring - SMART BRAIL')
@section('heading', 'Energy Monitoring')

@section('content')

<style>
    .energy-page {
        color: #172033;
    }

    .energy-heading {
        margin: 0 0 8px;
        font-size: 24px;
        font-weight: 700;
    }

    .energy-description {
        margin: 0 0 24px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }

    .energy-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 24px;
    }

    .energy-summary-card,
    .energy-card,
    .energy-filter-card {
        min-width: 0;
        padding: 22px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 3px 12px #0f172a08;
    }

    .energy-summary-label {
        margin-bottom: 12px;
        color: #64748b;
        font-size: 13px;
    }

    .energy-summary-value {
        color: #172033;
        font-size: 28px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .energy-summary-note {
        margin-top: 8px;
        color: #64748b;
        font-size: 12px;
        line-height: 1.5;
    }

    .energy-section-title {
        margin: 0 0 16px;
        font-size: 19px;
        font-weight: 700;
        color: #172033;
    }

    .energy-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .energy-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 20px;
    }

    .energy-card-title {
        margin: 0 0 7px;
        font-size: 18px;
        font-weight: 700;
        color: #172033;
    }

    .energy-room-id {
        color: #64748b;
        font-size: 12px;
    }

    .energy-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        background: #fff7ed;
        border-radius: 12px;
        font-size: 23px;
    }

    .energy-meter {
        margin-bottom: 18px;
        padding: 18px;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 10px;
    }

    .energy-meter-label {
        margin-bottom: 8px;
        color: #64748b;
        font-size: 12px;
    }

    .energy-meter-value {
        color: #172033;
        font-size: 27px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .energy-detail {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 11px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 13px;
    }

    .energy-detail:last-child {
        border-bottom: none;
    }

    .energy-detail-label {
        color: #64748b;
    }

    .energy-detail-value {
        color: #172033;
        font-weight: 600;
        text-align: right;
    }

    .energy-badge {
        display: inline-block;
        padding: 6px 10px;
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 20px;
        color: #92400e;
        font-size: 11px;
        font-weight: 600;
    }

    .energy-note {
        margin-top: 16px;
        padding: 12px 14px;
        background: #fff7ed;
        border: 1px solid #fed7aa;
        border-radius: 9px;
        color: #9a3412;
        font-size: 12px;
        line-height: 1.6;
    }

    .energy-empty {
        padding: 24px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        color: #64748b;
    }

    .energy-actions {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .energy-refresh {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        background: #f97316;
        border-radius: 8px;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .energy-refresh:hover {
        background: #ea580c;
    }

    .energy-filter-card {
        margin-bottom: 28px;
    }

    .energy-filter-form {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        gap: 16px;
    }

    .energy-filter-group {
        display: flex;
        flex: 1;
        flex-direction: column;
        gap: 7px;
        min-width: 180px;
    }

    .energy-filter-label {
        color: #475569;
        font-size: 13px;
        font-weight: 600;
    }

    .energy-filter-select {
        width: 100%;
        padding: 11px 12px;
        background: #fff;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        color: #172033;
        font-size: 14px;
    }

    .energy-filter-button {
        padding: 12px 18px;
        background: #f97316;
        border: none;
        border-radius: 8px;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .energy-filter-button:hover {
        background: #ea580c;
    }

    .energy-filter-reset {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 14px;
        color: #475569;
        font-size: 13px;
        text-decoration: none;
    }

    .energy-filter-reset:hover {
        color: #ea580c;
    }

    @media (max-width: 900px) {
        .energy-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 650px) {
        .energy-summary {
            grid-template-columns: 1fr;
        }

        .energy-filter-form {
            flex-direction: column;
            align-items: stretch;
        }

        .energy-filter-group {
            width: 100%;
            min-width: 0;
        }

        .energy-filter-button,
        .energy-filter-reset {
            width: 100%;
        }
    }
</style>

<div class="energy-page">

    <h2 class="energy-heading">Pemantauan Energi Ruangan</h2>

    <p class="energy-description">
        Ringkasan nilai daya dan jumlah pengguna pada setiap ruangan
        SMART BRAIL berdasarkan data yang tersimpan di database.
    </p>

    @php
        $totalRooms = $rooms->count();

        $totalPower = $rooms
            ->pluck('power')
            ->filter(fn ($value) => $value !== null)
            ->sum();

        $totalPeople = $rooms
            ->pluck('people')
            ->filter(fn ($value) => $value !== null)
            ->sum();
    @endphp

    <div class="energy-summary">

        <div class="energy-summary-card">
            <div class="energy-summary-label">Total Ruangan</div>

            <div class="energy-summary-value">
                {{ $totalRooms }}
            </div>

            <div class="energy-summary-note">
                Ruangan yang tercatat di database
            </div>
        </div>

        <div class="energy-summary-card">
            <div class="energy-summary-label">Jumlah Nilai Daya</div>

            <div class="energy-summary-value">
                {{ number_format((float) $totalPower, 1, ',', '.') }}
            </div>

            <div class="energy-summary-note">
                Penjumlahan nilai daya yang tersedia.
                Satuan belum diverifikasi.
            </div>
        </div>

        <div class="energy-summary-card">
            <div class="energy-summary-label">Total Pengguna Ruangan</div>

            <div class="energy-summary-value">
                {{ $totalPeople }}
            </div>

            <div class="energy-summary-note">
                Jumlah pengguna berdasarkan data database
            </div>
        </div>

    </div>

    <div class="energy-actions">
        <a href="{{ route('energy.monitoring', [
            'period' => $selectedPeriod ?? '24h',
            'room' => $selectedRoom ?? ''
        ]) }}" class="energy-refresh">
            &#8635; Muat Ulang Data
        </a>
    </div>

    {{-- FILTER PEMANTAUAN --}}
    <section class="energy-filter-card">

        <h2 class="energy-section-title">
            Filter Riwayat Pemantauan
        </h2>

        <form
            action="{{ route('energy.monitoring') }}"
            method="GET"
            class="energy-filter-form"
        >

            <div class="energy-filter-group">
                <label for="period" class="energy-filter-label">
                    Periode Riwayat
                </label>

                <select
                    name="period"
                    id="period"
                    class="energy-filter-select"
                >
                    <option
                        value="24h"
                        {{ ($selectedPeriod ?? '24h') === '24h' ? 'selected' : '' }}
                    >
                        24 Jam Terakhir
                    </option>

                    <option
                        value="7d"
                        {{ ($selectedPeriod ?? '24h') === '7d' ? 'selected' : '' }}
                    >
                        7 Hari Terakhir
                    </option>

                    <option
                        value="30d"
                        {{ ($selectedPeriod ?? '24h') === '30d' ? 'selected' : '' }}
                    >
                        30 Hari Terakhir
                    </option>
                </select>
            </div>

            <div class="energy-filter-group">
                <label for="room" class="energy-filter-label">
                    Pilih Ruangan
                </label>

                <select
                    name="room"
                    id="room"
                    class="energy-filter-select"
                >
                    <option value="">
                        Semua Ruangan
                    </option>

                    @foreach ($rooms as $roomOption)
                        <option
                            value="{{ $roomOption->slug }}"
                            {{ ($selectedRoom ?? '') === $roomOption->slug ? 'selected' : '' }}
                        >
                            {{ $roomOption->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="energy-filter-button">
                Terapkan Filter
            </button>

            <a
                href="{{ route('energy.monitoring') }}"
                class="energy-filter-reset"
            >
                Reset
            </a>

        </form>

        <div class="energy-summary-note" style="margin-top: 12px;">
            Filter periode dan ruangan berlaku untuk grafik riwayat
            di bawah ini. Ringkasan dan detail ruangan tetap menampilkan
            semua ruangan.
        </div>

    </section>

    <h2 class="energy-section-title">
        Grafik Pemantauan Daya
    </h2>

    <div class="energy-grid" style="margin-bottom: 28px;">

        {{-- PERBANDINGAN DAYA --}}
        <section class="energy-card">

            <div class="energy-card-header">
                <div>
                    <h3 class="energy-card-title">
                        Perbandingan Daya Ruangan
                    </h3>

                    <div class="energy-room-id">
                        Perbandingan nilai daya yang tersimpan di database
                    </div>
                </div>

                <div class="energy-icon" aria-hidden="true">📊</div>
            </div>

            @php
                $maxPower = max(1, (float) $rooms->max('power'));
            @endphp

            @forelse ($rooms as $room)
                <div style="margin-bottom: 18px;">

                    <div style="display:flex; justify-content:space-between; gap:12px; margin-bottom:7px; font-size:13px;">
                        <span>{{ $room->name }}</span>

                        <strong>
                            {{ $room->power !== null
                                ? number_format((float) $room->power, 1, ',', '.')
                                : '—' }}
                        </strong>
                    </div>

                    <div style="height:12px; background:#f1f5f9; border-radius:20px; overflow:hidden;">
                        <div
                            style="height:100%; width:{{ $room->power !== null ? min(100, max(0, (float) $room->power / $maxPower * 100)) : 0 }}%; background:#f97316; border-radius:20px;"
                        ></div>
                    </div>

                </div>
            @empty
                <p>Belum ada data ruangan untuk dibandingkan.</p>
            @endforelse

            <div class="energy-note">
                Grafik ini memakai nilai daya yang tersimpan, bukan
                hasil pengukuran sensor fisik yang telah diverifikasi.
            </div>

        </section>

        {{-- RIWAYAT DAYA --}}
        <section class="energy-card">

            <div class="energy-card-header">
                <div>
                    <h3 class="energy-card-title">
                        Riwayat Nilai Daya
                    </h3>

                    <div class="energy-room-id">
                        @switch($selectedPeriod ?? '24h')
                            @case('7d')
                                Riwayat 7 hari terakhir
                                @break
                            @case('30d')
                                Riwayat 30 hari terakhir
                                @break
                            @default
                                Riwayat 24 jam terakhir
                        @endswitch

                        @if (!empty($selectedRoom))
                            @php
                                $selectedRoomName = $rooms->firstWhere('slug', $selectedRoom)?->name;
                            @endphp

                            — {{ $selectedRoomName ?? 'Ruangan terpilih' }}
                        @else
                            — Semua ruangan
                        @endif
                    </div>
                </div>

                <div class="energy-icon" aria-hidden="true">📈</div>
            </div>

            @php
                $historyGroups = $readings->groupBy(
                    fn ($reading) => $reading->room?->name ?? 'Ruangan tidak diketahui'
                );
            @endphp

            @if ($readings->isNotEmpty())

                <div style="display:flex; flex-direction:column; gap:18px;">

                    @foreach ($historyGroups as $roomName => $history)

                        @php
                            $history = $history->sortBy('recorded_at');

                            $historyMax = max(
                                1,
                                (float) $history->max('power')
                            );

                            $historyCount = $history->count();
                        @endphp

                        <div>

                            <div style="font-size:13px; font-weight:700; margin-bottom:10px;">
                                {{ $roomName }}
                            </div>

                            <div style="display:flex; align-items:flex-end; gap:4px; height:100px; padding:8px 0; border-bottom:1px solid #e2e8f0;">

                                @foreach ($history as $reading)
                                    <div
                                        title="{{ $reading->recorded_at?->format('d/m/Y H:i') }} — {{ $reading->power ?? 'Tidak ada nilai' }}"
                                        style="flex:1; min-width:3px; max-width:24px; height:{{ $reading->power !== null ? max(3, min(100, (float) $reading->power / $historyMax * 100)) : 3 }}%; background:#f97316; border-radius:4px 4px 0 0;"
                                    ></div>
                                @endforeach

                            </div>

                            <div style="display:flex; justify-content:space-between; gap:8px; margin-top:7px; color:#64748b; font-size:11px;">
                                <span>
                                    {{ $history->first()->recorded_at?->format('d/m H:i') ?? '—' }}
                                </span>

                                <span>
                                    {{ $history->last()->recorded_at?->format('d/m H:i') ?? '—' }}
                                </span>
                            </div>

                            <div style="font-size:12px; color:#64748b; margin-top:5px;">
                                {{ $historyCount }} catatan
                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="energy-empty">
                    Belum ada riwayat daya untuk filter yang dipilih.
                    Coba pilih periode lain atau pilih Semua Ruangan.
                </div>

            @endif

            <div class="energy-note">
                Riwayat ini berasal dari tabel sensor_readings.
                Jika nilainya masih berupa data demo, grafik juga
                mencerminkan data demo tersebut.
            </div>

        </section>

    </div>

    {{-- DETAIL RUANGAN --}}
    <h2 class="energy-section-title">
        Detail Daya per Ruangan
    </h2>

    @if ($rooms->isNotEmpty())

        <div class="energy-grid">

            @foreach ($rooms as $room)

                <section class="energy-card">

                    <div class="energy-card-header">

                        <div>
                            <h3 class="energy-card-title">
                                {{ $room->name }}
                            </h3>

                            <div class="energy-room-id">
                                ID Ruangan: {{ $room->slug }}
                            </div>
                        </div>

                        <div class="energy-icon" aria-hidden="true">
                            ⚡
                        </div>

                    </div>

                    <div class="energy-meter">

                        <div class="energy-meter-label">
                            Nilai Daya Tercatat
                        </div>

                        <div class="energy-meter-value">
                            {{ $room->power !== null
                                ? number_format((float) $room->power, 1, ',', '.')
                                : '—' }}
                        </div>

                        <div class="energy-meter-label">
                            Satuan belum diverifikasi
                        </div>

                    </div>

                    <div class="energy-detail">
                        <span class="energy-detail-label">
                            Suhu ruangan
                        </span>

                        <span class="energy-detail-value">
                            {{ $room->temperature !== null
                                ? $room->temperature . ' °C'
                                : '—' }}
                        </span>
                    </div>

                    <div class="energy-detail">
                        <span class="energy-detail-label">
                            Kelembapan
                        </span>

                        <span class="energy-detail-value">
                            {{ $room->humidity !== null
                                ? $room->humidity . ' %'
                                : '—' }}
                        </span>
                    </div>

                    <div class="energy-detail">
                        <span class="energy-detail-label">
                            Jumlah pengguna
                        </span>

                        <span class="energy-detail-value">
                            {{ $room->people !== null
                                ? $room->people . ' orang'
                                : '—' }}
                        </span>
                    </div>

                    <div class="energy-detail">
                        <span class="energy-detail-label">
                            Status ruangan
                        </span>

                        <span class="energy-detail-value">
                            {{ $room->status
                                ? ucfirst($room->status)
                                : 'Belum diketahui' }}
                        </span>
                    </div>

                    <div style="margin-top: 16px;">
                        <span class="energy-badge">
                            DATA DATABASE
                        </span>
                    </div>

                    <div class="energy-note">
                        Nilai ini berasal dari database aplikasi,
                        bukan pengukuran energi secara langsung.
                        Data energi aktual memerlukan sensor yang
                        terhubung dan satuan pengukuran yang terverifikasi.
                    </div>

                </section>

            @endforeach

        </div>

    @else

        <div class="energy-empty">
            <strong>Data ruangan belum tersedia.</strong>

            <p>
                Tambahkan data ruangan terlebih dahulu agar
                informasi Energy Monitoring dapat ditampilkan.
            </p>
        </div>

    @endif

</div>

@endsection
