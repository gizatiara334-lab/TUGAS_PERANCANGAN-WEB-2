<?php
session_start();
include "../config/koneksi.php";

if (!isset($_POST['login'])) {
    header("Location: login.php");
    exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];

/* AMBIL USER */
$q = mysqli_query($koneksi,
    "SELECT * FROM tbl_user WHERE username='$username' LIMIT 1"
);

if (mysqli_num_rows($q) == 0) {
    die("AKUN TIDAK DITEMUKAN");
}

$user = mysqli_fetch_assoc($q);

/* CEK PASSWORD */
if (!password_verify($password, $user['password'])) {
    die("PASSWORD SALAH");
}

/* SESSION UMUM */
$_SESSION['id_user']  = $user['id_user'];
$_SESSION['username'] = $user['username'];
$_SESSION['level']    = $user['level'];

/* DATA TAMBAHAN SESUAI ROLE */
switch ($user['level']) {

    case 'admin':
        header("Location: ../admin/admin.php");
        break;

    case 'guru':
        $qg = mysqli_query($koneksi,
            "SELECT id_guru FROM tbl_guru WHERE id_user='{$user['id_user']}'"
        );
        if (mysqli_num_rows($qg) == 0) die("DATA GURU BELUM ADA");
        $_SESSION['id_guru'] = mysqli_fetch_assoc($qg)['id_guru'];
        header("Location: ../guru/guru.php");
        break;

    case 'siswa':
        $qs = mysqli_query($koneksi,
            "SELECT id_siswa FROM tbl_siswa WHERE id_user='{$user['id_user']}'"
        );
        if (mysqli_num_rows($qs) == 0) die("DATA SISWA BELUM ADA");
        $_SESSION['id_siswa'] = mysqli_fetch_assoc($qs)['id_siswa'];
        header("Location: ../siswa/siswa.php");
        break;

    case 'kepsek':
        $qk = mysqli_query($koneksi,
            "SELECT id_kepsek FROM tbl_kepsek WHERE id_user='{$user['id_user']}'"
        );
        if (mysqli_num_rows($qk) == 0) die("DATA KEPALA SEKOLAH BELUM ADA");
        $_SESSION['id_kepsek'] = mysqli_fetch_assoc($qk)['id_kepsek'];
        header("Location: ../kepsek/kepsek.php");
        break;

    default:
        die("ROLE TIDAK VALID");
}
exit;
