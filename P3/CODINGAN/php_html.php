<!DOCTYPE html>
<html lang="en">
<head>
    <title>Demo PHP di HTML</title>
</head>
<body>

<p>Kode <?php echo "PHP"; ?> di HTML</p>

<p>
    <?php
    // Menampilkan tanggal hari ini
    date_default_timezone_set('Asia/Jakarta'); // set zona waktu Indonesia
    echo "Tanggal hari ini: " . date("l, d F Y") . "<br>";
    echo "Nama saya adalah Giza Aurelya<br>";
    echo "NIM: 2402032<br>";
    echo "Terima kasih semuanya";
    ?>
</p>

</body>
</html>
