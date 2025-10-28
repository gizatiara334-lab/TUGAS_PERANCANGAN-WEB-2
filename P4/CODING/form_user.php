<?php
include "koneksi.php"; // sambungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level    = $_POST['level'];
    $status   = $_POST['status'];

    // Enkripsi password biar aman
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password, level, status)
              VALUES ('$username', '$password_hash', '$level', '$status')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('✅ User baru berhasil ditambahkan!');</script>";
    } else {
        echo "<script>alert('❌ Gagal menyimpan data: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
</head>
<body>
    <h2>Form Tambah User</h2>
    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Level:</label><br>
        <select name="level" required>
            <option value="">-- Pilih Level --</option>
            <option value="admin">Admin</option>
            <option value="guru">Guru</option>
            <option value="siswa">Siswa</option>
            <option value="orangtua">Orang Tua</option>
            <option value="kepsek">Kepala Sekolah</option>
        </select><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select><br><br>

        <input type="submit" value="Simpan User">
    </form>
</body>
</html>
