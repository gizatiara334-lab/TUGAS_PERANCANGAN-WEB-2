<?php
include('koneksi.php');

$query = mysqli_query($koneksi, "SELECT * FROM namasiswa ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Tampil Foto</title>
</head>
<body>

<table width="500" border="1" cellpadding="5">
    <tr>
        <th colspan="4">MENAMPILKAN FOTO / <a href="input_foto.php">TAMBAH DATA</a></th>
    </tr>
    <tr>
        <th>NO</th>
        <th>NAMA</th>
        <th>FOTO</th>
        <th>DELETE</th>
    </tr>

    <?php
    if (mysqli_num_rows($query) > 0) {
        while ($data = mysqli_fetch_array($query)) {
    ?>
    <tr>
        <td><?php echo $data['id']; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td align="center">
            <img src="gambar/<?php echo $data['foto']; ?>" width="60" height="80">
        </td>
        <td><a href="delete.php?del=<?php echo $data['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">DELETE</a></td>
    </tr>
    <?php
        }
    } else {
        echo "<tr><td colspan='4' align='center'>Belum ada data</td></tr>";
    }
    ?>
</table>

</body>
</html>
