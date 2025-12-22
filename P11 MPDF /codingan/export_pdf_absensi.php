<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();
if(!isset($_SESSION['username'])) exit;

$koneksi = mysqli_connect("localhost","root","","absensiqr");

$tgl   = $_GET['tanggal'] ?? date('Y-m-d');
$kelas = $_GET['kelas'] ?? '';

$where = "WHERE a.tanggal='$tgl'";
if($kelas!='') $where.=" AND s.id_kelas='$kelas'";

$q = mysqli_query($koneksi,"
SELECT s.nama_siswa, k.nama_kelas, a.jam, a.status
FROM tbl_absensi a
JOIN tbl_siswa s ON a.id_siswa=s.id_siswa
JOIN tbl_kelas k ON s.id_kelas=k.id_kelas
$where
ORDER BY a.jam ASC
");

$kop = "
<div style='text-align:center'>
<h2>SEKOLAH MENENGAH XYZ</h2>
<p>Jl. Pendidikan No. 1 – Telp. (021) 123456</p>
<hr>
<h3>LAPORAN ABSENSI SISWA</h3>
<p>Tanggal: $tgl</p>
</div>
";

$html = $kop."
<table border='1' width='100%' cellpadding='6' cellspacing='0'>
<tr style='background:#eee'>
<th>No</th><th>Nama</th><th>Kelas</th><th>Jam</th><th>Status</th>
</tr>
";

$no=1;
while($r=mysqli_fetch_assoc($q)){
$html.="
<tr>
<td>$no</td>
<td>{$r['nama_siswa']}</td>
<td>{$r['nama_kelas']}</td>
<td>{$r['jam']}</td>
<td>{$r['status']}</td>
</tr>";
$no++;
}
$html.="</table>

<br><br>
<div style='text-align:right'>
<p>Mengetahui,<br>Kepala Sekolah</p><br><br>
<p><b>____________________</b></p>
</div>
";

$mpdf = new \Mpdf\Mpdf(['format'=>'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output("laporan_absensi_$tgl.pdf","D");
