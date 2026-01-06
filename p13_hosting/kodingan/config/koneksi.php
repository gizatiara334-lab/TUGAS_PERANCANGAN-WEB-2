<?php
$koneksi = mysqli_connect(
    "localhost",
    "lindr747_gizaabsensiqr",
    "politeknikpurbaya",
    "lindr747_absensiqr"
);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
