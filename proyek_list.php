<?php
session_start();
require_once '../config/koneksi.php';

if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($koneksi, "SELECT * FROM portofolio ORDER BY dibuat_pada DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Proyek - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h2 class="mb-4">📁 Daftar Proyek</h2>
    <a href="dashboard.php" class="btn btn-success btn-sm mb-3">← Kembali ke Dashboard</a>
    <table class="table table-bordered table-striped">
        <thead class="table-success">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['judul']); ?></td>
                <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                <td><img src="uploads/portofolio/<?= $row['gambar']; ?>" width="100"></td>
                <td><?= $row['dibuat_pada']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
