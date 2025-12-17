<?php 
// Mulai session
session_start();
require_once 'config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tentang Kami - GreenTech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS & Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php"><span class="text-success">Green</span>Tech</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link active" href="about.php">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="layanan.php">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="portfolio.php">Portofolio</a></li>
                <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="admin/login.php"><i class="fas fa-user-shield"></i> Admin</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="py-5 bg-success text-white text-center mt-5">
    <div class="container">
        <h1 class="display-4 fw-bold">Tentang GreenTech</h1>
        <p class="lead">Solusi Teknologi Ramah Lingkungan</p>
    </div>
</section>

<!-- Konten Tentang Kami -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="images/ambis.jpg" alt="Tentang Kami" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-4">Misi <span class="text-success">GreenTech</span></h2>
                <p>Kami adalah perusahaan teknologi informasi yang berdedikasi menyediakan solusi digital berkelanjutan dan ramah lingkungan.</p>
                <p>GreenTech berdiri sejak 2017 dan telah mengembangkan ratusan aplikasi dengan jejak karbon rendah untuk klien nasional maupun internasional.</p>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check text-success me-2"></i> Tim profesional dengan sertifikasi Green IT</li>
                    <li><i class="fas fa-check text-success me-2"></i> Fokus pada efisiensi energi dan keberlanjutan</li>
                    <li><i class="fas fa-check text-success me-2"></i> Pendekatan teknologi hijau dan cloud computing</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Visi dan Nilai -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Visi & <span class="text-success">Nilai Kami</span></h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold text-success"><i class="fas fa-eye me-2"></i>Visi</h5>
                        <p>Menjadi pelopor transformasi digital hijau di Asia Tenggara dengan teknologi berkelanjutan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold text-success"><i class="fas fa-leaf me-2"></i>Inovatif</h5>
                        <p>Menghadirkan inovasi yang tidak hanya fungsional tetapi juga berdampak positif terhadap lingkungan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold text-success"><i class="fas fa-users me-2"></i>Kolaboratif</h5>
                        <p>Membangun sinergi dengan klien dan komunitas untuk menciptakan solusi bersama.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <p>&copy; <?= date('Y'); ?> GreenTech. All rights reserved.</p>
    </div>
</footer>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
