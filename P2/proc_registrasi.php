<html>
<head>
<title>Hasil Registrasi Mahasiswa</title>
</head>
<body>
<h2>Data Registrasi Mahasiswa Baru</h2>
<hr>
<?php

$nama   = $_POST["nama"];
$jk     = $_POST["jk"];
$prodi  = $_POST["prodi"];
$alamat = $_POST["alamat"];
?>

<p><b>Nama Lengkap :</b> <?php echo $nama; ?></p>
<p><b>Jenis Kelamin :</b> <?php echo $jk; ?></p>
<p><b>Program Studi :</b> <?php echo $prodi; ?></p>
<p><b>Alamat :</b>
<?php echo nl2br($alamat); ?></p>

<hr>
<p>Terima kasih sudah melakukan registrasi.</p>

</body>
</html>