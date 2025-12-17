<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "perusahaan_it";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Set charset untuk menghindari masalah karakter
mysqli_set_charset($conn, "utf8mb4");
?>