<?php
session_start();
require_once '../config/koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM aktivitas ORDER BY waktu DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas - GreenTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <h3 class="mb-4">
        <i class="fas fa-clipboard-list text-success"></i> Log Aktivitas
    </h3>
    <a href="dashboard.php" class="btn btn-success btn-sm mb-3">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
    </a>
    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Aksi</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['aksi']) ?></td>
                    <td><?= date('d M Y H:i', strtotime($row['waktu'])) ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
