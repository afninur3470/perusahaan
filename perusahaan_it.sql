-- 1. Buat database
CREATE DATABASE IF NOT EXISTS perusahaan_it;
USE perusahaan_it;

-- 2. Tabel admin
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    password VARCHAR(255),
    nama_lengkap VARCHAR(150),
    email VARCHAR(100),
    role VARCHAR(50)
);

-- 3. Tabel admin1 (untuk profil)
CREATE TABLE admin1 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_depan VARCHAR(100),
    nama_belakang VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255),
    foto_profil VARCHAR(255)
);

-- 4. Tabel artikel
CREATE TABLE artikel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255),
    isi TEXT,
    gambar VARCHAR(255),
    tanggal_publikasi DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 5. Tabel portofolio
CREATE TABLE portofolio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255),
    deskripsi TEXT,
    gambar VARCHAR(255)
);

-- 6. Tabel layanan
CREATE TABLE layanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255),
    deskripsi TEXT
);

-- 7. Tabel pesan / kontak
CREATE TABLE pesan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100),
    telepon VARCHAR(20),
    subjek VARCHAR(255),
    pesan TEXT,
    tanggal_kirim DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 8. Tabel log aktivitas
CREATE TABLE aktivitas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aksi TEXT,
    waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 9. Tabel pengguna (jika digunakan)
CREATE TABLE pengguna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100),
    email VARCHAR(100),
    username VARCHAR(50),
    password VARCHAR(255),
    role VARCHAR(50)
);

-- 10. Tabel career_applicants (untuk halaman karier)
CREATE TABLE career_applicants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100),
    email VARCHAR(100),
    posisi VARCHAR(100),
    tempat_lahir VARCHAR(100),
    tanggal_lahir DATE,
    cv VARCHAR(255),
    tanggal_lamaran TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contoh data dummy (opsional, bisa kamu hapus)
INSERT INTO admin1 (nama_depan, nama_belakang, email, password)
VALUES ('Admin', 'GreenTech', 'admin@greentech.com', 
        '$2y$10$Vz1RAbWPNz4uIj0jYOXCOO6fEorCqJw5gtzUzZ9eMwYltQ2bFyS3e'); -- password: admin123
