<!DOCTYPE html>
<html lang="en">
<head>
    <title>Demo Fungsi</title>
</head>
<body>

<?php
// Contoh prosedur (tidak mengembalikan nilai)
function do_print() {
    echo "Waktu sekarang (timestamp): " . time();
}

do_print();

echo "<br><br>";

// Contoh fungsi (mengembalikan nilai)
function jumlah($a, $b) {
    return $a + $b;
}

echo "Hasil penjumlahan 5 + 3 = " . jumlah(5, 3);

echo "<br><br>";

// Contoh fungsi dengan parameter opsional
function print_teks($teks, $bold = true) {
    echo $bold ? "<b>$teks</b>" : $teks;
}

print_teks("Belajar PHP itu menyenangkan!");
echo "<br>";
print_teks("Tapi harus tekun.", false);
?>

</body>
</html>