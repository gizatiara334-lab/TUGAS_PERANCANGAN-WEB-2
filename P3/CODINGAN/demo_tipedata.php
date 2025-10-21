<!DOCTYPE html>
<html lang="en">
<head>
    <title>Demo Tipe Data</title>
</head>
<body>

<h2>Demo Tipe Data dan Casting</h2>

<?php
$bil = 3;
echo "<b>Pemeriksaan Tipe Data:</b><br>";
var_dump(is_int($bil));
echo "<br>";

$var = "";
var_dump(is_string($var));

echo "<hr>";

$str = '123abc';
$bil2 = (int)$str; // Casting ke integer

echo "<b>Setelah Casting:</b><br>";
echo "Tipe data \$str: " . gettype($str) . "<br>";
echo "Tipe data \$bil2: " . gettype($bil2);
?>
</body>
</html>