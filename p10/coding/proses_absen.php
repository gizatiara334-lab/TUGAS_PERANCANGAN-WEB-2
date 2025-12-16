<?php
session_start();
include "../config/koneksi.php"; // koneksi database

require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
require '../PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Ambil data siswa
$id_siswa = $_POST['id_siswa'];
$tanggal  = date('Y-m-d');
$jam      = date('H:i:s');
$status   = 'Hadir';

// Simpan absensi
$sql = "INSERT INTO tbl_absensi (id_siswa, tanggal, jam, status) 
        VALUES ('$id_siswa','$tanggal','$jam','$status')";

if($koneksi->query($sql)){
    echo "✅ Absensi berhasil disimpan!<br>";

    // Ambil data siswa untuk email
    $querySiswa = $koneksi->query("SELECT nama_siswa, email_ortu FROM tbl_siswa WHERE id_siswa='$id_siswa'");
    $siswa = $querySiswa->fetch_assoc();
    $nama_siswa = $siswa['nama_siswa'];
    $email_ortu = $siswa['email_ortu'];

    // Setup PHPMailer
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '-------';     // Ganti dengan email kamu
        $mail->Password   = '-------';   // Ganti dengan App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('-------', 'Sistem Absensi QR');
        $mail->addAddress($email_ortu);

        $mail->isHTML(true);
        $mail->Subject = 'Notifikasi Kehadiran Siswa';
        $mail->Body    = "
            Yth. Orang Tua/Wali,<br><br>
            Kami informasikan bahwa:<br><br>
            <b>Nama Siswa:</b> $nama_siswa<br>
            <b>Tanggal:</b> $tanggal<br>
            <b>Jam Hadir:</b> $jam<br>
            <b>Status:</b> $status<br><br>
            Terima kasih.<br>
            Sistem Absensi QR Sekolah
        ";

        $mail->send();
        echo "✅ Email notifikasi berhasil dikirim!";
    } catch (Exception $e) {
        echo "❌ Email gagal dikirim: {$mail->ErrorInfo}";
    }

} else {
    echo "❌ Error menyimpan absensi: ".$koneksi->error;
}
