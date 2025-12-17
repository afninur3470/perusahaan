<?php
session_start();
require_once 'config/koneksi.php';

// Pagination
$limit = 6; // Jumlah artikel per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query total artikel
$queryTotal = "SELECT COUNT(*) as total FROM artikel";
$resultTotal = mysqli_query($conn, $queryTotal);
$totalData = mysqli_fetch_assoc($resultTotal)['total'];
$totalPages = ceil($totalData / $limit);

// Query artikel dengan pagination
$queryArtikel = "SELECT * FROM artikel ORDER BY tanggal_publikasi DESC LIMIT $limit OFFSET $offset";
$resultArtikel = mysqli_query($conn, $queryArtikel);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - GreenTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar (sama seperti index.php) -->
    <?php include 'partials/navbar.php'; ?>

    <!-- Blog Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Blog <span class="text-success">GreenTech</span></h2>
                <p class="lead">Artikel terbaru seputar teknologi ramah lingkungan</p>
            </div>
            
            <div class="row g-4">
                <?php if(mysqli_num_rows($resultArtikel) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($resultArtikel)): ?>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="images/blog/<?= $row['gambar'] ?>" class="card-img-top" alt="<?= $row['judul'] ?>">
                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <small class="text-muted me-3">
                                        <i class="far fa-calendar-alt me-2"></i><?= date('d M Y', strtotime($row['tanggal_publikasi'])) ?>
                                    </small>
                                    <small class="text-muted">
                                        <i class="far fa-user me-2"></i><?= $row['penulis'] ?>
                                    </small>
                                </div>
                                <h5 class="card-title fw-bold"><?= $row['judul'] ?></h5>
                                <p class="card-text"><?= substr($row['isi'], 0, 150) ?>...</p>
                                <a href="artikel.php?id=<?= $row['id'] ?>" class="btn btn-link text-success text-decoration-none p-0">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">Belum ada artikel tersedia</h4>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if($totalPages > 1): ?>
            <nav class="mt-5">
                <ul class="pagination justify-content-center">
                    <?php if($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="blog.php?page=<?= $page-1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="blog.php?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="blog.php?page=<?= $page+1 ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>