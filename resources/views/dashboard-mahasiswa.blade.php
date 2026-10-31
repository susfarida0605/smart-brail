
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - SMART BRAIL</title>
</head>
<body>
    <h1>Dashboard Mahasiswa SMART BRAIL</h1>

    <p>Selamat datang, {{ auth()->user()->name }}!</p>

    <p>Ini adalah halaman mahasiswa untuk peminjaman ruangan.</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
