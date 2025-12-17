<?php
session_start();
require_once __DIR__.'/../config/koneksi.php';

if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['tambah_pengguna'])) {
    // Aktifkan error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $nama = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek apakah username atau email sudah ada
    $check = $conn->prepare("SELECT * FROM pengguna WHERE username = ? OR email = ?");
    $check->bind_param("ss", $username, $email);
    $check->execute();
    $result = $check->get_result();
    
    if($result->num_rows > 0) {
        header("Location: dashboard.php?status=username_email_ada");
        exit();
    }
    
    // Insert data pengguna baru
    $stmt = $conn->prepare("INSERT INTO pengguna (nama_lengkap, email, role, username, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $email, $role, $username, $password);
    
    if($stmt->execute()) {
        header("Location: dashboard.php?status=tambah_pengguna_berhasil");
    } else {
        header("Location: dashboard.php?status=tambah_pengguna_gagal");
    }

    $aksi = "Admin menambahkan pengguna baru \"$nama\"";
    mysqli_query($conn, "INSERT INTO aktivitas (aksi) VALUES ('$aksi')");
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: dashboard.php");
    exit();
}
?>