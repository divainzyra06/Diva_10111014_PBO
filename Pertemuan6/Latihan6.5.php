<?php
echo "nama kamu siapa: ";
$input_nama = fopen("php://stdin","r");
$nama = trim(fgets($input_nama));

echo "Hello, $nama. apa kabar hari ini?";
?>