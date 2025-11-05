<?php
// edit_data.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('koneksi.php');

// --- 1. PROTEKSI LOGIN (Penyebab utama masalah) ---
if(!isset($_SESSION['username'])){
    header("location:login.php?pesan=Akses%20Ditolak!%20Silakan%20login%20dulu.");
    exit;
}

$db = new database();

// --- 2. AMBIL KODE BARANG DARI URL ---
$kode_barang = isset($_GET['kode_barang']) ? $_GET['kode_barang'] : null;

if (!$kode_barang) {
    header("location:tampil_data.php?pesan=Kode%20barang%20tidak%20ditemukan%20di%20URL.");
    exit;
}

// Mengambil data berdasarkan kode_barang
$data = $db->tampil_edit_data($kode_barang);

if (empty($data)) {
    header("location:tampil_data.php?pesan=Data%20barang%20tidak%20ditemukan%20di%20database.");
    exit;
}

$row = $data[0]; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Edit Data Barang</title>
</head>
<body>
    <h3>Form Edit Data Barang</h3>
    <hr/>
    <form method="post" action="proses_barang.php?action=edit">
        <table>
            <tr>
                <td>Kode Barang</td>
                <td>:</td>
                <td>
                    <input type="text" name="kode_barang" value="<?php echo htmlspecialchars($row['kode_barang']); ?>" readonly required />
                </td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td><input type="text" name="nama_barang" value="<?php echo htmlspecialchars($row['nama_barang']); ?>" required /></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td>:</td>
                <td><input type="number" name="stok" value="<?php echo htmlspecialchars($row['stok']); ?>" required /></td>
            </tr>
            <tr>
                <td>Harga Beli</td>
                <td>:</td>
                <td><input type="number" name="harga_beli" value="<?php echo htmlspecialchars($row['harga_beli']); ?>" required /></td>
            </tr>
            <tr>
                <td>Harga Jual</td>
                <td>:</td>
                <td><input type="number" name="harga_jual" value="<?php echo htmlspecialchars($row['harga_jual']); ?>" required /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <input type="submit" name="tombol" value="Update" />
                    <a href="tampil_data.php"><button type="button">Kembali</button></a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>