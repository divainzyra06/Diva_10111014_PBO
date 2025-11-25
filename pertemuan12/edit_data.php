<?php
include('koneksi.php');
$db = new Database();

$id_barang = $_GET['id_barang'];
$data_edit_barang = $db->tampil_data_by_id($id_barang);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Edit Data Barang</title>
    <style type="text/css">
        /* ... (CSS Anda, disingkat) ... */
        .tombol_login { background: #47C0DB; color: white; font-size: 11pt; border: none; padding: 5px 20px; }
        body { font-family: 'Trebuchet MS', sans-serif; }
        table { width: 40%; margin: 10px auto; }
        a { background-color: #47C0DB; color: #fff; padding: 10px; text-decoration: none; font-size: 12px; }
    </style>
</head>
<body>

    <center>
        <h3>Form Edit Data Barang</h3>
    </center>

    <?php
    foreach ($data_edit_barang as $d) {
    ?>

    <form method="post" action="proses_barang.php?action=edit&id_barang=<?php echo $d['kode_barang']; ?>" enctype="multipart/form-data">
        <table width="50%" border="0">
            <tr>
                <td>Kode Barang</td>
                <td>
                    <input type="text" name="kode_barang" placeholder="Kode Barang" value="<?php echo $d['kode_barang']; ?>"/>
                </td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td><input type="text" name="nama_barang" placeholder="Nama Barang" value="<?php echo $d['nama_barang']; ?>"/></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td><input type="text" name="stok" placeholder="Stok" value="<?php echo $d['stok']; ?>"/></td>
            </tr>
            <tr>
                <td>Harga Beli</td>
                <td><input type="text" name="harga_beli" placeholder="Harga Beli" value="<?php echo $d['harga_beli']; ?>"/></td>
            </tr>
            <tr>
                <td>Harga Jual</td>
                <td><input type="text" name="harga_jual" placeholder="Harga Jual" value="<?php echo $d['harga_jual']; ?>"/></td>
            </tr>
            <tr>
                <td>Gambar Barang</td>
                <td>
                    <img src="gambar/<?php echo $d['gambar_produk']; ?>" style="width: 100px; float: left; margin-bottom: 5px;">
                    <input type="file" name="gambar_produk" style="float: left; margin-top: 5px;"/>
                    <p style="color: red; float: left; font-size: 12pt;">*Abaikan jika tidak merubah gambar produk</p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" class="tombol_login" name="tombol1" value="Ubah"/>
                    <a href="tampil.php">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
    <?php
    }
    ?>

</body>
</html>