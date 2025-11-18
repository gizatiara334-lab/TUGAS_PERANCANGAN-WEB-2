<?php
session_start();
include "../koneksi.php";

// Cek login admin
if (!isset($_SESSION['level']) || $_SESSION['level'] != 'admin') {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Admin</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #1e3a8a; color: white; }
        a {
            padding: 6px 10px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .hapus { background: #dc2626; }
    </style>
</head>
<body>

<h2>👤 Data Admin</h2>
<a href="tambah_admin.php">➕ Tambah Admin</a>

<table>
    <tr>
        <th>No</th>
        <th>Username</th>
        <th>Level</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 1;

    // 🌟 FIX PENTING — nama tabel harus tbl_user, bukan users
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE level='admin' ORDER BY id_user DESC");

    while ($row = mysqli_fetch_assoc($query)) {
        echo "<tr>
            <td>{$no}</td>
            <td>{$row['username']}</td>
            <td>{$row['level']}</td>
            <td>
                <a href='edit_admin.php?id={$row['id_user']}'>✏️ Edit</a>
                <a class='hapus' href='hapus_admin.php?id={$row['id_user']}' onclick=\"return confirm('Hapus admin ini?');\">🗑️ Hapus</a>
            </td>
        </tr>";
        $no++;
    }
    ?>
</table>

</body>
</html>
