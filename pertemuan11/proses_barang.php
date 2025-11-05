<?php
include('koneksi.php');
$db = new database();

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == "add") {
    $db->tambah_data($_POST['kode_barang'], $_POST['nama_barang'], $_POST['stok'], $_POST['harga_beli'], $_POST['harga_jual']);
    header("location:index.php");
}
elseif ($action == "edit") {
    $db->edit_data($_POST['kode_barang'], $_POST['nama_barang'], $_POST['stok'], $_POST['harga_beli'], $_POST['harga_jual']);
    header("location:index.php");
}
elseif ($action == "delete") {
    $db->delete_data($_GET['kode_barang']);
    header("location:index.php");
}
?>