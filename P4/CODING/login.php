<?php
include "koneksi.php";
session_start();

// cek apakah tombol login diklik
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // cari user di database
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND status='aktif'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        // verifikasi password terenkripsi
        if (password_verify($password, $data['password'])) {
            // buat session
            $_SESSION['username'] = $data['username'];
            $_SESSION['level'] = $data['level'];

            echo "<script>
                alert('Login berhasil sebagai $data[level]!');
                window.location = 'dashboard.php';
            </script>";
        } else {
            echo "<script>
                alert('Password salah!');
                window.location = 'login.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Username tidak ditemukan atau akun nonaktif!');
            window.location = 'login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Sistem Absensi</title>
</head>
<body>
    <h2>Login Sistem Absensi</h2>
    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>

