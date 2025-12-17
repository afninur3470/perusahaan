<?php
session_start();
require_once 'config/koneksi.php';

// Pagination
$limit = 6; // Jumlah proyek per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query total portofolio
$queryTotal = "SELECT COUNT(*) as total FROM portofolio";
$resultTotal = mysqli_query($conn, $queryTotal);
$totalData = mysqli_fetch_assoc($resultTotal)['total'];
$totalPages = ceil($totalData / $limit);

// Query portofolio dengan pagination
$queryPortofolio = "SELECT * FROM portofolio LIMIT $limit OFFSET $offset";
$resultPortofolio = mysqli_query($conn, $queryPortofolio);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - GreenTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'partials/navbar.php'; ?>

    <!-- Portofolio Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Portofolio <span class="text-success">Kami</span></h2>
                <p class="lead">Proyek-proyek ramah lingkungan yang telah kami selesaikan</p>
            </div>
            
            <div class="row g-4">
                <?php if(mysqli_num_rows($resultPortofolio) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($resultPortofolio)): ?>
                    <div class="col-md-4">
                        <div class="portfolio-item">
                            <img src="images/portfolio/<?= $row['gambar'] ?>" class="card-img-top" alt="<?= $row['judul'] ?>">
                            <div class="portfolio-overlay">
                                <div class="portfolio-content">
                                    <h5><?= $row['judul'] ?></h5>
                                    <p><?= $row['deskripsi'] ?></p>
                                    <a href="detail_portofolio.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">Belum ada portofolio tersedia</h4>
                    </div>
                <?php endif; ?>
            </div>
            

            <!-- Pagination -->
            <?php if($totalPages > 1): ?>
            <nav class="mt-5">
                <ul class="pagination justify-content-center">
                    <?php if($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="portfolio.php?page=<?= $page-1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="portfolio.php?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="portfolio.php?page=<?= $page+1 ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <?php endif; ?>
        </div>
    </section>

    <!-- Font Awesome (CDN) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <!-- Footer -->
    <?php include 'partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>