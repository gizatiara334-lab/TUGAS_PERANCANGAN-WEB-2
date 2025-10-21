<!DOCTYPE html>
<html lang="en">
<head>
    <title>Demo If Else</title>
</head>
<body>

<?php
$a = 10;
$b = 5;

// Struktur if-elseif-else
if ($a > $b) {
    echo "a lebih besar dari b";
} elseif ($a == $b) {
    echo "a sama dengan b";
} else {
    echo "a kurang dari b";
}

// Contoh switch
echo "<br><br>";

$i = 2;
switch ($i) {
    case 0:
        echo "i equals 0";
        break;
    case 1:
        echo "i equals 1";
        break;
    case 2:
        echo "i equals 2";
        break;
    default:
        echo "i tidak diketahui";
        break;
}
?>
</body>
</html>