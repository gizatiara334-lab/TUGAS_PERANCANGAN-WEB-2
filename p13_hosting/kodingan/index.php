<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Sistem Absensi Sekolah</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
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
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(3px);
            z-index: 0;
        }

        .welcome-box {
            position: relative;
            z-index: 1;
            width: 450px;
            max-width: 90%;
            background: rgba(255, 255, 255, 0.93);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            font-size: 28px;
            color: #1E3A8A;
            font-weight: 700;
            margin-bottom: 10px;
        }

        p {
            color: #475569;
            font-size: 15px;
            margin-bottom: 30px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            text-align: center;
            font-size: 15px;
            font-weight: 600;
            border-radius: 12px;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .btn-login {
            background: #212842;
            color: white;
        }
        .btn-login:hover {
            background: #212842;
        }

        .btn-register {
            background: #fcd734ff;
            color: #212842;
        }
        .btn-register:hover {
            background: rgba(235, 214, 122, 1);
        }
    </style>
</head>
<body>
    <div class="welcome-box">
        <h1>Selamat Datang</h1>
        <p>Sistem Absensi Sekolah – Silakan pilih untuk melanjutkan</p>

        <!-- PATH SUDAH BENAR -->
        <a href="auth/login.php" class="btn btn-login"> Masuk ke Login</a>
        <a href="auth/registrasi.php" class="btn btn-register">Daftar Akun Baru</a>
    </div>
</body>
</html>
