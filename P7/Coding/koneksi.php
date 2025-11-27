<?php
$host="localhost";
$user="root";
$pass="";
$db="foto";
$koneksi=mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){
    echo "Gagal koneksi = " . mysqli_connect_error();
    exit();
}
?>
