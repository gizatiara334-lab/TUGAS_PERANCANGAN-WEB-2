<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// ------------------ PROSES FILTER PENCARIAN ------------------
$where = "WHERE 1=1";

if (!empty($_GET['cari'])) {
    $cari = $_GET['cari'];
    $where .= " AND (s.nama_siswa LIKE '%$cari%' OR s.nis LIKE '%$cari%')";
}

if (!empty($_GET['kelas'])) {
    $kelas_filter = $_GET['kelas'];
    $where .= " AND s.id_kelas = '$kelas_filter'";
}

// ------------------ PAGINATION ------------------
$per_page = 10; // jumlah data per halaman

// hitung total data sesuai filter
$sqlTotal = mysqli_query($koneksi, "
    SELECT COUNT(*) AS total 
    FROM tbl_siswa s
    LEFT JOIN tbl_kelas k ON s.id_kelas = k.id_kelas
    $where
");
$totalData = mysqli_fetch_assoc($sqlTotal)['total'];

$totalPage = ceil($totalData / $per_page);

// halaman aktif
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// posisi data mulai
$start = ($page - 1) * $per_page;

// ------------------ QUERY UTAMA DENGAN LIMIT ------------------
$query = mysqli_query($koneksi, "
    SELECT s.*, k.nama_kelas 
    FROM tbl_siswa s
    LEFT JOIN tbl_kelas k ON s.id_kelas = k.id_kelas
    $where
    ORDER BY s.nama_siswa ASC
    LIMIT $start, $per_page
");

if (!$query) {
    die('Query Error: ' . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa – Absensi QR</title>
    
    <!-- Font modern seperti di dashboard -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        /* RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #F4EBDD; /* krem lembut */
        }

        .container {
            width: 92%;
            margin: 120px auto 50px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        h2 {
            font-weight: 600;
            font-size: 22px;
            margin-bottom: 20px;
            color: #1E1E2F;
        }

        .btn {
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .tambah {
            background: #1F2937; /* hampir sama dengan sidebar */
            color: white;
        }

        .tambah:hover {
            opacity: 0.85;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background: #1F2937; /* warna card gelap */
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: 500;
        }

        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background: #faf7f2;
        }

        img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
        }

        .edit {
            background: #3B82F6; /* biru soft */
            color: white;
        }

        .edit:hover {
            opacity: 0.85;
        }

        .hapus {
            background: #EF4444; /* merah soft */
            color: white;
        }

        .hapus:hover {
            opacity: 0.85;
        }

        /* FILTER BOX */
        .filter-box {
            margin: 20px 0;
            padding: 15px;
            background: #F4EBDD;
            border-left: 4px solid #1F2937;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        input, select {
            padding: 9px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            padding: 9px 14px;
            border: none;
            border-radius: 8px;
            background: #1F2937;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            opacity: 0.85;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>📚 Data Siswa</h2>

    <a href="tambah_siswa.php" class="btn tambah">+ Tambah Siswa</a>

    <!-- Filter -->
    <div class="filter-box">
        <form method="GET" style="display:flex;gap:10px;">
            <input type="text" name="cari" placeholder="Cari nama / NIS..."
                   value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">

            <select name="kelas">
                <option value="">Semua Kelas</option>
                <?php
                $kelas = mysqli_query($koneksi, "SELECT * FROM tbl_kelas");
                while ($k = mysqli_fetch_assoc($kelas)) {
                    $selected = (isset($_GET['kelas']) && $_GET['kelas'] == $k['id_kelas']) ? "selected" : "";
                    echo "<option value='$k[id_kelas]' $selected>$k[nama_kelas]</option>";
                }
                ?>
            </select>

            <button type="submit">Filter</button>
        </form>
    </div>

    <!-- Tabel -->
    <table>
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        while ($row = mysqli_fetch_array($query)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td>
                <?php if ($row['foto'] != "") { ?>
                    <img src="fotosiswa/<?= $row['foto']; ?>">
                <?php } else { echo "Tidak ada"; } ?>
            </td>
            <td><?= $row['nama_siswa']; ?></td>
            <td><?= $row['nis']; ?></td>
            <td><?= $row['nama_kelas']; ?></td>
            <td>
                <a href="edit_siswa.php?id=<?= $row['id_siswa']; ?>" class="btn edit">Edit</a>
                <a href="hapus_siswa.php?id=<?= $row['id_siswa']; ?>" class="btn hapus" onclick="return confirm('Yakin hapus data?');">Hapus</a>
            </td>
        </tr>
        <?php } ?>

    </table>
<!-- PAGINATION -->
<div style="text-align:center; margin-top:20px;">
    
    <!-- Tombol Prev -->
    <?php if ($page > 1) { ?>
        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>"
           style="padding:8px 12px; background:#ddd; margin-right:5px; border-radius:6px;">
           « Prev
        </a>
    <?php } ?>

    <!-- Nomor halaman -->
    <?php for ($i = 1; $i <= $totalPage; $i++) { ?>
        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"
           style="
                padding:8px 12px; 
                margin-right:5px; 
                border-radius:6px;
                <?= ($i == $page) ? 'background:#1F2937;color:white;' : 'background:#eee;' ?>">
            <?= $i ?>
        </a>
    <?php } ?>

    <!-- Tombol Next -->
    <?php if ($page < $totalPage) { ?>
        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>"
           style="padding:8px 12px; background:#ddd; margin-left:5px; border-radius:6px;">
           Next »
        </a>
    <?php } ?>

</div>

</div>

</body>
</html>
