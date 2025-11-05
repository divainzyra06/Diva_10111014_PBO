<?php
include('koneksi.php');
$db = new database();
$kode_barang = isset($_GET['kode_barang']) ? $_GET['kode_barang'] : null;
$data_edit_barang = $db->tampil_edit_data($kode_barang);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Barang</title>
</head>
<body>
    <h3>Edit Data Barang</h3>
    <?php foreach($data_edit_barang as $d){ ?>
    <form method="post" action="proses_barang.php?action=edit">
        <table>
            <tr><td>Kode Barang</td><td><input type="text" name="kode_barang" value="<?php echo $d['kode_barang']; ?>" readonly></td></tr>
            <tr><td>Nama Barang</td><td><input type="text" name="nama_barang" value="<?php echo $d['nama_barang']; ?>"></td></tr>
            <tr><td>Stok</td><td><input type="text" name="stok" value="<?php echo $d['stok']; ?>"></td></tr>
            <tr><td>Harga Beli</td><td><input type="text" name="harga_beli" value="<?php echo $d['harga_beli']; ?>"></td></tr>
            <tr><td>Harga Jual</td><td><input type="text" name="harga_jual" value="<?php echo $d['harga_jual']; ?>"></td></tr>
            <tr><td></td><td><input type="submit" value="Simpan"></td></tr>
        </table>
    </form>
    <?php } ?>
</body>
</html>