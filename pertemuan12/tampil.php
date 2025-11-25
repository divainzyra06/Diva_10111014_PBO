<?php
include('koneksi.php');
$db = new Database();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Daftar Barang</title>
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <style type="text/css">
        .formbackground_border {
            margin: 0px auto; 
            width: 70%;
            padding: 10px 0;
            color: black;
            text-align: center;
        }

        /* --- Styling Tombol Aksi (Untuk merapikan tombol Edit & Hapus) --- */
        .tombol_aksi {
            background-color: #47C0DB;
            color: #fff;
            padding: 5px 10px;
            text-decoration: none;
            font-size: 12px;
            border-radius: 3px;
            display: inline-block;
            margin: 2px; /* Memberi jarak di antara tombol */
        }
        
        .tombol_hapus {
            background-color: #dc3545; /* Warna Merah */
            color: white;
        }
        
        .tombol_edit {
            background-color: #007bff; /* Warna Biru */
            color: white;
        }
        
        body {
            font-family: 'Trebuchet MS', sans-serif;
        }

        h1 {
            text-transform: uppercase;
            color: #47C0DB;
            text-align: center;
        }

        table {
            border: solid 1px #DDEEEE;
            border-collapse: collapse;
            border-spacing: 0;
            width: 70%;
            margin: 10px auto 10px auto;
        }

        table thead th {
            background-color: #DDEEFF;
            border: solid 1px #DDEEEE;
            color: #333333;
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

        /* Styling untuk tombol di luar tabel */
        .posisi_tombol a {
            background-color: #47C0DB;
            color: #fff;
            padding: 8px 15px; 
            text-decoration: none;
            font-size: 12px;
            border-radius: 3px;
            display: inline-block;
        }
        .posisi_tombol {
            width: 70%;
            margin: 10px auto;
            text-align: center; 
        }
    </style>
</head>
<body>

    <div class="formbackground_border">
        <form action="tampil.php" method="GET">
            Cari Berdasarkan:
            <select name="sortir" id="sortir">
                <option value="kode_barang">Kode Barang</option> 
                <option value="nama_barang">Nama Barang</option>
                <option value="stok">Stok</option>
                <option value="harga_beli">Harga Beli</option>
                <option value="harga_jual">Harga Jual</option>
            </select>
            <input type="text" name="cari" id="search_item" placeholder="Cari Data">
            <input type="submit" class="tombol_login" value="Cari">
        </form>
    </div>

    <div class="posisi_tombol"> 
        <a href="tambah_data.php">Tambah Data</a>
        <a href="proses_barang.php?action=logout">Logout</a>
        <a href="cetak.php">Print Data Barang</a>
    </div>

    <div class="container_data_barang">
        <h1>Daftar Barang</h1>
        <table border="2">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">Kode Barang</th>
                    <th width="20%">Nama Barang</th>
                    <th width="10%">Stok</th>
                    <th width="15%">Harga Beli</th>
                    <th width="15%">Harga Jual</th>
                    <th width="15%">Gambar Produk</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Logic for Sorting
                $sortir = isset($_GET['sortir']) ? $_GET['sortir'] : 'kode_barang';

                // Logic for Searching and Displaying
                if (isset($_GET['cari']) && !empty($_GET['cari'])) {
                    $cari = $_GET['cari'];
                    $data_barang = $db->cari_data($cari, $sortir); 
                    $query_info = "<h4>Hasil Pencarian : " . htmlspecialchars($cari) . "</h4>";
                } else {
                    $data_barang = $db->tampil_data($sortir); 
                    $query_info = "";
                }

                $no = 1;
                if (is_array($data_barang) || is_object($data_barang)) {
                    foreach ($data_barang as $row) {
                        $stok = $row['stok'];
                        // Konversi Nominal ke Rupiah
                        $harga_beli = 'Rp. ' . number_format($row['harga_beli'], 2, ',', '.');
                        $harga_jual = 'Rp. ' . number_format($row['harga_jual'], 2, ',', '.');
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['kode_barang']; ?></td> 
                    <td><?php echo $row['nama_barang']; ?></td>
                    <td style="text-align: center;"><?php echo $stok; ?></td>
                    <td><?php echo $harga_beli; ?></td>
                    <td><?php echo $harga_jual; ?></td>
                    <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar_produk']; ?>" style="width: 120px;"></td>
                    <td>
                        <a href="edit_data.php?id_barang=<?php echo $row['kode_barang']; ?>" class="tombol_aksi tombol_edit">Edit</a>
                        
                        <a href="proses_barang.php?id_barang=<?php echo $row['kode_barang']; ?>&action=delete" class="tombol_aksi tombol_hapus" onclick="return confirm('Yakin menghapus data?')">Hapus</a>
                    </td>
                </tr>
                <?php
                    } 
                } else {
                    echo '<tr><td colspan="8" style="text-align:center;">Data tidak ditemukan.</td></tr>';
                }
                ?>
            </tbody>
        </table>
        
        <?php
        echo $query_info;
        ?>
    </div>

    <script>
    $(document).ready(function() {
    $("#search_item").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "autocomplete.php",
                type: "GET",
                data: {
                    term: request.term,
                    sortir: $("#sortir").val()   // ⬅ BAGIAN TERPENTING
                },
                success: function(data) {
                    response(JSON.parse(data));
                }
            });
        },
        minLength: 2
    });
});

    </script>
    </body>
</html>