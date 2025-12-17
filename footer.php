<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h4 class="fw-bold mb-4"><span class="text-success">Green</span>Tech</h4>
                <p>Perusahaan teknologi informasi profesional yang berkomitmen pada solusi digital ramah lingkungan.</p>
                <div class="social-icons mt-4">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-linkedin-in fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="fw-bold mb-4">Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="index.php" class="text-white text-decoration-none">Beranda</a></li>
                    <li class="mb-2"><a href="index.php#tentang" class="text-white text-decoration-none">Tentang Kami</a></li>
                    <li class="mb-2"><a href="index.php#layanan" class="text-white text-decoration-none">Layanan</a></li>
                    <li class="mb-2"><a href="portfolio.php" class="text-white text-decoration-none">Portofolio</a></li>
                    <li class="mb-2"><a href="blog.php" class="text-white text-decoration-none">Blog</a></li>
                    <li class="mb-2"><a href="index.php#kontak" class="text-white text-decoration-none">Kontak</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-4">Layanan Kami</h5>
                <ul class="list-unstyled">
                    <?php
                    $queryLayanan = "SELECT * FROM layanan LIMIT 6";
                    $resultLayanan = mysqli_query($conn, $queryLayanan);
                    while($row = mysqli_fetch_assoc($resultLayanan)):
                    ?>
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none"><?= $row['judul'] ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <div class="col-lg-3">
                <h5 class="fw-bold mb-4">Newsletter</h5>
                <p>Berlangganan newsletter kami untuk mendapatkan informasi terbaru seputar teknologi hijau.</p>
                <form action="proses_newsletter.php" method="POST" class="mt-4">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email Anda" required>
                        <button class="btn btn-success" type="submit">Berlangganan</button>
                    </div>
                </form>
            </div>
        </div>
        <hr class="my-4 bg-secondary">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0">&copy; <?= date('Y') ?> GreenTech. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="mb-0">Designed with <i class="fas fa-leaf text-success"></i> by GreenTech Team</p>
            </div>
        </div>
    </div>
</footer>