<?php
include "../config/koneksi.php";

if (!isset($_POST['daftar'])) {
    header("Location: registrasi.php");
    exit;
}

$nama       = $_POST['nama'];
$username   = $_POST['username'];
$email      = $_POST['email'];
$password   = $_POST['password'];
$konfirmasi = $_POST['konfirmasi'];
$level      = $_POST['level'];

if ($password !== $konfirmasi) {
    die("Password tidak sama");
}

$hash = password_hash($password, PASSWORD_DEFAULT);

/* SIMPAN KE USER */
mysqli_query($koneksi, "
    INSERT INTO tbl_user (nama, username, email, password, level)
    VALUES ('$nama', '$username', '$email', '$hash', '$level')
");

$id_user = mysqli_insert_id($koneksi);

/* SIMPAN KE TABEL SESUAI ROLE */
if ($level == 'admin') {
    mysqli_query($koneksi,
        "INSERT INTO tbl_admin (id_user, nama_admin, email)
         VALUES ('$id_user', '$nama', '$email')"
    );
}

if ($level == 'guru') {
    mysqli_query($koneksi,
        "INSERT INTO tbl_guru (id_user, nama_guru, email)
         VALUES ('$id_user', '$nama', '$email')"
    );
}

if ($level == 'siswa') {
    mysqli_query($koneksi,
        "INSERT INTO tbl_siswa (id_user, nama_siswa, email)
         VALUES ('$id_user', '$nama', '$email')"
    );
}

if ($level == 'kepsek') {
    mysqli_query($koneksi,
        "INSERT INTO tbl_kepsek (id_user, nama_kepsek, email)
         VALUES ('$id_user', '$nama', '$email')"
    );
}

echo "<script>alert('Registrasi berhasil');location='login.php';</script>";
