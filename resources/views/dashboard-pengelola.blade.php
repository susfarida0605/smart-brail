
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengelola - SMART BRAIL</title>
</head>
<body>
    <h1>Dashboard Pengelola SMART BRAIL</h1>

    <p>Selamat datang, {{ auth()->user()->name }}!</p>

    <p>Role akun: {{ auth()->user()->role }}</p>

    <p>Ini adalah halaman admin/laboran untuk monitoring dan pengelolaan booking.</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
