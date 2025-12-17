<?php
session_start();
require_once 'config/koneksi.php';

if(isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $subjek = mysqli_real_escape_string($conn, $_POST['subjek']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

    $query = "INSERT INTO pesan (nama, email, telepon, subjek, pesan) 
              VALUES ('$nama', '$email', '$telepon', '$subjek', '$pesan')";

    if(mysqli_query($conn, $query)) {
        $_SESSION['pesan'] = "Pesan Anda telah terkirim. Terima kasih!";
    } else {
        $_SESSION['error'] = "Gagal mengirim pesan: " . mysqli_error($conn);
    }
    
    header("Location: index.php#kontak");
    exit();
}
?>