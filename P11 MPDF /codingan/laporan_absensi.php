<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$koneksi = mysqli_connect("localhost", "root", "", "absensiqr");
if (!$koneksi) die("Koneksi gagal");

function e($s){ return htmlspecialchars($s, ENT_QUOTES); }

$tgl = $_GET['tanggal'] ?? date('Y-m-d');
$kelas = $_GET['kelas'] ?? '';

/* ======================
   HITUNG REKAP
====================== */
function hitung($koneksi,$tgl,$status){
    $q = mysqli_query($koneksi,"
        SELECT COUNT(*) AS total 
        FROM tbl_absensi 
        WHERE tanggal='$tgl' AND status='$status'
    ");
    if(!$q) return 0;
    $r = mysqli_fetch_assoc($q);
    return $r['total'] ?? 0;
}

$hadir  = hitung($koneksi,$tgl,'Hadir');
$izin   = hitung($koneksi,$tgl,'Izin');
$sakit  = hitung($koneksi,$tgl,'Sakit');
$alpa   = hitung($koneksi,$tgl,'Alpha');

$total = $hadir + $izin + $sakit + $alpa;
$persen_hadir = $total ? round(($hadir/$total)*100,1) : 0;
$persen_izin  = $total ? round(($izin/$total)*100,1) : 0;
$persen_sakit = $total ? round(($sakit/$total)*100,1) : 0;
$persen_alpa  = $total ? round(($alpa/$total)*100,1) : 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Absensi</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{font-family:Poppins;background:#f5f5f5;padding:20px}
.card{background:#fff;padding:20px;border-radius:15px}
table{width:100%;border-collapse:collapse;margin-top:15px}
th,td{padding:10px;border-bottom:1px solid #ddd;text-align:left}
th{background:#212842;color:#fff}
.filter{display:flex;gap:10px;margin-bottom:15px}
button{padding:8px 15px;border:none;border-radius:8px;background:#212842;color:#fff;cursor:pointer}
select,input{padding:8px;border-radius:8px;border:1px solid #ccc}

@media print{
    form, button, a, canvas {display:none}
    body{background:#fff}
}
</style>
</head>

<body>

<div class="card">
<h2>📊 Laporan Absensi</h2>

<form method="GET" class="filter">
<input type="date" name="tanggal" value="<?= $tgl ?>">

<select name="kelas">
<option value="">Semua Kelas</option>
<?php
$qk = mysqli_query($koneksi,"SELECT * FROM tbl_kelas");
while($k = mysqli_fetch_assoc($qk)){
$sel = ($kelas==$k['id_kelas'])?'selected':'';
echo "<option value='{$k['id_kelas']}' $sel>{$k['nama_kelas']}</option>";
}
?>
</select>

<button type="submit">🔍 Filter</button>
</form>

<div style="margin-bottom:15px;display:flex;gap:10px">
<button onclick="window.print()">🖨️ Cetak</button>
<a href="export_excel_absensi.php?tanggal=<?= $tgl ?>&kelas=<?= $kelas ?>">
<button type="button">📥 Export Excel</button>
</a>

<a href="export_pdf_absensi.php?tanggal=<?= $tgl ?>&kelas=<?= $kelas ?>">
<button type="button">📄 Export PDF</button>
</a>

</div>

<!-- GRAFIK -->
<canvas id="grafik" height="100"></canvas>
<div style="margin:15px 0;display:flex;gap:15px;flex-wrap:wrap">
<div><b>Hadir:</b> <?= $persen_hadir ?>%</div>
<div><b>Izin:</b> <?= $persen_izin ?>%</div>
<div><b>Sakit:</b> <?= $persen_sakit ?>%</div>
<div><b>Alpa:</b> <?= $persen_alpa ?>%</div>
</div>

<table>
<tr>
<th>No</th>
<th>Nama Siswa</th>
<th>Kelas</th>
<th>Tanggal</th>
<th>Status</th>
</tr>

<?php
$where = "WHERE a.tanggal='$tgl'";
if($kelas!='') $where .= " AND s.id_kelas='$kelas'";

$q = mysqli_query($koneksi,"
SELECT s.nama_siswa, k.nama_kelas, a.tanggal, a.status
FROM tbl_absensi a
JOIN tbl_siswa s ON a.id_siswa=s.id_siswa
JOIN tbl_kelas k ON s.id_kelas=k.id_kelas
$where
ORDER BY s.nama_siswa ASC
");

$no=1;
if(!$q || mysqli_num_rows($q)==0){
echo "<tr><td colspan='5'>Data tidak ditemukan</td></tr>";
}else{
while($r=mysqli_fetch_assoc($q)){
echo "
<tr>
<td>$no</td>
<td>".e($r['nama_siswa'])."</td>
<td>".e($r['nama_kelas'])."</td>
<td>{$r['tanggal']}</td>
<td><b>{$r['status']}</b></td>
</tr>";
$no++;
}}
?>
</table>

</div>

<script>
new Chart(document.getElementById('grafik'),{
type:'bar',
data:{
labels:['Hadir','Izin','Sakit','Alpa'],
datasets:[{
data:[<?= $hadir ?>,<?= $izin ?>,<?= $sakit ?>,<?= $alpa ?>]
}]
},
options:{scales:{y:{beginAtZero:true}}}
});
</script>

</body>
</html>
