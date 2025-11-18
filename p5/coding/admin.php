<?php
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] != 'admin') {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Absensi Sekolah</title>

<style>
/* ------------------------------
   GLOBAL STYLE – MODERN UI
--------------------------------*/
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    display: flex;
    height: 100vh;
    background: #eef2ff;
    overflow: hidden;
}

/* ------------------------------
   SIDEBAR
--------------------------------*/
.sidebar {
    width: 270px;
    background: linear-gradient(160deg, #0f172a 0%, #1e3a8a 100%);
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 25px 0;
    backdrop-filter: blur(12px);
    box-shadow: 0 0 25px rgba(0, 0, 0, 0.25);
}

.sidebar h2 {
    text-align: center;
    font-size: 22px;
    margin-bottom: 25px;
    font-weight: 600;
}

.menu {
    list-style: none;
}

.menu li {
    padding: 14px 30px;
    cursor: pointer;
    transition: 0.25s ease;
    border-left: 4px solid transparent;
}

.menu li:hover {
    background: rgba(255, 255, 255, 0.1);
    border-left: 4px solid #38bdf8;
    transform: translateX(5px);
}

.menu li a {
    text-decoration: none;
    color: white;
    display: block;
    font-size: 15px;
}

/* SUBMENU */
.submenu {
    list-style: none;
    padding-left: 35px;
    display: none;
    background: rgba(255,255,255,0.08);
}

.submenu li a {
    color: #e2e8f0;
    font-size: 14px;
}

/* LOGOUT */
.logout {
    text-align: center;
    padding-top: 15px;
}

.logout a {
    color: #fca5a5;
    text-decoration: none;
}

/* MAIN CONTENT */
.main {
    flex: 1;
    padding: 35px 50px;
    overflow-y: auto;
}

.header h2 {
    font-size: 26px;
    font-weight: 600;
    color: #1e3a8a;
}

.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 22px;
    margin: 30px 0;
}

.card {
    background: rgba(255, 255, 255, 0.65);
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}

.card h3 { color: #334155; }
.card p { font-size: 26px; font-weight: 700; }

.chart {
    background: white;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 6px 22px rgba(0,0,0,0.08);
}

.chart-placeholder {
    height: 240px;
    background: #e2e8f0;
    border-radius: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.notif {
    background: #e0f2fe;
    border-left: 5px solid #0284c7;
    padding: 16px;
    border-radius: 10px;
    margin-top: 25px;
}
</style>

</head>

<body>

<!-- ===================== SIDEBAR ======================= -->
<div class="sidebar">
    <div>
        <h2>🧭 Admin Panel</h2>

        <ul class="menu">
            <li><a href="dashboard.php">🏠 Dashboard</a></li>

            <li class="toggle">📂 Manajemen Data ▾</li>
            <ul class="submenu">
                <li><a href="data_admin.php">👨‍💼 Data Admin</a></li>
                <li><a href="data_user.php">🔑 Data User</a></li>

                <li><a href="data_siswa.php">👨‍🎓 Data Siswa</a></li>
                <li><a href="data_guru.php">👩‍🏫 Data Guru</a></li>
                <li><a href="data_kelas.php">🏫 Data Kelas</a></li>
                <li><a href="data_mapel.php">📘 Data Mapel</a></li>
                <li><a href="data_jadwal.php">🕒 Data Jadwal</a></li>
            </ul>

            <li class="toggle qr">🔳 QR Code ▾</li>
            <ul class="submenu submenu-qr">
                <li><a href="qr_generate.php">⚙ Generate QR</a></li>
                <li><a href="qr_download.php">⬇ Download QR</a></li>
                <li><a href="qr_validasi.php">✔ Validasi QR</a></li>
            </ul>

            <li class="toggle absensi">📝 Absensi ▾</li>
            <ul class="submenu submenu-absensi">
                <li><a href="data_absensi.php">📋 Data Kehadiran</a></li>
                <li><a href="rekap_absensi.php">📊 Rekap Absensi</a></li>
                <li><a href="monitoring.php">📡 Monitoring Real-Time</a></li>
            </ul>

            <li><a href="laporan.php">📈 Laporan</a></li>
            <ul class="submenu submenu-laporan">
                <li><a href="laporan_siswa.php">Laporan siswa</a></li>
                <li><a href="laporan_guru.php">Laporaan guru</a></li>
            </ul>
            
            <li><a href="pengaturan.php">⚙ Pengaturan</a></li>
            <li><a href="backup.php">🗄 Backup Database</a></li>
            <li><a href="log_aktivitas.php">📜 Log Aktivitas</a></li>
        </ul>
    </div>

    <div class="logout">
        <a href="../logout.php">🚪 Logout</a>
    </div>
</div>

<!-- ===================== MAIN CONTENT ======================= -->
<div class="main">
    <div class="header">
        <h2>Selamat Datang, <?= htmlspecialchars($_SESSION['username']); ?> 👋</h2>
        <p>Dashboard Admin – Sistem Informasi Absensi QR Code</p>
    </div>

    <div class="chart">
        <h3>Grafik Kehadiran Bulanan</h3>
        <div class="chart-placeholder">[Area Grafik Absensi]</div>
    </div>

    <div class="cards">
        <div class="card"><h3>Jumlah Siswa</h3><p>320</p></div>
        <div class="card"><h3>Jumlah Guru</h3><p>25</p></div>
        <div class="card"><h3>Total Kelas</h3><p>12</p></div>
        <div class="card"><h3>Kehadiran Hari Ini</h3><p>92%</p></div>
    </div>

    <div class="notif">
        📢 <strong>Informasi:</strong> Sistem akan melakukan backup otomatis pukul <strong>23:00</strong>.
    </div>
</div>

<!-- ===================== SCRIPT ======================= -->
<script>
// Submenu utama
const toggleMain = document.querySelector('.toggle');
const submenuMain = document.querySelector('.submenu');

toggleMain.addEventListener('click', () => {
    submenuMain.style.display = submenuMain.style.display === 'block' ? 'none' : 'block';
});

// Submenu QR
const toggleQR = document.querySelector('.toggle.qr');
const submenuQR = document.querySelector('.submenu-qr');

toggleQR.addEventListener('click', () => {
    submenuQR.style.display = submenuQR.style.display === 'block' ? 'none' : 'block';
});

// Submenu Absensi
const toggleAbs = document.querySelector('.toggle.absensi');
const submenuAbs = document.querySelector('.submenu-absensi');

toggleAbs.addEventListener('click', () => {
    submenuAbs.style.display = submenuAbs.style.display === 'block' ? 'none' : 'block';
});
</script>

</body>
</html>