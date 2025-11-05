<?php
include('koneksi.php');
$db = new database();

$keyword = isset($_GET['cari']) ? $_GET['cari'] : null;
$data_barang = $db->tampil_data($keyword);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tampilan Data Barang</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        form { display: inline-block; margin-bottom: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #999; padding: 8px; text-align: center; }
        th { background-color: #eee; }
        .button { margin-right: 10px; }
    </style>
</head>
<body>
    <h2>DATA BARANG CV JAYA</h2>

    <!-- Form Cari -->
    <form method="get">
        <input type="text" name="cari" placeholder="Cari Nama Barang" value="<?php echo htmlspecialchars($keyword); ?>">
        <input type="submit" value="Cari">
    </form>
    <br><br>

    <!-- Tombol Tambah dan Print -->
    <a href="tambah_data.php"><button class="button">Tambah Data</button></a>
    <a href="cetak.php" target="_BLANK"><button class="button">Print Semua Barang</button></a>

    <br><br>

    <table>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Stok</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Action</th>
        </tr>
        <?php
        $no = 1;
        if (!empty($data_barang)) {
            foreach ($data_barang as $row) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['kode_barang']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['stok']; ?></td>
            <td><?php echo number_format($row['harga_beli']); ?></td>
            <td><?php echo number_format($row['harga_jual']); ?></td>
            <td>
                <a href="edit_data.php?kode_barang=<?php echo $row['kode_barang']; ?>">Edit</a> |
                <a href="proses_barang.php?kode_barang=<?php echo $row['kode_barang']; ?>&action=delete" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php
            }
        } else {
            echo '<tr><td colspan="7">Data tidak ditemukan!</td></tr>';
        }
        ?>
    </table>
</body>
</html>