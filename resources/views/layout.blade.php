
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMART BRAIL')</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            flex-shrink: 0;
            background: #172033;
            color: #cbd5e1;
            padding: 25px 18px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f97316;
            color: white;
            border-radius: 12px;
            font-size: 22px;
            font-weight: bold;
        }

        .brand h2 {
            margin: 0;
            color: white;
            font-size: 18px;
        }

        .brand p {
            margin: 4px 0 0;
            font-size: 12px;
            color: #94a3b8;
        }

        .menu-title {
            margin: 25px 0 10px;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1.5px;
            color: #64748b;
        }

        .sidebar a {
            display: block;
            text-decoration: none;
            color: #cbd5e1;
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 5px;
            font-size: 14px;
            transition: background 0.2s, color 0.2s;
        }

        .sidebar a:hover {
            background: #293449;
            color: white;
        }

        .sidebar a.active {
            background: #f97316;
            color: white;
        }

        .main {
            flex: 1;
            min-width: 0;
            padding: 30px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .breadcrumb {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .topbar h1 {
            margin: 0;
            font-size: 28px;
            color: #172033;
        }

        .user-info {
            text-align: right;
            font-size: 13px;
        }

        .user-info strong {
            display: block;
            margin-bottom: 4px;
        }

        .user-info span {
            color: #64748b;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 35px;
        }

        .summary-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 3px 12px #0f172a08;
        }

        .summary-label {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 14px;
        }

        .summary-value {
            font-size: 27px;
            font-weight: 700;
            color: #172033;
        }

        .summary-note {
            font-size: 11px;
            color: #16a34a;
            margin-top: 10px;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .section-heading h2 {
            font-size: 20px;
            margin: 0;
        }

        .section-heading span {
            font-size: 12px;
            color: #64748b;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 3px 12px #0f172a08;
        }

        .card h2 {
            margin: 0 0 20px;
            font-size: 19px;
            color: #172033;
        }

        .room-status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #dcfce7;
            color: #15803d;
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .room-status.warning {
            background: #fef3c7;
            color: #b45309;
        }

        .room-data {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .data-label {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 6px;
        }

        .data-value {
            font-size: 19px;
            font-weight: 600;
            color: #172033;
        }

        .room-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 25px;
            padding-top: 18px;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            transition: 0.2s;
            cursor: pointer;
            font-family: inherit;
        }

        .btn-primary {
            background: #f97316;
            color: white;
        }

        .btn-primary:hover {
            background: #ea580c;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        @media (max-width: 1100px) {
            .sidebar { width: 210px; }

            .summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .main { padding: 22px; }
        }

        @media (max-width: 700px) {
            .app { display: block; }

            .sidebar {
                width: 100%;
                padding: 15px;
            }

            .brand { margin-bottom: 15px; }
            .menu-title { margin-top: 15px; }

            .sidebar a {
                display: inline-block;
                margin: 2px;
            }

            .main { padding: 18px; }

            .topbar h1 { font-size: 23px; }

            .topbar {
                align-items: flex-start;
            }

            .grid,
            .summary-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
<div class="app">

    <aside class="sidebar">
        <div class="brand">
            <div class="brand-logo">B</div>
            <div>
                <h2>SMART BRAIL</h2>
                <p>Building Management</p>
            </div>
        </div>

        <div class="menu-title">MAIN MENU</div>

        <a href="{{ route('smartbrail.overview') }}"
           class="{{ request()->routeIs('smartbrail.overview') ? 'active' : '' }}">
            ◫ &nbsp; Overview
        </a>

        <a href="{{ route('booking.list') }}"
           class="{{ request()->routeIs('booking.list') ? 'active' : '' }}">
            ▤ &nbsp; Booking Ruangan
        </a>

        <a href="{{ route('monitoring') }}"
           class="{{ request()->routeIs('monitoring') ? 'active' : '' }}">
            ▤ &nbsp; Room Monitoring
        </a>

        <div class="menu-title">MONITORING</div>

        <a href="{{ route('energy.monitoring') }}"
   class="{{ request()->routeIs('energy.monitoring') ? 'active' : '' }}">
    ⚡ &nbsp; Energy Monitoring
</a>

        <a href="{{ route('sensor.data') }}"
   class="{{ request()->routeIs('sensor.data') ? 'active' : '' }}">
    ◉ &nbsp; Sensor Data
</a>

        <div class="menu-title">SYSTEM</div>

        <a href="{{ route('control') }}"
           class="{{ request()->routeIs('control') ? 'active' : '' }}">
            ⚙ &nbsp; Room Control
        </a>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <div class="breadcrumb">SMART BRAIL / Dashboard</div>
                <h1>@yield('heading', 'Overview')</h1>
            </div>

            <div class="user-info">
                <strong>{{ auth()->user()->name ?? 'Pengguna' }}</strong>
                <span>{{ ucfirst(auth()->user()->role ?? 'user') }}</span>
            </div>
        </header>

        @yield('content')
    </main>

</div>
</body>
</html>
