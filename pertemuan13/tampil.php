<?php
// TAMPIL.PHP (Halaman Utama Data Barang)

// Memastikan koneksi hanya di-include sekali
require_once('koneksi.php'); 
$db = new Database();

// --- 1. LOGIKA AUTENTIKASI DAN PESAN ---
if (!isset($_SESSION['username'])) {
    header("location:index.php?pesan=anda harus login");
    exit;
}

if (isset($_GET['pesan'])) {
    // Menampilkan pesan selamat datang dari login
    if (strpos($_GET['pesan'], 'Selamat Datang') !== false) {
        echo "<script>alert('" . htmlspecialchars($_GET['pesan']) . "');</script>";
    }
}

// --- 2. LOGIKA PAGINATION DAN SEARCHING ---
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
$sortir = isset($_GET['sort_data']) ? $_GET['sort_data'] : '';

$query_params = '';
$total_pages = 0;

if (!empty($cari) && !empty($sortir)) {
    // Mode Pencarian
    $data_barang = $db->cari_data($cari, $sortir, $page);
    $total_pages = $db->total_pages_cari($cari, $sortir);
    $query_params = '&cari=' . urlencode($cari) . '&sort_data=' . urlencode($sortir);
} else {
    // Mode Tampil Semua Data
    $data_barang = $db->tampil_data($page);
    $total_pages = $db->total_pages();
}

// Menghitung halaman sebelumnya dan berikutnya untuk navigasi
$prev_page = ($page > 1) ? $page - 1 : 1;
$next_page = ($page < $total_pages) ? $page + 1 : $total_pages;

?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Data Barang</title>
    
    <style type="text/css">
    /* --- CSS Anda (disatukan di sini) --- */
    .formbackground{
        margin: 0px 300px;
        color: black;
    }

    .posisi_tombol{
        margin: 0px 300px;
    }
    .tombol_login{
        background: #47C0D0;
        color: white;
        font-size: 11pt;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }

    table {
        border: solid 1px #DDEEEE;
        border-collapse: collapse;
        border-spacing: 0;
        width: 90%; /* Disesuaikan agar lebih lebar */
        margin: 10px auto 10px auto;
    }
    table thead th {
        background-color: #DDEEEE;
        border: solid 1px #DDEEEE;
        color: #336B6B;
        padding: 10px;
        text-align: left;
        text-shadow: 1px 1px 1px #fff;
        text-decoration: none;
    }
    table tbody td {
        border: solid 1px #DDEEEE;
        color: #333;
        padding: 10px;
        text-shadow: 1px 1px 1px #fff;
    }
    a {
        background-color: #47C0D0;
        color: #fff;
        padding: 10px;
        text-decoration: none;
        font-size: 11px;
    }

    .navbar {
        background-color: #47C0D0;
        overflow: hidden;
        padding: 10px 0;
        margin-bottom: 20px;
        text-align: center;
    }
    .navbar a {
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
        background-color: transparent;
        border: none;
        display: inline-block; /* Agar sejajar di tengah */
    }
    .navbar a:hover {
        background-color: #ddd;
        color: black;
    }

    /* Styling Pagination */
    .pagination {
        display: inline-block;
        padding-bottom: 30px;
        text-align: center;
        width: 100%;
    }
    .pagination a {
        color: white;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ddd;
        margin: 0 4px;
        background-color: #47C0D0;
        float: none;
        display: inline-block;
    }
    .pagination a.active {
        background-color: #007bff;
        color: white;
        border: 1px solid #007bff;
    }
    .pagination a:hover:not(.active) {
        background-color: #ddd;
        color: black;
    }
    </style>
</head>

<body>
    
    <div class="navbar">
        <a href="tampil.php">Home</a>
        <a href="tampil.php">Kelola Data</a>
        <a href="proses_barang.php?action=logout">Logout</a>
    </div>

    <form id="form_background" method="get" style="text-align:center; margin-top:20px;">
        Cari Berdasarkan :
        <select name="sort_data">
            <option value="" <?php echo ($sortir == '') ? 'selected' : ''; ?>>Pilih Kolom</option>
            <option value="kode_barang" <?php echo ($sortir == 'kode_barang') ? 'selected' : ''; ?>>Kode Barang</option>
            <option value="nama_barang" <?php echo ($sortir == 'nama_barang') ? 'selected' : ''; ?>>Nama Barang</option>
            <option value="stok" <?php echo ($sortir == 'stok') ? 'selected' : ''; ?>>Stok</option>
            <option value="harga_beli" <?php echo ($sortir == 'harga_beli') ? 'selected' : ''; ?>>Harga Beli</option>
            <option value="harga_jual" <?php echo ($sortir == 'harga_jual') ? 'selected' : ''; ?>>Harga Jual</option>
        </select>
        <input type="text" name="cari" placeholder="Cari Data" value="<?php echo htmlspecialchars($cari); ?>">
        <input type="submit" class="tombol_login" value="Cari">
        <a href="tampil.php" class="tombol_login">Reset</a>
    </form>
    
    <br>
    
    <div class="posisi_tombol" style="text-align:center;">
        <a href="tambah_data.php" class="tombol_login">Tambah Data</a>
        <a href="cetak.php" class="tombol_login">Print Semua Data</a>
        
        <form style="display:inline-block; margin-left: 10px;" method="POST" action="proses_barang.php">
    
            <input type="text" name="nama_barang" placeholder="Nama Barang Satuan">
    
        </form>
    </div>
    
    <div align="center">
        <h2>Data Barang</h2>
    </div>
    
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = ($page - 1) * $db->limit + 1; // Menghitung nomor urut awal
            
            if (empty($data_barang)) {
                echo "<tr><td colspan='8' align='center'>Data tidak ditemukan.</td></tr>";
            } else {
                foreach($data_barang as $row){
                    $rupiah_harga_beli = "Rp. ".number_format($row['harga_beli'], 0, ',', '.');
                    $rupiah_harga_jual = "Rp. ".number_format($row['harga_jual'], 0, ',', '.');
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['kode_barang']; ?></td>
                <td><?php echo $row['nama_barang']; ?></td>
                <td><?php echo $row['stok']; ?></td>
                <td><?php echo $rupiah_harga_beli; ?></td>
                <td><?php echo $rupiah_harga_jual; ?></td>
                <td align="center">
                    <img src="gambar/<?php echo $row['gambar_produk']; ?>" style="width: 100px; height: 100px;">
                </td>
                <td align="center">
                    <a href="edit_data.php?id_barang=<?php echo $row['kode_barang']; ?>" class="tombol_login">Edit</a>
                    <a href="proses_barang.php?id_barang=<?php echo $row['kode_barang']; ?>&action=delete" class="tombol_login" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                </td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
    
    <div class="pagination" align="center">
        <a href="tampil.php?page=<?php echo $prev_page . $query_params; ?>">Previous</a>
        
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="tampil.php?page=<?php echo $i . $query_params; ?>" 
               class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
        
        <a href="tampil.php?page=<?php echo $next_page . $query_params; ?>">Next</a>
    </div>

    <script src="jquery-3.2.1.min.js"></script>
    <script src="autocomplete/jquery.autocomplete.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            var i = $('input[name=cari]');
            
            i.autocomplete({
                serviceUrl: "source.php", 
                type: 'POST', 
                dataType: 'json', 
                paramName: 'suggest', 
                onSelect: function(suggestion) {
                    i.val(suggestion.nama_barang);
                }
            });
        });
    </script>
</body>
</html>