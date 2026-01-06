<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi Sekolah</title>
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

        .login-container {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            padding: 50px;
            width: 400px;
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
        }

        button:hover {
            background-color: #FBBF24;
        }

        .footer {
            margin-top: 12px;
            text-align: center;
            font-size: 13px;
        }

        .footer a {
            color: #212842;
            text-decoration: none;
            font-weight: 500;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 35px 30px;
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>ðŸ‘‹ Selamat Datang!</h2>
        <p>Silakan Login untuk Masuk</p>

        <form method="post" action="proses_login.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Masuk Sekarang</button>
        </form>

        <div class="footer">
            Belum punya akun? <a href="registrasi.php">Daftar di sini</a>
        </div>
    </div>
</body>
</html>
