<?php
require_once '../config/koneksi.php';

if (isset($_POST['tambah_pengguna'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email        = $_POST['email'];
    $username     = $_POST['username'];
    $password     = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO login (username, password, nama_lengkap, email)
              VALUES ('$username', '$password', '$nama_lengkap', '$email')";

    if (mysqli_query($conn, $query)) {
        header("Location: dashboard.php?status=tambah_pengguna_berhasil");
        exit();
    } else {
        header("Location: dashboard.php?status=tambah_pengguna_gagal");
        exit();
    }
}
?>
