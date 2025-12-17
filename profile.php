<?php
session_start();
require_once '../config/koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$admin_id = $_SESSION['admin']['id'];

// Ambil data admin dari database
$query = mysqli_query($conn, "SELECT * FROM admin1 WHERE id = '$admin_id'");
$data = mysqli_fetch_assoc($query);

// Update Profil
if (isset($_POST['simpan_profil'])) {
    $nama_depan = mysqli_real_escape_string($conn, $_POST['nama_depan']);
    $nama_belakang = mysqli_real_escape_string($conn, $_POST['nama_belakang']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    mysqli_query($conn, "UPDATE admin1 SET nama_depan='$nama_depan', nama_belakang='$nama_belakang', email='$email' WHERE id='$admin_id'");
    $_SESSION['admin']['nama_depan'] = $nama_depan;
    header("Location: profile.php?status=profil_updated");
    exit();
}

// Ganti Password
if (isset($_POST['update_password'])) {
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    if (password_verify($password_lama, $data['password'])) {
        if ($password_baru === $konfirmasi_password) {
            $hash_baru = password_hash($password_baru, PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE admin1 SET password='$hash_baru' WHERE id='$admin_id'");
            header("Location: profile.php?status=password_updated");
            exit();
        } else {
            $error = "Konfirmasi password tidak cocok!";
        }
    } else {
        $error = "Password lama salah!";
    }
}


// Upload Foto
if (isset($_POST['upload_foto']) && isset($_FILES['foto'])) {
    $foto = $_FILES['foto'];
    $namaFile = basename($foto['name']);
    $targetDir = "../images/uploads/";
    $targetFile = $targetDir . $namaFile;

    if (move_uploaded_file($foto['tmp_name'], $targetFile)) {
        mysqli_query($conn, "UPDATE admin1 SET foto_profil='$namaFile' WHERE id='$admin_id'");
        header("Location: profile.php?status=foto_updated");
        exit();
    } else {
        $error = "Upload foto gagal!";
    }
}

// Reset Password Manual (admin123)
if (isset($_POST['reset_password_admin'])) {
    $default_pass = password_hash('admin123', PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE admin1 SET password='$default_pass' WHERE id='$admin_id'");
    header("Location: profile.php?status=reset_success");
    exit();
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Admin - GreenTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profil-box { max-width: 900px; margin: auto; }
        .foto-preview { width: 100px; height: 100px; object-fit: cover; border-radius: 50%; }
    </style>
</head>
<body class="bg-light">

<div class="container profil-box py-5">

    <!-- Tombol kembali ke dashboard -->
    <a href="dashboard.php" class="btn btn-outline-success mb-3">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
    </a>

    <h3 class="mb-4"><i class="fa fa-user-circle"></i> Profil Admin</h3>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'profil_updated'): ?>
            <div class="alert alert-success">Perubahan berhasil disimpan!</div>
        <?php elseif ($_GET['status'] == 'password_updated'): ?>
            <div class="alert alert-success">Password berhasil diperbarui!</div>
        <?php elseif ($_GET['status'] == 'foto_updated'): ?>
            <div class="alert alert-success">Foto profil berhasil diubah!</div>
        <?php elseif ($_GET['status'] == 'reset_success'): ?>
            <div class="alert alert-success">Password berhasil direset ke <strong>admin123</strong>.</div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="row g-4">
        <!-- FOTO PROFIL -->
        <div class="col-md-4">
            <div class="card border-success">
                <div class="card-body text-center">
                    <img src="../images/uploads/<?php echo isset($data['foto_profil']) ? $data['foto_profil'] : 'default.jpg'; ?>" 
                    class="foto-preview mb-3" alt="Foto Profil"
                    onerror="this.onerror=null;this.src='../images/uploads/default.jpg';">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="file" name="foto" class="form-control mb-2" required>
                        <button type="submit" name="upload_foto" class="btn btn-sm btn-success">Ganti Foto</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- FORM PROFIL -->
        <div class="col-md-8">
            <form method="POST" class="card border-success mb-4 p-3">
                <h5>Informasi Profil</h5>
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label>Nama Depan</label>
                        <input type="text" name="nama_depan" class="form-control" value="<?= $data['nama_depan'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label>Nama Belakang</label>
                        <input type="text" name="nama_belakang" class="form-control" value="<?= $data['nama_belakang'] ?>">
                    </div>
                </div>
                <label>Email</label>
                <input type="email" name="email" class="form-control mb-2" value="<?= $data['email'] ?>">

                <button type="submit" name="simpan_profil" class="btn btn-success">Simpan Perubahan</button>
            </form>

            <!-- GANTI PASSWORD -->
            <form method="POST" class="card border-success p-3">
                <h5>Ganti Password</h5>
                <input type="password" name="password_lama" class="form-control mb-2" placeholder="Password Lama" required>
                <input type="password" name="password_baru" class="form-control mb-2" placeholder="Password Baru" required>
                <input type="password" name="konfirmasi_password" class="form-control mb-3" placeholder="Konfirmasi Password Baru" required>
                <button type="submit" name="update_password" class="btn btn-success">Update Password</button>
            </form>

            <!-- RESET PASSWORD MANUAL -->
            <form method="POST" class="card border-danger p-3 mt-4">
                <h5 class="text-danger">Reset Password Manual</h5>
                <p class="text-muted">Klik tombol ini jika kamu lupa password lama.</p>
                <button type="submit" name="reset_password_admin" class="btn btn-danger">Reset ke admin123</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>