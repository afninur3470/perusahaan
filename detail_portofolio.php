<?php
session_start();
require_once 'config/koneksi.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('❌ ID portofolio tidak ditemukan.'); window.location='portfolio.php';</script>";
    exit;
}

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM portofolio WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    echo "<script>alert('❌ Data portofolio tidak ditemukan.'); window.location='portfolio.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row['judul']; ?> - GreenTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navbar -->
<?php include 'partials/navbar.php'; ?>

<!-- Detail Portofolio -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold"><?= $row['judul']; ?></h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <img src="images/portfolio/<?= $row['gambar']; ?>" alt="<?= $row['judul']; ?>" class="img-fluid rounded mb-4 shadow">
                <p class="lead"><?= nl2br($row['deskripsi']); ?></p>

                <div class="mt-5 pt-4 border-top text-center">
                    <a href="portfolio.php" class="btn btn-success">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Portfolio
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include 'partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
