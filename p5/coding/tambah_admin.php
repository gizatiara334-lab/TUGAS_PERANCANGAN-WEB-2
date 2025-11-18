<?php
session_start();
include "../koneksi.php";

// Validasi admin
if (!isset($_SESSION['level']) || $_SESSION['level'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['simpan'])) {

    $nama_admin = $_POST['nama_admin'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek username
    $cek = mysqli_query($koneksi, "SELECT username FROM tbl_user WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username sudah digunakan!'); history.back();</script>";
        exit;
    }

    // Insert user
    $q1 = mysqli_query($koneksi, "
        INSERT INTO tbl_user (username, password, level, status, nama, email)
        VALUES ('$username', '$password', 'admin', 'aktif', '$nama_admin', '$email')
    ");

    if ($q1) {
        $id_user = mysqli_insert_id($koneksi);

        // Insert admin
        $q2 = mysqli_query($koneksi, "
            INSERT INTO tbl_admin (nama_admin, email, no_telp, id_user)
            VALUES ('$nama_admin', '$email', '$no_telp', '$id_user')
        ");

        if ($q2) {
            echo "<script>
                alert('Admin berhasil ditambahkan');
                window.location='data_admin.php';
            </script>";
            exit;
        }
    }

    echo "<script>alert('Gagal menambah admin');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Admin</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            padding: 20px;
        }

        .box {
            width: 420px;
            margin: auto;
            background: white;
            padding: 20px;
            border: 1px solid #ddd;
        }

        h2 {
            margin: 0 0 20px 0;
            font-size: 22px;
            text-align: center;
        }

        label {
            font-size: 14px;
            display: block;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #bbb;
            margin-bottom: 12px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #006be6;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Tambah Admin</h2>

    <form method="POST">

        <label>Nama Admin</label>
        <input type="text" name="nama_admin" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>No Telp</label>
        <input type="text" name="no_telp" required>

        <label>Username Login</label>
        <input type="text" name="username" required>

        <label>Password Login</label>
        <input type="password" name="password" required>

        <button type="submit" name="simpan">Simpan</button>
    </form>
</div>

</body>
</html>
