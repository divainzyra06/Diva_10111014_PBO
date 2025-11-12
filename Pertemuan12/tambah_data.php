<?php
include('koneksi.php');
$db = new Database();
// Pastikan tidak ada PHP logic di sini
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Data Barang</title>
    </head>
<body>

    <center>
        <h3>Form Tambah Data Barang</h3>
    </center>

    <form method="post" action="proses_barang.php?action=add" enctype="multipart/form-data">
        <table width="50%" border="0">
            <tr>
                <td>Kode Barang</td>
                <td>
                    <input type="text" name="kode_barang" placeholder="Kode Barang " required/>
                </td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td><input type="text" name="nama_barang" placeholder="Nama Barang" required/></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td><input type="text" name="stok" placeholder="Stok" required/></td>
            </tr>
            <tr>
                <td>Harga Beli</td>
                <td><input type="text" name="harga_beli" placeholder="Harga Beli" required/></td>
            </tr>
            <tr>
                <td>Harga Jual</td>
                <td><input type="text" name="harga_jual" placeholder="Harga Jual" required/></td>
            </tr>
            <tr>
                <td>Gambar Produk</td>
                <td><input type="file" name="gambar_produk" required="required"/></td>
            </tr>
            <tr>
                <td></td>
                <td><p style="color:red"> *Ekstensi yang diperbolehkan .jpg | .jpeg | .JPG | .PNG</p></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" class="tombol_login" name="tombol" value="Simpan"/>
                    <a href="tampil.php" class="tombol_login">Kembali</a>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>