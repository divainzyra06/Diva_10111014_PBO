<?php
include('koneksi.php');
$db = new database();

if (!isset($_GET['kode_barang']) || empty($_GET['kode_barang'])) {
    echo "<script>alert('Kode barang belum dimasukkan!'); window.close();</script>";
    exit;
}

$kode_barang = mysqli_real_escape_string($db->koneksi, $_GET['kode_barang']);
$data = mysqli_query($db->koneksi, "SELECT * FROM tb_barang WHERE kode_barang='$kode_barang'");
$d = mysqli_fetch_array($data);

if (!$d) {
    echo "<script>alert('Data barang tidak ditemukan!'); window.close();</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Detail Barang</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        h2 { text-align: center; }
        table { margin: 0 auto; border-collapse: collapse; width: 50%; }
        td { border: 1px solid #666; padding: 8px; }
    </style>
</head>
<body onload="window.print()">
    <h2>Laporan Detail Data Barang</h2>
    <table>
        <tr><td><b>Kode Barang</b></td><td><?php echo $d['kode_barang']; ?></td></tr>
        <tr><td><b>Nama Barang</b></td><td><?php echo $d['nama_barang']; ?></td></tr>
        <tr><td><b>Stok</b></td><td><?php echo $d['stok']; ?></td></tr>
        <tr><td><b>Harga Beli</b></td><td><?php echo number_format($d['harga_beli']); ?></td></tr>
        <tr><td><b>Harga Jual</b></td><td><?php echo number_format($d['harga_jual']); ?></td></tr>
        <tr><td><b>Keuntungan</b></td><td><?php echo number_format($d['harga_jual'] - $d['harga_beli']); ?></td></tr>
    </table>
</body>
</html>
