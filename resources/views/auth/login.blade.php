
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SMART BRAIL</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f3ee;
            color: #17243a;
            font-family: Arial, Helvetica, sans-serif;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1050px;
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            background: #fff;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(23,36,58,.12);
        }

        .brand-panel {
            background: #17243a;
            color: white;
            padding: 48px 38px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand-logo {
            width: 62px;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            background: #f28c28;
            font-size: 25px;
            font-weight: 800;
            margin-bottom: 25px;
        }

        .brand-panel h1 {
            margin: 0 0 14px;
            font-size: 30px;
            letter-spacing: 1px;
        }

        .brand-panel p {
            color: #d1d9e5;
            font-size: 14px;
            line-height: 1.8;
        }

        .brand-footer {
            margin-top: 35px;
            color: #aeb9ca;
            font-size: 12px;
            line-height: 1.8;
        }

        .form-panel { padding: 42px; }

        .form-panel h2 {
            margin: 0 0 8px;
            font-size: 27px;
        }

        .subtitle {
            margin: 0 0 24px;
            color: #748094;
            font-size: 14px;
            line-height: 1.6;
        }

        .role-label {
            margin-bottom: 10px;
            font-size: 13px;
            font-weight: bold;
        }

        .role-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
            margin-bottom: 24px;
        }

        .role-card {
            position: relative;
            display: flex;
            align-items: center;
            gap: 11px;
            min-height: 76px;
            padding: 13px;
            border: 1px solid #d9dee7;
            border-radius: 12px;
            background: white;
            cursor: pointer;
            transition: .15s ease;
        }

        .role-card:hover {
            border-color: #f28c28;
            background: #fffaf5;
        }

        .role-card.selected {
            border: 2px solid #f28c28;
            background: #fff5e9;
            padding: 12px;
        }

        .role-card input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .role-icon {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #f2f4f7;
            font-size: 20px;
        }

        .role-card.selected .role-icon {
            background: #ffe4c7;
        }

        .role-name {
            font-size: 13px;
            font-weight: bold;
        }

        .role-desc {
            margin-top: 4px;
            color: #748094;
            font-size: 11px;
            line-height: 1.4;
        }

        .field { margin-bottom: 18px; }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: bold;
        }

        .field input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d9dee7;
            border-radius: 9px;
            font-size: 14px;
            outline: none;
        }

        .field input:focus {
            border-color: #f28c28;
            box-shadow: 0 0 0 3px rgba(242,140,40,.13);
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 22px;
            color: #596579;
            font-size: 13px;
        }

        .remember input { accent-color: #f28c28; }

        .login-button {
            width: 100%;
            padding: 14px;
            border: 0;
            border-radius: 9px;
            background: #f28c28;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .login-button:hover { background: #df7615; }

        .error-box {
            margin-bottom: 18px;
            padding: 12px;
            border-radius: 8px;
            background: #fef3f2;
            color: #b42318;
            font-size: 13px;
            line-height: 1.6;
        }

        .status-message {
            margin-bottom: 18px;
            padding: 12px;
            border-radius: 8px;
            background: #ecfdf3;
            color: #067647;
            font-size: 13px;
        }

        .student-note {
            margin-top: 22px;
            padding: 14px;
            border: 1px solid #f8dfc2;
            border-radius: 10px;
            background: #fff6eb;
            color: #76512d;
            font-size: 12px;
            line-height: 1.7;
        }

        .forgot-link {
            display: block;
            margin-top: 18px;
            text-align: center;
            color: #52647d;
            font-size: 13px;
            text-decoration: none;
        }

        .forgot-link:hover { color: #df7615; }

        @media (max-width: 760px) {
            body { padding: 12px; }
            .login-wrapper { grid-template-columns: 1fr; }
            .brand-panel { padding: 28px; }
            .brand-panel h1 { font-size: 26px; }
            .brand-footer { margin-top: 20px; }
            .form-panel { padding: 28px 22px; }
        }

        @media (max-width: 360px) {
            .role-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">

        <section class="brand-panel">
            <div>
                <div class="brand-logo">SB</div>
                <h1>SMART BRAIL</h1>
                <p>
                    Smart Building &amp; Laboratory Access.
                    Sistem informasi untuk pemantauan ruangan
                    dan pengelolaan peminjaman laboratorium.
                </p>
            </div>

            <div class="brand-footer">
                SMART BRAIL &copy; {{ date('Y') }}<br>
                Sistem Informasi Laboratorium
            </div>
        </section>

        <section class="form-panel">
            <h2>Selamat Datang</h2>
            <p class="subtitle">
                Pilih jenis akun, lalu masuk menggunakan akun terdaftar.
            </p>

            @if (session('status'))
                <div class="status-message">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error-box">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="role-label">Masuk sebagai</div>

                <div class="role-grid">
                    <label class="role-card" data-role="admin">
                        <input type="radio" name="role" value="admin"
                            {{ old('role', 'mahasiswa') === 'admin' ? 'checked' : '' }}>
                        <span class="role-icon">🛡️</span>
                        <span>
                            <span class="role-name">Admin</span>
                            <span class="role-desc" style="display:block">Pengelolaan sistem</span>
                        </span>
                    </label>

                    <label class="role-card" data-role="dosen">
                        <input type="radio" name="role" value="dosen"
                            {{ old('role') === 'dosen' ? 'checked' : '' }}>
                        <span class="role-icon">🎓</span>
                        <span>
                            <span class="role-name">Dosen</span>
                            <span class="role-desc" style="display:block">Monitoring &amp; booking</span>
                        </span>
                    </label>

                    <label class="role-card" data-role="laboran">
                        <input type="radio" name="role" value="laboran"
                            {{ old('role') === 'laboran' ? 'checked' : '' }}>
                        <span class="role-icon">⚙️</span>
                        <span>
                            <span class="role-name">Laboran</span>
                            <span class="role-desc" style="display:block">Operasional laboratorium</span>
                        </span>
                    </label>

                    <label class="role-card" data-role="mahasiswa">
                        <input type="radio" name="role" value="mahasiswa"
                            {{ old('role', 'mahasiswa') === 'mahasiswa' ? 'checked' : '' }}>
                        <span class="role-icon">📚</span>
                        <span>
                            <span class="role-name">Mahasiswa</span>
                            <span class="role-desc" style="display:block">Booking ruangan</span>
                        </span>
                    </label>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email terdaftar"
                        required
                        autofocus
                        autocomplete="username"
                    >
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                        autocomplete="current-password"
                    >
                </div>

                <label class="remember">
                    <input type="checkbox" name="remember" value="1">
                    Ingat saya
                </label>

                <button type="submit" class="login-button">
                    Masuk ke SMART BRAIL
                </button>
            </form>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">
                    Lupa password?
                </a>
            @endif

            <div class="student-note">
                <strong>Khusus mahasiswa</strong><br>
                Pilih kartu Mahasiswa untuk masuk ke layanan booking.
                Mahasiswa tidak diberikan akses ke dashboard pengelola.
            </div>
        </section>
    </div>

    <script>
        document.querySelectorAll('.role-card input').forEach(function (input) {
            input.addEventListener('change', function () {
                document.querySelectorAll('.role-card').forEach(function (card) {
                    card.classList.remove('selected');
                });

                const selectedCard = input.closest('.role-card');
                if (selectedCard) {
                    selectedCard.classList.add('selected');
                }
            });
        });

        document.querySelectorAll('.role-card input:checked').forEach(function (input) {
            input.closest('.role-card').classList.add('selected');
        });
    </script>
</body>
</html>
