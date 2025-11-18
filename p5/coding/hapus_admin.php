<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id_user = $_GET['id'];

    // Hapus tbl_admin (yang terhubung dengan id_user)
    mysqli_query($koneksi, "DELETE FROM tbl_admin WHERE id_user='$id_user'");

    // Hapus juga dari tbl_user
    mysqli_query($koneksi, "DELETE FROM tbl_user WHERE id_user='$id_user'");

    echo "<script>alert('Data admin berhasil dihapus'); 
    window.location='data_admin.php';</script>";
} else {
    echo "<script>alert('ID admin tidak ditemukan'); 
    window.location='data_admin.php';</script>";
}
?>
