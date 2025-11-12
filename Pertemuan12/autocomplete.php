<?php
// Pastikan koneksi.php sudah di-include dan class Database tersedia
include('koneksi.php'); 
$db = new Database();

// Ambil query pencarian dari jQuery UI (variabel 'term')
$searchTerm = $_GET['term'];

// Query untuk mencari nama_barang yang mengandung $searchTerm
$query = "SELECT nama_barang FROM tb_barang WHERE nama_barang LIKE '%" . mysqli_real_escape_string($db->koneksi, $searchTerm) . "%' GROUP BY nama_barang ORDER BY nama_barang ASC";

$result = mysqli_query($db->koneksi, $query);

$data = array();
while ($row = mysqli_fetch_array($result)) {
    // Format data untuk jQuery UI Autocomplete (hanya butuh 'value')
    $data[] = $row['nama_barang'];
}

// Kembalikan data dalam format JSON
echo json_encode($data);

// Pastikan tidak ada output lain
exit;
?>