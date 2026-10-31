<form action="simpan.php" method="POST">

    <input
        type="text"
        name="nama_peminjam"
        placeholder="Nama peminjam"
        required
    >

    <input
        type="text"
        name="nama_ruangan"
        placeholder="Nama ruangan"
        required
    >

    <input type="date" name="tanggal" required>

    <input type="time" name="jam_mulai" required>

    <input type="time" name="jam_selesai" required>

    <button type="submit">
        Simpan Jadwal
    </button>

</form>