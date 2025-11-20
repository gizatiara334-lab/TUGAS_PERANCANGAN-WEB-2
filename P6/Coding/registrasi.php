<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun - Sistem Absensi Sekolah</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: url('bg-sekolah.jpg') no-repeat center center/cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(5px);
            z-index: 0;
        }

        .register-container {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            padding: 50px;
            width: 420px;
            max-width: 90%;
            text-align: center;
        }

        h2 {
            font-size: 26px;
            color: #1E3A8A;
            font-weight: 700;
            margin-bottom: 10px;
        }

        p {
            color: #475569;
            margin-bottom: 25px;
            font-size: 14px;
        }

        form input, form select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid #CBD5E1;
            margin-bottom: 15px;
            font-size: 14px;
            transition: 0.2s;
            background-color: #ffffff;
        }

        form input:focus, form select:focus {
            outline: none;
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #FACC15;
            border: none;
            border-radius: 10px;
            color: #1E3A8A;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 5px;
        }

        button:hover {
            background-color: #FBBF24;
        }

        .footer {
            margin-top: 15px;
            font-size: 13px;
            color: #475569;
        }

        .footer a {
            color: #2563EB;
            text-decoration: none;
            font-weight: 600;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>📝 Buat Akun Baru</h2>
        <p>Isi data dengan benar untuk membuat akun</p>

        <form method="post" action="proses_registrasi.php">
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="konfirmasi" placeholder="Konfirmasi Password" required>
            <select name="level" required>
    <option value="">-- Pilih Peran --</option>
    <option value="kepsek">Kepala Sekolah</option>
    <option value="admin">Admin</option>
    <option value="guru">Guru</option>
    <option value="siswa">Siswa</option>
    <option value="orangtua">Orang Tua</option>
</select>
            <button type="submit" name="daftar">Daftar Sekarang</button>
        </form>

        <div class="footer">
            Sudah punya akun? <a href="index.php">Login di sini</a>
        </div>
    </div>
</body>
</html>
