<?php  
include "koneksi.php";
$db = new Database();

$term  = mysqli_real_escape_string($db->koneksi, $_GET['term']);
$sortir = mysqli_real_escape_string($db->koneksi, $_GET['sortir']);

// Batasi hanya kolom yang valid
$allowed = ["kode_barang", "nama_barang", "stok", "harga_beli", "harga_jual"];
if (!in_array($sortir, $allowed)) {
    $sortir = "nama_barang"; // default
}

$query = mysqli_query(
    $db->koneksi,
    "SELECT $sortir FROM tb_barang 
     WHERE $sortir LIKE '%$term%' 
     GROUP BY $sortir
     LIMIT 10"
);

$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row[$sortir];
}

echo json_encode($data);
?>
