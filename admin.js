document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Ganti dengan credential yang diinginkan
    if(username === 'admin' && password === 'admin123') {
        window.location.href = 'dashboard.php';
    } else {
        alert('Username atau password salah!');
    }
    console.log("Script loaded!"); // Pastikan ini muncul di Console
    console.log("Username:", username, "Password:", password);

    // Handle logout
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
    e.preventDefault(); // Mencegah navigasi default
  
    // 1. Hapus status login (jika menggunakan session)
    sessionStorage.removeItem('isLoggedIn');
  
    // 2. Redirect ke halaman blog
    window.location.href = '../index.php#blog';

// Handle semua form submission
document.addEventListener('DOMContentLoaded', function() {
  // Form Tambah Pengguna
  document.getElementById('userForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Simpan data ke database (AJAX/Fetch)
    alert('Pengguna berhasil ditambahkan!');
    $('#addUserModal').modal('hide');
  });

  // Form Upload Proyek
  document.getElementById('projectForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Proses upload file
    alert('Proyek berhasil diupload!');
    $('#uploadProjectModal').modal('hide');
  });

  // Form Artikel
  document.getElementById('articleForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Kirim konten artikel
    alert('Artikel berhasil disimpan!');
    $('#addArticleModal').modal('hide');
  });

  // Form Pengaturan
  document.getElementById('settingsForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Update pengaturan
    alert('Pengaturan berhasil diperbarui!');
    $('#settingsModal').modal('hide');
  });
});
});
});