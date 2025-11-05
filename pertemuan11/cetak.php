<?php
include('koneksi.php');
$db = new database();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Barang CV Jaya</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        h2 { text-align: center; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #666; padding: 8px; text-align: center; }
        th { background: #eee; }
    </style>
</head>
<body onload="window.print()">
    <h2>LAPORAN DATA BARANG CV JAYA</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Barang</th>
            <th>Stok</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Keuntungan</th>
        </tr>
        <?php
        $data_barang = $db->tampil_data();
        $no = 1;
        foreach ($data_barang as $row) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['kode_barang']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['stok']; ?></td>
            <td><?php echo number_format($row['harga_beli']); ?></td>
            <td><?php echo number_format($row['harga_jual']); ?></td>
            <td><?php echo number_format($row['harga_jual'] - $row['harga_beli']); ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>