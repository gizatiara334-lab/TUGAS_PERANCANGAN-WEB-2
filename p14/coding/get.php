<?php
header("Content-Type: application/json");

// koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "absensiqr";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    echo json_encode([
        "status" => false,
        "message" => "Koneksi database gagal"
    ]);
    exit;
}

// query GET data absensi
$query = mysqli_query($koneksi, "
    SELECT 
        a.id_absensi,
        u.nama,
        u.nis,
        a.tanggal,
        a.jam,
        a.status
    FROM tbl_absensi a
    JOIN tbl_user u ON a.id_siswa = u.id_user
    ORDER BY a.tanggal DESC
");

$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

// response JSON
echo json_encode([
    "status" => true,
    "jumlah_data" => count($data),
    "data" => $data
]);
?>
