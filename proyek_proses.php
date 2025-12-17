<?php
session_start();
require_once '../config/koneksi.php';

if (isset($_POST['upload_proyek'])) {
    $judul     = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    $gambar    = $_FILES['gambar']['name'];
    $tmp       = $_FILES['gambar']['tmp_name'];
    $path      = "../images/portfolio/" . $gambar;

    if (move_uploaded_file($tmp, $path)) {
        $query = "INSERT INTO portofolio (judul, deskripsi, gambar) VALUES ('$judul', '$deskripsi', '$gambar')";
        if (mysqli_query($conn, $query)) {
            // ✅ Simpan aktivitas
            $aksi = "Admin mengupload proyek \"$judul\"";
            mysqli_query($conn, "INSERT INTO aktivitas (aksi) VALUES ('$aksi')");

            header("Location: dashboard.php?status=proyek_berhasil");
            exit();
        } else {
            echo "Gagal menyimpan proyek.";
        }
    } else {
        echo "Gagal upload file.";
    }
}
?>
