<?php
include('koneksi.php');

if (isset($_POST['kirim'])) {
    $nama = $_POST['nama'];
    $nama_valid = true;

    // Cek jika nama kosong
    if ($nama == "") {
        echo "<script>alert('Nama masih kosong'); window.location='input_foto.php';</script>";
        $nama_valid = false;
    }

    if ($nama_valid) {
        // Ambil informasi file
        $file = $_FILES['foto']['name'];
        $tmp_dir = $_FILES['foto']['tmp_name'];
        $ukuran = $_FILES['foto']['size'];

        $direktori = 'gambar/'; // Folder tujuan
        $ektensi = strtolower(pathinfo($file, PATHINFO_EXTENSION)); // Dapatkan ekstensi file

        // Ekstensi yang diperbolehkan
        $valid_ektensi = array('jpeg', 'jpg', 'png', 'gif');

        // Nama file baru
        $gambar = uniqid() . "." . $ektensi;

        // Validasi ekstensi
        if (in_array($ektensi, $valid_ektensi)) {

            // Validasi ukuran file (maks 5MB)
            if ($ukuran < 5000000) {

                // Upload file
                if (move_uploaded_file($tmp_dir, $direktori . $gambar)) {

                    // Simpan ke database
                    $query = "INSERT INTO namasiswa (nama, foto) VALUES ('$nama', '$gambar')";
                    $hasil = mysqli_query($koneksi, $query);

                    if ($hasil) {
                        // Redirect ke tampil_foto.php setelah sukses
                        echo "<script>
                                alert('Berhasil disimpan');
                                window.location='tampil_foto.php';
                              </script>";
                        exit();
                    } else {
                        echo "Gagal menyimpan ke database: " . mysqli_error($koneksi);
                    }

                } else {
                    echo "Upload file gagal. <br><a href='input_foto.php'>Kembali</a>";
                }

            } else {
                echo "<script>alert('Ukuran gambar terlalu besar (maks 5MB)'); window.location='input_foto.php';</script>";
            }

        } else {
            echo "<script>alert('Tipe file tidak sesuai! (Hanya jpeg, jpg, png, gif)'); window.location='input_foto.php';</script>";
        }
    }
} else {
    echo "<script>alert('Akses tidak valid'); window.location='input_foto.php';</script>";
}
?>
