<!DOCTYPE html>
<html lang="en">
<head>
    <title>Demo Loop</title>
</head>
<body>

<h3>While Loop</h3>
<?php
$i = 0;
while ($i < 5) {
    echo "Perulangan ke-$i<br>";
    $i++;
}
?>

<h3>Do-While Loop</h3>
<?php
$j = 0;
do {
    echo "Perulangan ke-$j<br>";
    $j++;
} while ($j < 5);
?>

<h3>For Loop</h3>
<?php
for ($k = 0; $k < 5; $k++) {
    echo "Perulangan ke-$k<br>";
}
?>

<h3>Foreach Loop</h3>
<?php
$angka = array(1, 2, 3, 4, 5);
foreach ($angka as $nilai) {
    echo "Angka: $nilai<br>";
}
?>

</body>
</html>