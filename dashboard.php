<?php
session_start();
require_once '../config/koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}


$cards = [
    ['title' => 'Total Pengguna', 'icon' => 'fa-users', 'id' => 'total-pengguna', 'value' => mysqli_num_rows(mysqli_query($conn, "SELECT * FROM admin1")), 'growth' => 12],
    ['title' => 'Layanan Aktif', 'icon' => 'fa-laptop-code', 'id' => 'layanan-aktif', 'value' => mysqli_num_rows(mysqli_query($conn, "SELECT * FROM layanan")), 'growth' => 5],
    ['title' => 'Proyek Selesai', 'icon' => 'fa-project-diagram', 'id' => 'proyek-selesai', 'value' => mysqli_num_rows(mysqli_query($conn, "SELECT * FROM portofolio")), 'growth' => 8],
    ['title' => 'Artikel Blog', 'icon' => 'fa-newspaper', 'id' => 'artikel-blog', 'value' => mysqli_num_rows(mysqli_query($conn, "SELECT * FROM artikel")), 'growth' => 15],
];

// Ambil Aktivitas Terbaru (jika ada)
$resultAktivitas = mysqli_query($conn, "SELECT * FROM aktivitas ORDER BY id DESC LIMIT 5");
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - GreenTech</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/admin.css">
    <!-- Tambahkan CDN Chart.js di <head> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('statistikChart').getContext('2d');
    const statistikChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pengguna', 'Layanan', 'Proyek', 'Artikel'],
            datasets: [{
                label: 'Total',
                data: [1254, 28, 4, 4], // sesuaikan dengan PHP
                backgroundColor: ['#198754', '#20c997', '#0dcaf0', '#ffc107']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>

</head>

<?php if (isset($_GET['notifikasi']) && $_GET['notifikasi'] == 'berhasil'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✅ Aksi berhasil dilakukan!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<body>
    <!-- Sidebar -->
    <div class="d-flex" id="wrapper">
        <div class="bg-success text-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4">
                <h4><i class="fas fa-leaf me-2"></i> GreenTech</h4>
            </div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action bg-success text-white active">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
                <div class="container-fluid">
                    <button class="btn btn-success btn-sm" id="menu-toggle">
                     
                <div class="top-bar d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h2 class="h4" id="datetime"></h2>
                    <script>
                        function updateDateTime() {
                            const now = new Date();
                            document.getElementById('datetime').textContent = 
                            now.toLocaleString('id-ID', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        }     
                        updateDateTime();
                        setInterval(updateDateTime, 1000); // Update setiap 1 detik
                    </script>
                </div>
   
                    </button>
                    <div class="ms-auto d-flex align-items-center">
                        <span class="me-3">Admin</span>
                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                            <a href="profile.php" class="list-group-item list-group-item-action bg-success text-white">
                              <i class="fas fa-user-circle me-2"></i> Profil
                            </a>
                            <a class="dropdown-item text-danger" href="../index.php#blog" id="logoutBtn">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                          </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid px-4 py-4">
                <h2 class="mb-4"><i class="fas fa-tachometer-alt me-2 text-success"></i> Dashboard</h2>
                <div class="row g-4 mb-4">
                    <!-- Statistik Realtime Cards -->
                     <script>
  const stats = {
    pengguna: { total: <?= $cards[0]['value'] ?>, growth: <?= $cards[0]['growth'] ?> },
    layanan: { total: <?= $cards[1]['value'] ?>, growth: <?= $cards[1]['growth'] ?> },
    proyek: { total: <?= $cards[2]['value'] ?>, growth: <?= $cards[2]['growth'] ?> },
    artikel: { total: <?= $cards[3]['value'] ?>, growth: <?= $cards[3]['growth'] ?> }
  };

  function animateCounter(id, target, duration = 1500) {
    const el = document.getElementById(id);
    let start = 0;
    const increment = target / (duration / 30);
    const interval = setInterval(() => {
      start += increment;
      if (start >= target) {
        el.innerText = target.toLocaleString();
        clearInterval(interval);
      } else {
        el.innerText = Math.round(start).toLocaleString();
      }
    }, 30);
  }

  window.onload = () => {
    animateCounter('total-pengguna', stats.pengguna.total);
    animateCounter('layanan-aktif', stats.layanan.total);
    animateCounter('proyek-selesai', stats.proyek.total);
    animateCounter('artikel-blog', stats.artikel.total);
  };
</script>

                    <?php
                        $cards = [
                            ['title' => 'Total Pengguna', 'icon' => 'fa-users', 'id' => 'total-pengguna', 'value' => 1254, 'growth' => 12],
                            ['title' => 'Layanan Aktif', 'icon' => 'fa-laptop-code', 'id' => 'layanan-aktif', 'value' => 28, 'growth' => 5],
                            ['title' => 'Proyek Selesai', 'icon' => 'fa-project-diagram', 'id' => 'proyek-selesai', 'value' => 4, 'growth' => 8],
                            ['title' => 'Artikel Blog', 'icon' => 'fa-newspaper', 'id' => 'artikel-blog', 'value' => 4, 'growth' => 15],
                        ];
                        foreach ($cards as $card): ?>
                        <div class="col-md-3">
                            <div class="card border-success shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6><?= $card['title'] ?></h6>
                                        <i class="fa <?= $card['icon'] ?> fa-lg text-success"></i>
                                    </div>
                                    <h3 id="<?= $card['id'] ?>">0</h3>
                                    <span class="text-success"><i class="fa fa-arrow-up"></i> <?= $card['growth'] ?>% dari bulan lalu</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>


                <!-- Recent Activity & Quick Actions -->
                <div class="row gx-4 gy-4">
                    <div class="col-lg-8">
                        <div class="card shadow-sm border-success">
                            <div class="card-header bg-white border-success">
                                <h5 class="mb-0"><i class="fas fa-history me-2 text-success"></i> Aktivitas Terkini</h5>
                            </div>
                            <div class="card-body">
                            <div class="list-group list-group-flush">
                                <?php while ($aktivitas = mysqli_fetch_assoc($resultAktivitas)): ?>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-history text-success me-2"></i>
                                        <?= htmlspecialchars($aktivitas['aksi']) ?>
                                    </div>
                                    <small class="text-muted"><?= date('d M Y H:i', strtotime($aktivitas['waktu'])) ?></small>
                                </div>
                                <?php endwhile; ?>
                            </div>
                            <a href="log_aktivitas.php" class="btn btn-sm btn-outline-success mt-2">Lihat Semua Aktivitas</a>
                        </div>
                        </div>
                    </div>
                    

<!-- Di dalam <div id="page-content-wrapper"> -->
<div class="col-lg-4">
  <div class="card shadow-sm border-success">
    <div class="card-header bg-white border-success">
      <h5 class="mb-0"><i class="fas fa-bolt me-2 text-success"></i> Aksi Cepat</h5>
    </div>
    <div class="card-body">
      <!-- Tombol Aksi Cepat -->
      <button class="btn btn-success btn-sm w-100 mb-2 btn-aksi" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="fas fa-plus me-1"></i> Tambah Pengguna
      </button>
      
      <button class="btn btn-outline-success btn-sm w-100 mb-2 btn-aksi" data-bs-toggle="modal" data-bs-target="#uploadProjectModal">
        <i class="fas fa-upload me-1"></i> Upload Proyek Baru
      </button>
      
      <button class="btn btn-outline-success btn-sm w-100 mb-2 btn-aksi" data-bs-toggle="modal" data-bs-target="#addArticleModal">
        <i class="fas fa-pen me-1"></i> Tulis Artikel
      </button>
      
      <button class="btn btn-outline-success btn-sm w-100 btn-aksi" data-bs-toggle="modal" data-bs-target="#settingsModal">
        <i class="fas fa-cog me-1"></i> Pengaturan Sistem
      </button>
    </div>
  </div>
</div>

<!-- ==================== -->
<!-- MODAL-MODAL FORM -->
<!-- ==================== -->

<!-- Modal 1: Tambah Pengguna -->
<div class="modal fade" id="addUserModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i> Tambah Pengguna Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="userForm" action="tambah_pengguna_proses.php" method="POST">
          <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Role</label>
            <select class="form-select" name="role">
              <option value="Admin">Admin</option>
              <option value="Editor">Editor</option>
              <option value="Viewer">Viewer</option>
            </select>
          </div>
          <button type="submit" name="tambah_pengguna" class="btn btn-success w-100">
            <i class="fas fa-save me-1"></i> Simpan
          </button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal 2: Upload Proyek -->
<div class="modal fade" id="uploadProjectModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title"><i class="fas fa-upload me-2"></i> Upload Proyek Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="projectForm" action="proyek_proses.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Nama Proyek</label>
            <input type="text" name="judul" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Upload File</label>
            <input type="file" name="gambar" class="form-control" required>
          </div>
          <button type="submit" name="upload_proyek" class="btn btn-success w-100">
            <i class="fas fa-cloud-upload-alt me-1"></i> Upload
          </button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal 3: Tulis Artikel -->
<div class="modal fade" id="addArticleModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title"><i class="fas fa-edit me-2"></i> Artikel Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="articleForm" action="artikel_proses.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Judul Artikel</label>
            <input type="text" name="judul" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Konten</label>
            <textarea name="isi" class="form-control" rows="10" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Thumbnail</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" required>
          </div>
          <button type="submit" name="tulis_artikel" class="btn btn-success w-100">
            <i class="fas fa-paper-plane me-1"></i> Publikasikan
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal 4: Pengaturan Sistem -->
<div class="modal fade" id="settingsModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title"><i class="fas fa-cogs me-2"></i> Pengaturan Sistem</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="settingsForm">
          <div class="mb-3">
            <label class="form-label">Nama Aplikasi</label>
            <input type="text" class="form-control" value="GreenTech">
          </div>
          <div class="mb-3">
            <label class="form-label">Warna Tema</label>
            <input type="color" class="form-control form-control-color" value="#28a745">
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="maintenanceMode">
            <label class="form-check-label" for="maintenanceMode">Mode Maintenance</label>
          </div>
          <button type="submit" class="btn btn-success w-100">
            <i class="fas fa-save me-1"></i> Simpan Pengaturan
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="profileModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fas fa-user me-2"></i> Profil Pengguna</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="profileForm">
                    <div class="mb-3 text-center">
                        <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="Profil Picture">
                        <input type="file" class="form-control" id="profilePicture" accept="image/*">
                        <label for="profilePicture" class="form-label mt-2">Ubah Foto Profil</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control" value="Admin" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="admin@greentech.com" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" value="Admin GreenTech" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" value="Administrator" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kata Sandi Baru (Opsional)</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- Bootstrap & Custom JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/admin.js"></script>
</script>
</body>
</html>