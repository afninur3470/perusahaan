<?php
session_start();
require_once 'config/koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM layanan");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Layanan Kami - GreenTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<?php include 'partials/navbar.php'; ?>

<!-- Layanan Kami -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Layanan <span class="text-success">GreenTech</span></h2>
            <p class="lead">Kami hadir dengan berbagai layanan unggulan berbasis teknologi hijau</p>
        </div>

        <div class="row g-4">
            <?php if (mysqli_num_rows($query) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($query)): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title text-success"><?= $row['judul']; ?></h5>
                            <p class="card-text"><?= nl2br($row['deskripsi']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada layanan tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include 'partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
