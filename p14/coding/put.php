<?php
header("Content-Type: application/json");
ini_set('display_errors', 1);
error_reporting(E_ALL);

// koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "absensiqr");
if (!$koneksi) {
    echo json_encode(["status"=>false,"message"=>"Koneksi DB gagal"]);
    exit;
}

// ambil data JSON (PUT)
$data = json_decode(file_get_contents("php://input"), true);

$id_absensi     = $data['id_absensi'] ?? '';
$validasi_guru  = $data['validasi_guru'] ?? '';

if ($id_absensi === '' || $validasi_guru === '') {
    echo json_encode([
        "status" => false,
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

// update absensi
$stmt = $koneksi->prepare("
    UPDATE tbl_absensi 
    SET validasi_guru = ?
    WHERE id_absensi = ?
");

if (!$stmt) {
    echo json_encode(["error"=>mysqli_error($koneksi)]);
    exit;
}

$stmt->bind_param("ii", $validasi_guru, $id_absensi);

if ($stmt->execute()) {
    echo json_encode([
        "status" => true,
        "message" => "Absensi berhasil divalidasi"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal update absensi",
        "error" => mysqli_error($koneksi)
    ]);
}
