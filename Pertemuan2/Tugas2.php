<?php
// Data pinjaman
$pinjaman = 1000000;
$bunga = 10; // persen
$lama = 5; // bulan
$telat = 40; // hari
$dendaPerHari = 0.0015; // 0.15% per hari (dalam desimal)

// Hitung total pinjaman dengan bunga
$totalPinjaman = $pinjaman + ($pinjaman * $bunga / 100);

// Hitung besar angsuran per bulan
$angsuran = $totalPinjaman / $lama;

// Hitung denda keterlambatan
$denda = $angsuran * $dendaPerHari * $telat;

// Hitung total pembayaran
$totalBayar = $angsuran + $denda;

// Output
echo "Besaran Pinjaman = Rp $pinjaman<br>";
echo "Total Pinjaman = Rp $totalPinjaman<br>";
echo "Besar Bunga = $bunga %<br>";
echo "Lama Angsuran = $lama bulan<br>";
echo "Besar Angsuran = Rp $angsuran<br>";
echo "Keterlambatan Angsuran = $telat hari<br>";
echo "Denda Keterlambatan = Rp $denda<br>";
echo "Besar Pembayaran = Rp $totalBayar<br>";
?>



