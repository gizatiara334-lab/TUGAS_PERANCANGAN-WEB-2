<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengguna</title>
</head>
<body>
    <h2>Selamat Datang, <?php echo $_SESSION['username']; ?> </h2>
    <p>Anda login sebagai: <b><?php echo $_SESSION['level']; ?></b></p>

    <?php
    if ($_SESSION['level'] == 'admin') {
        echo "<p>Menu Admin: <a href='form_user.php'>Tambah User Baru</a></p>";
    } elseif ($_SESSION['level'] == 'guru') {
        echo "<p>Menu Guru: Lihat Data Absensi</p>";
    } elseif ($_SESSION['level'] == 'siswa') {
        echo "<p>Menu Siswa: Cek Kehadiran</p>";
    } elseif ($_SESSION['level'] == 'orangtua') {
        echo "<p>Menu Orang Tua: Lihat Laporan Anak</p>";
    } elseif ($_SESSION['level'] == 'kepsek') {
        echo "<p>Menu Kepala Sekolah: Rekap Data Absensi</p>";
    }
    ?>

    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
