<?php
session_start();
require_once 'config/koneksi.php';

if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: blog.php");
    exit();
}

$id = (int)$_GET['id'];
$query = "SELECT * FROM artikel WHERE id = $id";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0) {
    header("Location: blog.php");
    exit();
}

$artikel = mysqli_fetch_assoc($result);

// Artikel terkait
$queryTerkait = "SELECT * FROM artikel WHERE id != $id ORDER BY tanggal_publikasi DESC LIMIT 3";
$resultTerkait = mysqli_query($conn, $queryTerkait);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $artikel['judul'] ?> - GreenTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'partials/navbar.php'; ?>

    <!-- Artikel Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <article>
                        <header class="mb-4">
                            <h1 class="fw-bold mb-3"><?= $artikel['judul'] ?></h1>
                            <div class="d-flex text-muted mb-3">
                                <div class="me-4">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    <?= date('d M Y', strtotime($artikel['tanggal_publikasi'])) ?>
                                </div>
                                <div>
                                    <i class="far fa-user me-2"></i>
                                    <?= $artikel['penulis'] ?>
                                </div>
                            </div>
                            <img src="images/blog/<?= $artikel['gambar'] ?>" class="img-fluid rounded mb-4" alt="<?= $artikel['judul'] ?>">
                        </header>
                        
                        <div class="artikel-content">
                            <?= nl2br($artikel['isi']) ?>
                        </div>
                    </article>

                    <div class="mt-5 pt-4 border-top">
                        <a href="blog.php" class="btn btn-outline-success">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Blog
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel Terkait -->
    <?php if(mysqli_num_rows($resultTerkait) > 0): ?>
    <section class="py-5 bg-light">
        <div class="container">
            <h4 class="fw-bold mb-4">Artikel Terkait</h4>
            <div class="row g-4">
                <?php while($row = mysqli_fetch_assoc($resultTerkait)): ?>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="images/blog/<?= $row['gambar'] ?>" class="card-img-top" alt="<?= $row['judul'] ?>">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?= $row['judul'] ?></h5>
                            <p class="card-text"><?= substr($row['isi'], 0, 100) ?>...</p>
                            <a href="artikel.php?id=<?= $row['id'] ?>" class="btn btn-link text-success text-decoration-none p-0">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Footer -->
    <?php include 'partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>