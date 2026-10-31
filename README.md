# SmartBrail - Sistem Monitoring & Booking Laboratorium

Aplikasi web berbasis Laravel untuk monitoring kondisi ruangan laboratorium secara real-time dan pengelolaan peminjaman ruangan/mesin oleh mahasiswa.

---

## Fitur Utama

- Monitoring suhu, kelembaban, dan konsumsi daya ruangan secara real-time
- Monitoring energi dengan grafik historis (24 jam, 7 hari, 30 hari)
- Kontrol lampu ruangan (toggle on/off)
- Sistem booking ruangan dan mesin untuk mahasiswa
- Manajemen booking oleh admin/laboran
- Role-based access control (admin, laboran, mahasiswa, dosen)
- Data sensor tersimpan untuk analisis historis

---

## Tech Stack

- PHP 8.2+
- Laravel 12
- Laravel Breeze (autentikasi)
- SQLite (database default)
- Tailwind CSS
- Vite
- Pest (testing)

---

## Struktur Role Pengguna

| Role      | Akses                                                 |
|-----------|-------------------------------------------------------|
| admin     | Dashboard pengelola, semua fitur monitoring & booking |
| laboran   | Sama dengan admin                                     |
| mahasiswa | Form booking, daftar booking milik sendiri            |
| dosen     | Halaman utama (welcome)                               |

---

## Instalasi

1. Clone repository dan masuk ke direktori project:

        git clone <repo-url>
        cd smart

2. Install dependensi PHP:

        composer install

3. Install dependensi Node:

        npm install

4. Salin file environment dan generate app key:

        cp .env.example .env
        php artisan key:generate

5. Jalankan migrasi dan seeder:

        php artisan migrate
        php artisan db:seed --class=RoomSeeder
        php artisan db:seed --class=MachineSeeder

6. Build aset frontend:

        npm run build

7. Jalankan server development (semua service sekaligus):

        composer run dev

   Perintah di atas menjalankan Laravel server, queue worker, log watcher (Pail), dan Vite secara bersamaan.

---

## Database

Project menggunakan SQLite secara default. File database ada di `database/database.sqlite`.

Untuk beralih ke MySQL, ubah bagian berikut di `.env`:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database
    DB_USERNAME=root
    DB_PASSWORD=

---

## Struktur Database

### Tabel `rooms`

Menyimpan data ruangan laboratorium.

| Kolom       | Tipe            | Keterangan                        |
|-------------|-----------------|-----------------------------------|
| id          | bigint (PK)     | Primary key                       |
| slug        | string (unique) | Identifier unik ruangan           |
| name        | string          | Nama ruangan                      |
| temperature | decimal(5,2)    | Suhu ruangan (Celsius)            |
| humidity    | decimal(5,2)    | Kelembaban ruangan (%)            |
| power       | decimal(8,2)    | Konsumsi daya (kW)                |
| people      | unsigned int    | Jumlah orang di ruangan           |
| status      | string          | Status ruangan (Aktif/Peringatan) |
| light_on    | boolean         | Status lampu (on/off)             |

Ruangan yang di-seed secara default:

- `meeting` - Room Meeting
- `mechanical` - Room Mechanical
- `solder` - Room Solder
- `3d` - Room 3D Printer

### Tabel `machines`

Menyimpan data mesin yang ada di laboratorium.

| Kolom             | Tipe             | Keterangan                           |
|-------------------|------------------|--------------------------------------|
| id                | bigint (PK)      | Primary key                          |
| slug              | string (unique)  | Identifier unik mesin                |
| name              | string           | Nama mesin                           |
| room_slug         | string           | Slug ruangan tempat mesin berada     |
| power             | decimal(8,2)     | Konsumsi daya mesin (kW)             |
| status            | string           | Status penggunaan (available/in_use) |
| current_user_name | string (null)    | Nama pengguna saat ini               |
| current_user_nim  | string (null)    | NIM pengguna saat ini                |
| started_at        | timestamp (null) | Waktu mulai pemakaian                |
| ends_at           | timestamp (null) | Waktu selesai pemakaian              |
| booking_id        | bigint (null)    | Foreign key ke tabel bookings        |

Mesin yang di-seed secara default:

- `mesin-bor` - Mesin Bor (mechanical)
- `laser-cutting` - Laser Cutting (mechanical)
- `mesin-bubut` - Mesin Bubut (mechanical)
- `gerinda` - Gerinda (mechanical)
- `area-solder` - Area Solder (solder)
- `printer-3d` - 3D Printer (3d)

### Tabel `bookings`

Menyimpan data peminjaman ruangan dan mesin.

