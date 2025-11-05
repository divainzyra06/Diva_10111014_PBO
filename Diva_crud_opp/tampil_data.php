<?php
// tampil_data.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('koneksi.php');

// --- PROTEKSI LOGIN ---
if(!isset($_SESSION['username'])){
    header("location:login.php?pesan=Silakan%20Login%20Dulu");
    exit;
}

$db = new database();
$keyword = isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : null;
$data_barang = $db->tampil_data($keyword);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
</head>
<body>
    <h3>Data Barang Toko</h3>
    <hr>
    
    <a href="tambah_data.php"><button>Tambah Data</button></a> 
    <a href="proses_barang.php?action=logout" style="float:right;"><button>Keluar Aplikasi</button></a>
    <br><br>

    <form method="GET" action="tampil_data.php">
        <input type="text" name="keyword" placeholder="Cari Nama Barang" value="<?php echo htmlspecialchars($keyword); ?>">
        <input type="submit" value="Cari">
    </form>
    <br>

    <?php 
    if(isset($_GET['pesan'])){
        echo "<p style='color:green; font-weight:bold;'>".htmlspecialchars($_GET['pesan'])."</p>";
    }
    ?>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Kode Barang</th> 
            <th>Barang</th>
            <th>Stok</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Keuntungan</th>
            <th>Action</th>
        </tr>
        <?php
        $no = 1;
        if(!empty($data_barang)){
            foreach($data_barang as $row){
                $keuntungan = $row['harga_jual'] - $row['harga_beli'];
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($row['kode_barang']); ?></td> 
            <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
            <td><?php echo htmlspecialchars($row['stok']); ?></td>
            <td>Rp <?php echo number_format($row['harga_beli']); ?></td>
            <td>Rp <?php echo number_format($row['harga_jual']); ?></td>
            <td>Rp <?php echo number_format($keuntungan); ?></td>
            <td>
                <a href="edit_data.php?kode_barang=<?php echo htmlspecialchars($row['kode_barang']);?>">Edit</a> |
                <a href="proses_barang.php?kode_barang=<?php echo htmlspecialchars($row['kode_barang']);?>&action=delete" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php 
            } 
        } else { 
        ?>
        <tr><td colspan="8" align="center">Data tidak ditemukan!</td></tr>
        <?php } ?>
    </table>
</body>
</html>