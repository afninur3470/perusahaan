<?php
session_start();
require_once 'config/koneksi.php';

if(isset($_POST['subscribe'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Cek apakah email sudah terdaftar
    $check = mysqli_query($conn, "SELECT * FROM newsletter WHERE email='$email'");
    
    if(mysqli_num_rows($check) > 0) {
        $_SESSION['error'] = "Email sudah terdaftar";
    } else {
        $query = "INSERT INTO newsletter (email) VALUES ('$email')";
        
        if(mysqli_query($conn, $query)) {
            $_SESSION['pesan'] = "Terima kasih telah berlangganan newsletter kami!";
        } else {
            $_SESSION['error'] = "Gagal berlangganan: " . mysqli_error($conn);
        }
    }
    
    header("Location: index.php");
    exit();
}
?>