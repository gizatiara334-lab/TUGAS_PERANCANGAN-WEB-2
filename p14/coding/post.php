<?php
header("Content-Type: application/json");
ini_set('display_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Jakarta");

// ================================
// KONEKSI DATABASE
// ================================
$koneksi = mysqli_connect("localhost", "root", "", "absensiqr");

if (!$koneksi) {
    echo json_encode([
        "status" => false,
        "message" => "Koneksi database gagal"
    ]);
    exit;
}

// ================================
// AMBIL DATA JSON
// ================================
$data = json_decode(file_get_contents("php://input"), true);

$id_siswa  = $data['id_siswa']  ?? '';
$id_qr     = $data['id_qr']     ?? '';
$latitude  = $data['latitude']  ?? null;
$longitude = $data['longitude'] ?? null;

if ($id_siswa == '' || $id_qr == '') {
    echo json_encode([
        "status" => false,
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

// ================================
// SET DATA ABSENSI
// ================================
$tanggal = date("Y-m-d");
$jam     = date("H:i:s");
$status  = "Hadir";

// ================================
// SIMPAN KE DATABASE
// ================================
$stmt = $koneksi->prepare("
    INSERT INTO tbl_absensi
    (id_siswa, id_qr, tanggal, jam, status, latitude, longitude)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

if (!$stmt) {
    echo json_encode([
        "status" => false,
        "error" => mysqli_error($koneksi)
    ]);
    exit;
}

$stmt->bind_param(
    "iisssdd",
    $id_siswa,
    $id_qr,
    $tanggal,
    $jam,
    $status,
    $latitude,
    $longitude
);

if ($stmt->execute()) {
    echo json_encode([
        "status" => true,
        "message" => "Absensi berhasil disimpan"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menyimpan absensi",
        "error" => mysqli_error($koneksi)
    ]);
}
