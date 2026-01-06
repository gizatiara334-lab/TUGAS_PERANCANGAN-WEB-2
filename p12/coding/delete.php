<?php
header("Content-Type: application/json");
ini_set('display_errors', 1);
error_reporting(E_ALL);

// koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "absensiqr");
if (!$koneksi) {
    echo json_encode([
        "status" => false,
        "message" => "Koneksi database gagal"
    ]);
    exit;
}

// ambil data JSON (DELETE)
$data = json_decode(file_get_contents("php://input"), true);

$id_absensi = $data['id_absensi'] ?? '';

if ($id_absensi == '') {
    echo json_encode([
        "status" => false,
        "message" => "id_absensi wajib diisi"
    ]);
    exit;
}

// cek data ada atau tidak
$cek = $koneksi->prepare("
    SELECT id_absensi FROM tbl_absensi WHERE id_absensi = ?
");
$cek->bind_param("i", $id_absensi);
$cek->execute();
$result = $cek->get_result();

if ($result->num_rows == 0) {
    echo json_encode([
        "status" => false,
        "message" => "Data absensi tidak ditemukan"
    ]);
    exit;
}

// hapus data
$stmt = $koneksi->prepare("
    DELETE FROM tbl_absensi WHERE id_absensi = ?
");
$stmt->bind_param("i", $id_absensi);

if ($stmt->execute()) {
    echo json_encode([
        "status" => true,
        "message" => "Absensi berhasil dihapus"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus absensi",
        "error" => mysqli_error($koneksi)
    ]);
}
