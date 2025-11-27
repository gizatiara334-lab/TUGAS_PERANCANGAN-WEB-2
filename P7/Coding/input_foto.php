<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Upload Gambar</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: url('bg-sekolah.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        /* Efek gelap pada background agar form lebih terbaca */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.45);
            z-index: 1;
        }

        .upload-container {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.92);
            width: 420px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            animation: fadeIn 0.6s ease-in-out;
            backdrop-filter: blur(3px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-size: 15px;
            font-weight: bold;
            color: #444;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            border: 1px solid #bbb;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="file"]:focus {
            border-color: #2575fc;
            outline: none;
            box-shadow: 0 0 5px rgba(37, 117, 252, 0.4);
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            background: #2575fc;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #1850b5;
            transform: translateY(-2px);
        }

        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 13px;
            color: #555;
        }
    </style>
</head>
<body>

<div class="upload-container">
    <h2>📷 Upload Gambar</h2>
    <form method="post" action="proses.php" enctype="multipart/form-data">
        <label>Masukkan Nama</label>
        <input type="text" name="nama" placeholder="Masukkan nama..." required>

        <label>Pilih Foto</label>
        <input type="file" name="foto" required>

        <button type="submit" name="kirim">💾 SIMPAN</button>
    </form>

    <div class="footer">
        Pastikan foto jelas sebelum upload
    </div>
</div>

</body>
</html>
