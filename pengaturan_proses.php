<?php
require_once 'config/koneksi.php';

if (isset($_POST['simpan_pengaturan'])) {
    $nama_aplikasi = $_POST['nama_aplikasi'];
    $warna_tema = $_POST['warna_tema'];
    $maintenance = isset($_POST['maintenance']) ? '1' : '0';

    $cek = mysqli_query($koneksi, "SELECT * FROM pengaturan LIMIT 1");

    if (mysqli_num_rows($cek) > 0) {
        $query = "UPDATE pengaturan SET 
                  nama_aplikasi='$nama_aplikasi', 
                  warna_tema='$warna_tema', 
                  maintenance='$maintenance'";
    } else {
        $query = "INSERT INTO pengaturan (nama_aplikasi, warna_tema, maintenance) 
                  VALUES ('$nama_aplikasi', '$warna_tema', '$maintenance')";
    }

    if (mysqli_query($koneksi, $query)) {
        header("Location: dashboard.php?status=pengaturan_berhasil");
        exit();
    }
}
header("Location: dashboard.php?status=pengaturan_gagal");
exit();
