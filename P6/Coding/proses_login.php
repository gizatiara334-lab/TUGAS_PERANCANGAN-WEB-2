<?php
session_start();
include "koneksi.php"; // pastikan path sesuai

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level    = $_POST['level'];

    // Query dengan LIMIT 1 agar lebih aman
    $query = "SELECT * FROM tbl_user 
              WHERE username='$username' AND level='$level' 
              LIMIT 1";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $data['password'])) {

            // Set session
            $_SESSION['id_user']  = $data['id_user'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['level']    = $data['level'];

            // Redirect berdasarkan level
            if ($data['level'] == 'admin') {
                header("Location: dashboard/admin.php");
            } elseif ($data['level'] == 'kepala sekolah') {
                header("Location: dashboard/kepalasekolah.php");
            } elseif ($data['level'] == 'guru') {
                header("Location: dashboard/guru.php");
            } elseif ($data['level'] == 'siswa') {
                header("Location: dashboard/siswa.php");
            } elseif ($data['level'] == 'orangtua') {
                header("Location: dashboard/orangtua.php");
            }
            exit;

        } else {
            echo "<script>alert('Password salah!'); window.location='index.php';</script>";
        }

    } else {
        echo "<script>alert('Akun tidak ditemukan!'); window.location='index.php';</script>";
    }

} else {
    // Jika file diakses tanpa klik tombol login
    header("Location: index.php");
    exit;
}
?>
