<?php
// koneksi ke database
require_once 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $telepon  = mysqli_real_escape_string($conn, $_POST['telepon']);
    $subjek   = mysqli_real_escape_string($conn, $_POST['subjek']);
    $pesan    = mysqli_real_escape_string($conn, $_POST['pesan']);

    // Query insert ke tabel pesan
    $query = "INSERT INTO pesan (nama_lengkap, email, telepon, subjek, isi_pesan) 
              VALUES ('$nama', '$email', '$telepon', '$subjek', '$pesan')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('✅ Pesan Anda berhasil dikirim.');window.location.href='index.php#kontak';</script>";
    } else {
        echo "<script>alert('❌ Gagal mengirim pesan. Coba lagi nanti.');window.history.back();</script>";
    }
} else {
    // Jika bukan POST
    header("Location: index.php");
    exit();
}
