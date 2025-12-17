<?php
require_once 'config/koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tempat = $_POST['tempat_lahir'];
    $tanggal = $_POST['tanggal_lahir'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $pendidikan = $_POST['pendidikan'];
    $posisi = $_POST['posisi'];
    $informasi = $_POST['informasi'];
    
    // Upload CV
    $cv_name = $_FILES['cv']['name'];
    $cv_tmp = $_FILES['cv']['tmp_name'];
    $upload_dir = "uploads/cv/";
    move_uploaded_file($cv_tmp, $upload_dir . $cv_name);

    // Simpan ke database
    mysqli_query($conn, "INSERT INTO career_applicants 
    (nama, alamat, tempat_lahir, tanggal_lahir, email, no_hp, pendidikan, posisi, cv_file, informasi_lain) 
    VALUES 
    ('$nama', '$alamat', '$tempat', '$tanggal', '$email', '$no_hp', '$pendidikan', '$posisi', '$cv_name', '$informasi')");
    
    header("Location: career.php?status=sukses");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Karier - GreenTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'partials/navbar.php'; ?>

<div class="container py-5">
    <h2 class="text-success text-center mb-4">Formulir Pendaftaran Karier</h2>
    
    <?php if (isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
        <div class="alert alert-success text-center">✅ Data berhasil dikirim.</div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="card shadow p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>No. Handphone</label>
                <input type="text" name="no_hp" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Pendidikan / Jurusan</label>
                <input type="text" name="pendidikan" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Posisi Dilamar</label>
                <select name="posisi" class="form-select" required>
                    <option value="">-- Pilih Posisi --</option>
                    <option>Web Developer</option>
                    <option>UI/UX Designer</option>
                    <option>DevOps Engineer</option>
                    <option>IT Support</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Upload CV (PDF)</label>
                <input type="file" name="cv" class="form-control" accept=".pdf" required>
            </div>
            <div class="col-12">
                <label>Informasi Tambahan</label>
                <textarea name="informasi" class="form-control" rows="3"></textarea>
            </div>
        </div>
        <div class="text-center mt-4">
            <button type="submit" name="submit" class="btn btn-success px-4">Kirim</button>
        </div>
    </form>
</div>

<?php include 'partials/footer.php'; ?>
</body>
</html>
