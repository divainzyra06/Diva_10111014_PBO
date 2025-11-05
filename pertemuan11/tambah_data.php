<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Barang</title>
</head>
<body>
    <h3>Tambah Data Barang</h3>
    <form method="post" action="proses_barang.php?action=add">
        <table>
            <tr><td>Kode Barang</td><td><input type="text" name="kode_barang" required></td></tr>
            <tr><td>Nama Barang</td><td><input type="text" name="nama_barang" required></td></tr>
            <tr><td>Stok</td><td><input type="number" name="stok" required></td></tr>
            <tr><td>Harga Beli</td><td><input type="number" name="harga_beli" required></td></tr>
            <tr><td>Harga Jual</td><td><input type="number" name="harga_jual" required></td></tr>
            <tr><td></td><td><input type="submit" value="Simpan"></td></tr>
        </table>
    </form>
</body>
</html>