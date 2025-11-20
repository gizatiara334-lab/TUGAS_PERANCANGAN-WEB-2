<?php
include "koneksi.php"; // koneksi database

if (isset($_POST['daftar'])) {
    $nama       = $_POST['nama'];
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];
    $level      = $_POST['level'];

    // Cek password dan konfirmasi
    if ($password !== $konfirmasi) {
        echo "<script>alert('Konfirmasi password tidak sesuai!'); window.history.back();</script>";
        exit;
    }

    // Hash password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Simpan ke tabel user
    $query_user = "INSERT INTO tbl_user (nama, username, email, password, level)
                   VALUES ('$nama', '$username', '$email', '$hash', '$level')";

    if (mysqli_query($koneksi, $query_user)) {
        $id_user = mysqli_insert_id($koneksi);

        // Jika role admin, simpan ke tabel admin
        if ($level == "admin") {
            $query_admin = "INSERT INTO tbl_admin (nama_admin, email, no_telp, id_user)
                            VALUES ('$nama', '$email', '', '$id_user')";
            mysqli_query($koneksi, $query_admin);
        }

        echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan database!'); window.history.back();</script>";
    }
} else {
    header("Location: registrasi.php");
    exit;
}
?>
