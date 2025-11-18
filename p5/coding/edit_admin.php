<?php
include "../koneksi.php";

// =============================
// 1️⃣ AMBIL DATA BERDASARKAN ID
// =============================
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['id'])) {
        echo "<script>alert('ID admin tidak ditemukan'); window.location='data_admin.php';</script>";
        exit;
    }

    $id_user = $_GET['id'];

    // Ambil data tbl_user
    $q1 = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE id_user='$id_user'");
    $user = mysqli_fetch_assoc($q1);

    // Ambil data tbl_admin
    $q2 = mysqli_query($koneksi, "SELECT * FROM tbl_admin WHERE id_user='$id_user'");
    $admin = mysqli_fetch_assoc($q2);
}


// =============================
// 2️⃣ PROSES UPDATE DATA
// =============================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = $_POST['password']; // optional
    $nama_admin = $_POST['nama_admin'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];

    // Kalau password kosong → jangan update password
    if ($password == "") {
        mysqli_query($koneksi, "UPDATE tbl_user SET 
            username='$username'
            WHERE id_user='$id_user'");
    } else {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE tbl_user SET 
            username='$username',
            password='$pass_hash'
            WHERE id_user='$id_user'");
    }

    // Update tbl_admin
    mysqli_query($koneksi, "UPDATE tbl_admin SET
        nama_admin='$nama_admin',
        email='$email',
        no_telp='$no_telp'
        WHERE id_user='$id_user'");

    echo "<script>
            alert('Data admin berhasil diperbarui!');
            window.location='data_admin.php';
          </script>";
    exit;
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Admin</title>
</head>
<body>

<h2>✏️ Edit Admin</h2>

<form method="POST">

    <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">

    Username:<br>
    <input type="text" name="username" value="<?= $user['username'] ?>" required><br><br>

    Password (kosongkan jika tidak ganti):<br>
    <input type="password" name="password"><br><br>

    Nama Admin:<br>
    <input type="text" name="nama_admin" value="<?= $admin['nama_admin'] ?>" required><br><br>

    Email:<br>
    <input type="email" name="email" value="<?= $admin['email'] ?>" required><br><br>

    No. Telp:<br>
    <input type="text" name="no_telp" value="<?= $admin['no_telp'] ?>" required><br><br>

    <button type="submit">Simpan Perubahan</button>

</form>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f3f4f6;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        margin-top: 30px;
        color: #333;
    }

    form {
        width: 400px;
        margin: 30px auto;
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        margin-top: 5px;
        margin-bottom: 15px;
        font-size: 15px;
        box-sizing: border-box;
        transition: 0.2s;
    }

    input:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 4px rgba(79,70,229,0.3);
        outline: none;
    }

    button {
        width: 100%;
        background: #4f46e5;
        color: white;
        padding: 12px;
        border: none;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.2s;
    }

    button:hover {
        background: #3e3ab8;
    }
</style>


</body>
</html>