| Kolom        | Tipe             | Keterangan                          |
|--------------|------------------|-------------------------------------|
| id           | bigint (PK)      | Primary key                         |
| user_id      | bigint (null)    | Foreign key ke tabel users          |
| user_name    | string           | Nama peminjam                       |
| nim          | string           | NIM mahasiswa                       |
| room         | string           | Slug ruangan yang dipinjam          |
| machine      | string (null)    | Slug mesin yang dipinjam (opsional) |
| cluster      | tinyint unsigned | Nomor cluster                       |
| group_name   | string           | Nama kelompok                       |
| booking_date | date             | Tanggal peminjaman                  |
| start_time   | time             | Jam mulai                           |
| end_time     | time             | Jam selesai                         |
| status       | string           | Status booking (booked/cancelled)   |

### Tabel `sensor_readings`

Menyimpan histori pembacaan sensor per ruangan.

| Kolom       | Tipe         | Keterangan                   |
|-------------|--------------|------------------------------|
| id          | bigint (PK)  | Primary key                  |
| room_id     | bigint (FK)  | Foreign key ke tabel rooms   |
| temperature | decimal(5,2) | Suhu yang tercatat (Celsius) |
| humidity    | decimal(5,2) | Kelembaban yang tercatat (%) |
| power       | decimal(8,2) | Daya yang tercatat (kW)      |
| recorded_at | timestamp    | Waktu pembacaan sensor       |

---

## Route / Endpoint

### Publik (tanpa login)

| Method | URL | Keterangan                            |
|--------|-----|---------------------------------------|
| GET    | /   | Halaman utama, overview semua ruangan |

### Autentikasi (Laravel Breeze)

Login, register, forgot password, dan verifikasi email tersedia via `routes/auth.php`.

### Setelah Login (semua role)

| Method | URL        | Keterangan                        |
|--------|------------|-----------------------------------|
| GET    | /dashboard | Redirect otomatis sesuai role     |
| GET    | /profile   | Edit profil pengguna              |
| PATCH  | /profile   | Update profil pengguna            |
| DELETE | /profile   | Hapus akun pengguna               |

### Admin & Laboran

| Method | URL                        | Keterangan                                      |
|--------|----------------------------|-------------------------------------------------|
| GET    | /smartbrail                | Dashboard utama pengelola                       |
| GET    | /room-monitoring/{room?}   | Monitoring kondisi ruangan                      |
| GET    | /sensor-data               | Data pembacaan sensor                           |
| GET    | /energy-monitoring         | Grafik monitoring energi (filter period & room) |
| GET    | /room-control/{room?}      | Halaman kontrol ruangan                         |
| POST   | /room-control/{room}/lamp  | Toggle lampu ruangan                            |
| GET    | /booking-list              | Daftar seluruh booking                          |
| POST   | /booking-list/{id}/cancel  | Batalkan booking (oleh pengelola)               |
| GET    | /room-users                | Daftar pengguna ruangan aktif                   |

### Mahasiswa

| Method | URL                       | Keterangan                     |
|--------|---------------------------|--------------------------------|
| GET    | /booking                  | Form pemesanan ruangan         |
| POST   | /booking                  | Simpan pemesanan baru          |
| GET    | /booking-saya             | Daftar booking milik mahasiswa |
| POST   | /booking-saya/{id}/cancel | Batalkan booking sendiri       |

---

## Model

### Room

File: `app/Models/Room.php`

Merepresentasikan ruangan laboratorium. Menyimpan data kondisi real-time (suhu, kelembaban, daya, jumlah orang) yang diperbarui dari sensor.

Fillable: `slug`, `name`, `temperature`, `humidity`, `power`, `people`, `status`, `light_on`

### Machine

File: `app/Models/Machine.php`

Merepresentasikan mesin yang ada di dalam ruangan. Mencatat siapa yang sedang menggunakan mesin dan kapan.

Fillable: `slug`, `name`, `room_slug`, `power`, `status`, `current_user_name`, `current_user_nim`, `started_at`, `ends_at`, `booking_id`

### SensorReading

File: `app/Models/SensorReading.php`

Menyimpan histori pembacaan sensor per ruangan untuk keperluan analisis dan grafik energi.

Fillable: `room_id`, `temperature`, `humidity`, `power`, `recorded_at`

Relasi: `room()` -> BelongsTo Room

### User

File: `app/Models/User.php`

Model autentikasi standar Laravel Breeze dengan tambahan field `role` untuk kontrol akses berbasis peran.

---

## Testing

Jalankan test suite dengan Pest:

    php artisan test

atau:

    ./vendor/bin/pest

---

## File Tambahan

- `koneksi.php` - Skrip koneksi MySQL legacy (sisa fase prototipe awal, bukan bagian aplikasi Laravel)
- `simpan.php` - Form HTML legacy (sisa fase prototipe awal, bukan bagian aplikasi Laravel)
- `tes_koneksi.php` - Skrip uji koneksi legacy

File-file di atas tidak digunakan oleh aplikasi Laravel dan dapat dihapus jika tidak diperlukan.

---

## Lisensi

MIT
