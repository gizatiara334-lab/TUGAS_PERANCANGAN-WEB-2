<?php
function paginate($conn, $table, $per_page = 10)
{
    // 1. Hitung total data di tabel
    $result = $conn->query("SELECT COUNT(*) AS total FROM $table");
    $row = $result->fetch_assoc();
    $total_data = $row['total'];

    // 2. Hitung total halaman
    $total_page = ceil($total_data / $per_page);

    // 3. Tentukan halaman aktif
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    // 4. Tentukan posisi data dalam LIMIT
    $start = ($page - 1) * $per_page;

    // Kembalikan semua nilai
    return [
        'start' => $start,
        'per_page' => $per_page,
        'page' => $page,
        'total_page' => $total_page
    ];
}
?>
