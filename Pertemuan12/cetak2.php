<?php
// cetak2.php
include('koneksi.php'); // Pastikan Anda menggunakan koneksi.php yang terbaru
$db = new Database();

// Mengambil nama barang dari URL
$nama_barang = $_GET['nama_barang']; 

// Memanggil method satuan_print()
$data_barang = $db->satuan_print($nama_barang); 
?>

<!DOCTYPE html>
<html>
<body>
    <table>
        <?php
        if (!empty($data_barang)) {
            foreach ($data_barang as $row) {
                // Tampilkan data...
            }
        }
        ?>
    </table>
    
    <script>
        window.print();
    </script>
</body>
</html>