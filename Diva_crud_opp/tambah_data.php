<?php
// tambah_data.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('koneksi.php');

if(!isset($_SESSION['username'])){
    header("location:login.php?pesan=Akses%20Ditolak!%20Silakan%20login%20dulu.");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Data Barang</title>
</head>
<body>
    <h3>Form Tambah Data Barang</h3>
    <hr/>
    <form method="post" action="proses_barang.php?action=tambah">
        <table>
            <tr>
                <td>Kode Barang</td>
                <td>:</td>
                <td><input type="text" name="kode_barang" required /></td> 
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td><input type="text" name="nama_barang" required /></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td>:</td>
                <td><input type="number" name="stok" required /></td>
            </tr>
            <tr>
                <td>Harga Beli</td>
                <td>:</td>
                <td><input type="number" name="harga_beli" required /></td>
            </tr>
            <tr>
                <td>Harga Jual</td>
                <td>:</td>
                <td><input type="number" name="harga_jual" required /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <input type="submit" name="tombol" value="Simpan" />
                    <a href="tampil_data.php"><button type="button">Kembali</button></a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>