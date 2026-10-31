<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "jadwal ruangan";

$conn = new mysqli(
    $host,
    $user,
    $password,
    $database
);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Gunakan karakter UTF-8
$conn->set_charset("utf8mb4");

?>