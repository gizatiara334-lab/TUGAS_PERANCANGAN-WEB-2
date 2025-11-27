<?php
include('koneksi.php');

if (isset($_GET['del'])) {
    $del = $_GET['del'];

    // Ambil data untuk hapus file
    $result = mysqli_query($koneksi, "SELECT * FROM namasiswa WHERE id='$del'");
    $data = mysqli_fetch_array($result);

    if ($data && !empty($data['foto'])) {
        unlink("gambar/" . $data['foto']); // hapus file
    }

    // Hapus data dari database
    mysqli_query($koneksi, "DELETE FROM namasiswa WHERE id='$del'");
    echo "Data berhasil dihapus<br><a href='tampil_foto.php'>Kembali</a>";
} else {
    echo "Tidak ada data yang dipilih untuk dihapus.<br><a href='tampil_foto.php'>Kembali</a>";
}
?>
