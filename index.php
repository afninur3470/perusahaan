<?php 
session_start();
require_once('../config/koneksi.php');

$queryLayanan = "SELECT * FROM layanan";
$resultLayanan = mysqli_query($conn, $queryLayanan);

$queryPortofolio = "SELECT * FROM portofolio LIMIT 3";
$resultPortofolio = mysqli_query($conn, $queryPortofolio);

$queryArtikel = "SELECT * FROM artikel ORDER BY tanggal_publikasi DESC LIMIT 3";
$resultArtikel = mysqli_query($conn, $queryArtikel);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="login-container">
        <form id="loginForm">
            <h2>Login Admin</h2>
            <input type="text" id="username" placeholder="Username" required>
            <input type="password" id="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
    <script src="js/admin.js"></script>
</body>
</html>