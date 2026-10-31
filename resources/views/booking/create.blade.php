
@extends('layout')

@section('title', 'Pemesanan Ruangan - SMART BRAIL')

@section('content')
<div style="max-width: 850px; margin: 0 auto;">
    <h1>Pemesanan Ruangan</h1>
    <p>Isi formulir berikut untuk memesan ruangan SMART BRAIL.</p>

    @if (session('success'))
        <div style="background: #e5f5e8; color: #246b36; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background: #fde8e5; color: #9b2c20; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <strong>Periksa kembali formulir:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('booking.store') }}">
        @csrf

        <div style="background: #fff8ee; padding: 25px; border-radius: 12px;">
            <h2>Data Pengguna</h2>

            <label for="user_name">Nama Lengkap</label>
            <input
                type="text"
                id="user_name"
                name="user_name"
                value="{{ old('user_name') }}"
                required
                style="width: 100%; padding: 10px; margin: 8px 0 18px; box-sizing: border-box;"
            >

            <label for="nim">NIM</label>
            <input
                type="text"
                id="nim"
                name="nim"
                value="{{ old('nim') }}"
                required
                style="width: 100%; padding: 10px; margin: 8px 0 18px; box-sizing: border-box;"
            >

            <label for="cluster">Cluster</label>
            <select
                id="cluster"
                name="cluster"
                required
                style="width: 100%; padding: 10px; margin: 8px 0 18px; box-sizing: border-box;"
            >
                <option value="">Pilih Cluster</option>
                @for ($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}" {{ (string) old('cluster') === (string) $i ? 'selected' : '' }}>
                        Cluster {{ $i }}
                    </option>
                @endfor
            </select>

            <label for="group_name">Kelompok</label>
            <input
                type="text"
                id="group_name"
                name="group_name"
                value="{{ old('group_name') }}"
                placeholder="Isi nama kelompok sendiri"
                required
                style="width: 100%; padding: 10px; margin: 8px 0 18px; box-sizing: border-box;"
            >

            <h2>Ruangan dan Mesin</h2>

            <label for="room">Ruangan yang ingin digunakan</label>
            <select
                id="room"
                name="room"
                required
                style="width: 100%; padding: 10px; margin: 8px 0 18px; box-sizing: border-box;"
            >
                <option value="">Pilih Ruangan</option>
                <option value="meeting" {{ old('room') === 'meeting' ? 'selected' : '' }}>Ruang Meeting</option>
                <option value="mechanical" {{ old('room') === 'mechanical' ? 'selected' : '' }}>Lab Mekanik</option>
                <option value="solder" {{ old('room') === 'solder' ? 'selected' : '' }}>Lab Solder</option>
                <option value="3d" {{ old('room') === '3d' ? 'selected' : '' }}>Area 3D Printer</option>
            </select>

            <div id="machine-field" style="display: none; margin-bottom: 18px;">
                <label for="machine">Mesin yang ingin digunakan</label>
                <select
                    id="machine"
                    name="machine"
                    style="width: 100%; padding: 10px; margin-top: 8px; box-sizing: border-box;"
                >
                    <option value="">Pilih Mesin</option>
                    <option value="bor" {{ old('machine') === 'bor' ? 'selected' : '' }}>Mesin Bor</option>
                    <option value="cnc_router" {{ old('machine') === 'cnc_router' ? 'selected' : '' }}>Mesin CNC Router</option>
                    <option value="bubut" {{ old('machine') === 'bubut' ? 'selected' : '' }}>Mesin Bubut</option>
                    <option value="gerinda" {{ old('machine') === 'gerinda' ? 'selected' : '' }}>Mesin Gerinda</option>
                    <option value="bench_grinder" {{ old('machine') === 'bench_grinder' ? 'selected' : '' }}>Mesin Bench Grinder / Gerinda Duduk</option>
                </select>
            </div>

            <h2>Jadwal Penggunaan</h2>

            <label for="booking_date">Tanggal</label>
            <input
                type="date"
                id="booking_date"
                name="booking_date"
                value="{{ old('booking_date') }}"
                min="{{ now()->toDateString() }}"
                required
                style="width: 100%; padding: 10px; margin: 8px 0 18px; box-sizing: border-box;"
            >

            <label for="start_time">Jam Mulai</label>
            <input
                type="time"
                id="start_time"
                name="start_time"
                value="{{ old('start_time') }}"
                required
                style="width: 100%; padding: 10px; margin: 8px 0 18px; box-sizing: border-box;"
            >

            <label for="end_time">Jam Selesai</label>
            <input
                type="time"
                id="end_time"
                name="end_time"
                value="{{ old('end_time') }}"
                required
                style="width: 100%; padding: 10px; margin: 8px 0 18px; box-sizing: border-box;"
            >

            <p style="color: #9a5b25;">
                Durasi pemesanan maksimal 5 jam.
            </p>

            <button
                type="submit"
                style="background: #d97732; color: white; padding: 12px 25px; border: none; border-radius: 8px; cursor: pointer;"
            >
                Simpan Pemesanan
            </button>
        </div>
    </form>
</div>

<script>
    const roomSelect = document.getElementById('room');
    const machineField = document.getElementById('machine-field');
    const machineSelect = document.getElementById('machine');

    function updateMachineField() {
        const isMechanical = roomSelect.value === 'mechanical';

        machineField.style.display = isMechanical ? 'block' : 'none';
        machineSelect.required = isMechanical;

        if (!isMechanical) {
            machineSelect.value = '';
        }
    }

    roomSelect.addEventListener('change', updateMachineField);
    updateMachineField();
</script>
@endsection
