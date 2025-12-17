<?php
session_start();
require_once '../config/koneksi.php';

if (isset($_POST['tulis_artikel'])) {
    $judul   = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi     = mysqli_real_escape_string($conn, $_POST['isi']);

    $gambar  = $_FILES['gambar']['name'];
    $tmp     = $_FILES['gambar']['tmp_name'];
    $path    = "../images/blog/" . $gambar;

    if (move_uploaded_file($tmp, $path)) {
        $query = "INSERT INTO artikel (judul, isi, gambar) VALUES ('$judul', '$isi', '$gambar')";
        if (mysqli_query($conn, $query)) {
            // ✅ Simpan aktivitas
            $aksi = "Admin menulis artikel \"$judul\"";
            mysqli_query($conn, "INSERT INTO aktivitas (aksi) VALUES ('$aksi')");

            header("Location: dashboard.php?status=artikel_berhasil");
            exit();
        } else {
            echo "Gagal menyimpan artikel.";
        }
    } else {
        echo "Gagal upload gambar.";
    }
}
?>
