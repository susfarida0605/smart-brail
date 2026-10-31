
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SMART BRAIL | Smart Laboratory</title>

    <style>
        :root {
            --navy: #101b32;
            --navy-light: #1b2b49;
            --orange: #ff7a1a;
            --cream: #faf7f1;
            --muted: #718096;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Inter, "Segoe UI", Arial, sans-serif;
            color: var(--navy);
            background: var(--cream);
        }

        a {
            text-decoration: none;
        }

        .site-header {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 20px 7%;
            background: var(--cream);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-mark {
            display: grid;
            place-items: center;
            width: 45px;
            height: 45px;
            border-radius: 14px;
            background: var(--orange);
            color: white;
            font-size: 24px;
            font-weight: 900;
            box-shadow: 0 7px 18px rgba(255, 122, 26, .22);
        }

        .brand-name {
            margin: 0;
            font-size: 19px;
            font-weight: 900;
            letter-spacing: 1.3px;
        }

        .brand-caption {
            margin-top: 4px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.8px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .header-label {
            color: #64748b;
            font-size: 12px;
            font-weight: 600;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 13px 20px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 800;
            transition: .2s ease;
        }

        .button-orange {
            background: var(--orange);
            color: white;
            box-shadow: 0 7px 18px rgba(255, 122, 26, .18);
        }

        .button-orange:hover {
            background: #e9670c;
            transform: translateY(-2px);
        }

        .button-outline {
            border: 1px solid rgba(255,255,255,.3);
            color: white;
        }

        .button-outline:hover {
            background: rgba(255,255,255,.08);
        }

        .hero {
            position: relative;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 45px;
            min-height: 570px;
            padding: 65px 7% 80px;
            background:
                radial-gradient(circle at 78% 45%, rgba(255,122,26,.10), transparent 30%),
                var(--cream);
        }

        .hero-copy {
            position: relative;
            z-index: 1;
            max-width: 570px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 9px 13px;
            border: 1px solid #fed7aa;
            border-radius: 30px;
            background: #fff1e5;
            color: #c6530b;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1.5px;
        }

        .eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--orange);
        }

        .hero h1 {
            margin: 24px 0 19px;
            font-size: clamp(38px, 5vw, 63px);
            font-weight: 900;
            line-height: 1.07;
            letter-spacing: -2.3px;
        }

        .hero h1 span {
            color: var(--orange);
        }

        .hero-description {
            max-width: 475px;
            color: #667085;
            font-size: 15px;
            line-height: 1.9;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 30px;
        }

        .hero-footnote {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 27px;
            color: #7b8495;
            font-size: 11px;
            line-height: 1.6;
        }

        .footnote-icon {
            display: grid;
            place-items: center;
            flex-shrink: 0;
            width: 28px;
            height: 28px;
            border-radius: 9px;
            background: #e9eee8;
            color: #47745b;
            font-weight: 900;
        }

        /* Ilustrasi laboratorium dibuat langsung dengan HTML dan CSS */
        .visual-area {
            position: relative;
            min-width: 0;
            padding: 16px 0;
        }

        .visual-glow {
            position: absolute;
            inset: 10% 3%;
            border-radius: 50%;
            background: rgba(255, 122, 26, .14);
            filter: blur(65px);
        }

        .visual-board {
            position: relative;
            overflow: hidden;
            padding: 24px;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 24px;
            background:
                radial-gradient(circle at 100% 0%, rgba(255,122,26,.19), transparent 37%),
                linear-gradient(145deg, #1d2c49, #101a30 75%);
            box-shadow: 0 30px 70px rgba(16, 27, 50, .22);
        }

        .board-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 24px;
        }

        .board-title {
            color: white;
            font-size: 13px;
            font-weight: 800;
        }

        .board-subtitle {
            margin-top: 5px;
            color: #9eabc0;
            font-size: 10px;
        }

        .board-status {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 7px 10px;
            border: 1px solid rgba(134,239,172,.2);
            border-radius: 20px;
            background: rgba(34,197,94,.09);
            color: #86efac;
            font-size: 9px;
            font-weight: 800;
        }

        .board-status span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #4ade80;
        }

        .visual-metrics {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .metric {
            padding: 15px;
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 13px;
            background: rgba(255,255,255,.045);
        }

        .metric-label {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #aab7ca;
            font-size: 10px;
        }

        .metric-icon {
            display: grid;
            place-items: center;
            width: 25px;
            height: 25px;
            border-radius: 8px;
            background: rgba(255,122,26,.15);
            color: #ffac70;
            font-size: 13px;
        }

        .metric-value {
            margin-top: 12px;
            color: white;
            font-size: 25px;
            font-weight: 900;
        }

        .metric-detail {
            margin-top: 5px;
            color: #9eabc0;
            font-size: 9px;
        }

        .chart-panel {
            margin-top: 13px;
            padding: 17px;
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 13px;
            background: rgba(255,255,255,.045);
        }

        .chart-heading {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            color: #e5eaf2;
            font-size: 11px;
            font-weight: 700;
        }

        .chart-heading span {
            color: #aab7ca;
            font-size: 9px;
            font-weight: 500;
        }

        .chart {
            display: block;
            width: 100%;
            height: auto;
            margin-top: 13px;
        }

        .machine-row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 9px;
            margin-top: 13px;
        }

        .machine-chip {
            padding: 12px 8px;
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 10px;
            background: rgba(255,255,255,.035);
            text-align: center;
        }

        .machine-symbol {
            color: #ff9a50;
            font-size: 19px;
        }

        .machine-name {
            margin-top: 7px;
            color: #dbe4f0;
            font-size: 9px;
            font-weight: 700;
        }

        .floating-tag {
            position: absolute;
            right: -17px;
            bottom: 45px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 16px;
            border: 1px solid #e9edf2;
            border-radius: 13px;
            background: white;
            box-shadow: 0 15px 35px rgba(16,27,50,.12);
        }

        .floating-icon {
            display: grid;
            place-items: center;
            width: 35px;
            height: 35px;
            border-radius: 10px;
            background: #fff0e4;
            color: #e9670c;
            font-size: 17px;
        }

        .floating-title {
            color: #172033;
            font-size: 11px;
            font-weight: 900;
        }

        .floating-subtitle {
            margin-top: 4px;
            color: #718096;
            font-size: 9px;
        }

        .features {
            padding: 42px 7% 58px;
            background: white;
        }

        .features-heading {
            margin-bottom: 26px;
            text-align: center;
        }

        .features-heading h2 {
            margin: 0;
            font-size: 25px;
            font-weight: 900;
        }

        .features-heading p {
            margin: 10px auto 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .feature-card {
            padding: 22px;
            border: 1px solid #edf0f4;
            border-radius: 15px;
            background: #fff;
            transition: .2s ease;
        }

        .feature-card:hover {
            border-color: #fed7aa;
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(16,27,50,.05);
        }

        .feature-icon {
            display: grid;
            place-items: center;
            width: 43px;
            height: 43px;
            border-radius: 12px;
            background: #fff0e4;
            color: #e9670c;
            font-size: 21px;
        }

        .feature-card h3 {
            margin: 17px 0 8px;
            font-size: 15px;
        }

        .feature-card p {
            margin: 0;
            color: #718096;
            font-size: 12px;
            line-height: 1.8;
        }

        .cta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 25px;
            margin: 35px 7% 50px;
            padding: 30px 34px;
            border-radius: 18px;
            background: var(--navy);
            color: white;
        }

        .cta h2 {
            margin: 0;
            font-size: 22px;
        }

        .cta p {
            margin: 9px 0 0;
            color: #bac5d5;
            font-size: 12px;
            line-height: 1.7;
        }

        .site-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            padding: 23px 7%;
            border-top: 1px solid #e7e4de;
            color: #7b8495;
            font-size: 11px;
        }

        .site-footer strong {
            color: var(--navy);
            letter-spacing: 1px;
        }

        @media (max-width: 950px) {
            .hero {
                grid-template-columns: 1fr;
                gap: 28px;
                padding-top: 45px;
            }

            .hero-copy {
                max-width: 700px;
            }

            .visual-area {
                width: 100%;
                max-width: 650px;
                margin: 0 auto;
            }

            .floating-tag {
                right: -5px;
            }
        }

        @media (max-width: 650px) {
            .site-header {
                padding: 15px 5%;
            }

            .header-label {
                display: none;
            }

            .brand-name {
                font-size: 16px;
            }

            .brand-caption {
                font-size: 8px;
                letter-spacing: 1px;
            }

            .brand-mark {
                width: 39px;
                height: 39px;
            }

            .header-right .button {
                padding: 11px 13px;
                font-size: 11px;
            }

            .hero {
                padding: 38px 5% 60px;
            }

            .hero h1 {
                font-size: 42px;
                letter-spacing: -1.6px;
            }

            .hero-description {
                font-size: 13px;
            }

            .visual-board {
                padding: 16px;
                border-radius: 18px;
            }

            .metric {
                padding: 12px;
            }

            .metric-value {
                font-size: 21px;
            }

            .floating-tag {
                right: 0;
                bottom: -20px;
                padding: 10px;
            }

            .features {
                padding: 40px 5%;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .cta {
                align-items: flex-start;
                flex-direction: column;
                margin: 25px 5% 35px;
                padding: 24px;
            }

            .site-footer {
                padding: 20px 5%;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {
                transition: none !important;
            }
        }
    </style>
</head>

<body>

<header class="site-header">
    <a href="{{ route('home') }}" class="brand">
        <div class="brand-mark">S</div>
        <div>
            <div class="brand-name">SMART BRAIL</div>
            <div class="brand-caption">SMART LABORATORY SYSTEM</div>
        </div>
    </a>

    <div class="header-right">
        <span class="header-label">Integrated Laboratory Monitoring</span>

        @auth
            <a class="button button-orange" href="{{ route('dashboard') }}">
                Dashboard <span aria-hidden="true">→</span>
            </a>
        @else
            <a class="button button-orange" href="{{ route('login') }}">
                Login Pengguna <span aria-hidden="true">→</span>
            </a>
        @endauth
    </div>
</header>

<main>
    <section class="hero">
        <div class="hero-copy">
            <div class="eyebrow">
                <span class="eyebrow-dot"></span>
                SMART LABORATORY TECHNOLOGY
            </div>

            <h1>
                Laboratorium Cerdas,
                <span>Terhubung.</span>
            </h1>

            <p class="hero-description">
                SMART BRAIL adalah konsep sistem monitoring laboratorium
                terintegrasi untuk membantu pengelolaan ruangan, pemantauan
                kondisi lingkungan, penggunaan energi, dan aktivitas peralatan
                dalam satu platform.
            </p>

            <div class="hero-actions">
                @auth
                    <a class="button button-orange" href="{{ route('dashboard') }}">
                        Buka Dashboard <span aria-hidden="true">→</span>
                    </a>
                @else
                    <a class="button button-orange" href="{{ route('login') }}">
                        Masuk ke Sistem <span aria-hidden="true">→</span>
                    </a>
                @endauth

                <a class="button"
                   href="#fitur"
                   style="border:1px solid #d9dee7;color:#344054;">
                    Jelajahi Fitur
                </a>
            </div>

            <div class="hero-footnote">
                <span class="footnote-icon">✓</span>
                <span>Dirancang untuk mendukung pemantauan dan pengelolaan laboratorium secara terpusat.</span>
            </div>
        </div>

        <div class="visual-area">
            <div class="visual-glow"></div>

            <div class="visual-board">
                <div class="board-top">
                    <div>
                        <div class="board-title">Laboratory Intelligence</div>
                        <div class="board-subtitle">SMART BRAIL · System Preview</div>
                    </div>

                    <div class="board-status">
                        <span></span>
                        UI PREVIEW
                    </div>
                </div>

                <div class="visual-metrics">
                    <div class="metric">
                        <div class="metric-label">
                            <span class="metric-icon">⌁</span>
                            Suhu Ruangan
                        </div>
                        <div class="metric-value">--.-°C</div>
                        <div class="metric-detail">Visualisasi sensor suhu</div>
                    </div>

                    <div class="metric">
                        <div class="metric-label">
                            <span class="metric-icon">◉</span>
                            Kelembapan
                        </div>
                        <div class="metric-value">--%</div>
                        <div class="metric-detail">Visualisasi sensor kelembapan</div>
                    </div>
                </div>

                <div class="chart-panel">
                    <div class="chart-heading">
                        <div>Energy Analytics</div>
                        <span>Ilustrasi grafik</span>
                    </div>

                    <svg class="chart"
                         viewBox="0 0 420 135"
                         role="img"
                         aria-label="Ilustrasi grafik pemantauan energi">
                        <defs>
                            <linearGradient id="chartFill" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#ff7a1a" stop-opacity=".35"/>
                                <stop offset="100%" stop-color="#ff7a1a" stop-opacity="0"/>
                            </linearGradient>
                        </defs>

                        <g stroke="#ffffff" stroke-opacity=".10" stroke-width="1">
                            <line x1="0" y1="20" x2="420" y2="20"/>
                            <line x1="0" y1="50" x2="420" y2="50"/>
                            <line x1="0" y1="80" x2="420" y2="80"/>
                            <line x1="0" y1="110" x2="420" y2="110"/>
                        </g>

                        <path d="M0 100 C25 95 35 65 65 78 S105 94 130 60 S170 75 200 53 S240 70 270 43 S315 66 345 30 S390 45 420 18 L420 135 L0 135 Z"
                              fill="url(#chartFill)"/>

                        <path d="M0 100 C25 95 35 65 65 78 S105 94 130 60 S170 75 200 53 S240 70 270 43 S315 66 345 30 S390 45 420 18"
                              fill="none"
                              stroke="#ff994d"
                              stroke-width="3"
                              stroke-linecap="round"/>

                        <circle cx="345" cy="30" r="5" fill="#ff994d" stroke="#fff" stroke-width="2"/>
                    </svg>
                </div>

                <div class="machine-row">
                    <div class="machine-chip">
                        <div class="machine-symbol">⚙</div>
                        <div class="machine-name">Lab Mekanik</div>
                    </div>

                    <div class="machine-chip">
                        <div class="machine-symbol">⌁</div>
                        <div class="machine-name">Lab Solder</div>
                    </div>

                    <div class="machine-chip">
                        <div class="machine-symbol">▦</div>
                        <div class="machine-name">3D Printing</div>
                    </div>
                </div>
            </div>

            <div class="floating-tag">
                <div class="floating-icon">⌘</div>
                <div>
                    <div class="floating-title">Centralized System</div>
                    <div class="floating-subtitle">Satu platform untuk laboratorium</div>
                </div>
            </div>
        </div>
    </section>

    <section class="features" id="fitur">
        <div class="features-heading">
            <h2>Satu Sistem, Berbagai Kemudahan</h2>
            <p>Dirancang untuk membantu pengelolaan laboratorium secara lebih terstruktur.</p>
        </div>

        <div class="feature-grid">
            <article class="feature-card">
                <div class="feature-icon">⌂</div>
                <h3>Room Monitoring</h3>
                <p>
                    Mendukung pemantauan informasi ruangan dan kondisi
                    lingkungan melalui satu antarmuka.
                </p>
            </article>

            <article class="feature-card">
                <div class="feature-icon">ϟ</div>
                <h3>Energy Monitoring</h3>
                <p>
                    Menyediakan tampilan analisis data penggunaan energi
                    dan riwayat pembacaan yang tersedia.
                </p>
            </article>

            <article class="feature-card">
                <div class="feature-icon">⚙</div>
                <h3>Equipment Management</h3>
                <p>
                    Mendukung pengelolaan peralatan laboratorium,
                    penggunaan, dan pengembangan kontrol perangkat.
                </p>
            </article>
        </div>
    </section>

    <section class="cta">
        <div>
            <h2>Selamat Datang di SMART BRAIL</h2>
            <p>
                Akses sistem sesuai peran akun Anda untuk melanjutkan
                aktivitas di dalam aplikasi.
            </p>
        </div>

        @auth
            <a class="button button-orange" href="{{ route('dashboard') }}">
                Buka Dashboard <span aria-hidden="true">→</span>
            </a>
        @else
            <a class="button button-orange" href="{{ route('login') }}">
                Login ke Sistem <span aria-hidden="true">→</span>
            </a>
        @endauth
    </section>
</main>

<footer class="site-footer">
    <div><strong>SMART BRAIL</strong> · Smart Laboratory Monitoring</div>
    <div>&copy; {{ date('Y') }} SMART BRAIL. All rights reserved.</div>
</footer>

</body>
</html>
