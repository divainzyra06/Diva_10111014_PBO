<?php
// Line 1: Panggil session_start() di awal untuk semua operasi yang menggunakan sesi
session_start();

include('koneksi.php');
$koneksi = new Database();

$action = $_GET['action'];

if ($action == "add") {
    $koneksi->tambah_data($_POST['kode_barang'], $_POST['nama_barang'], $_POST['stok'], $_POST['harga_beli'], $_POST['harga_jual'], $_FILES['gambar_produk']['name']);
    header('location:tampil.php');
} else if ($action == "edit") {
    $id_barang = $_GET['id_barang'];
    $koneksi->edit_data($id_barang, $_POST['nama_barang'], $_POST['stok'], $_POST['harga_beli'], $_POST['harga_jual'], $_FILES['gambar_produk']['name']);
    header('location:tampil.php');
} else if ($action == "delete") {
    $id_barang = $_GET['id_barang'];
    $koneksi->delete_data($id_barang);
    header('location:tampil.php');
} else if ($action == "print_satuan") {
    $nama_barang = $_POST['nama_barang'];
    $koneksi->satuan_print($nama_barang);
    header('location:cetak2.php?nama_barang=' . $nama_barang);
} else if ($action == "login") {
    // TANGANI LOGIKA LOGIN DI SINI
    $data_user = $koneksi->login($_POST['username'], $_POST['password']);
    
    if ($data_user) {
        // Jika login sukses, buat sesi dan redirect
        $_SESSION['username'] = $data_user['username'];
        $_SESSION['status'] = "login";
        header("location:tampil.php");
    } else {
        // Jika login gagal
        echo "<script>alert('Username atau password salah!');window.location='index.php';</script>";
    }
} else if ($action == "logout") {
    // LOGOUT
    session_destroy();
    header('location:index.php');
} else if ($action == "delete_all") { // Tambahan jika Anda menggunakan tombol Hapus Semua Data
    $koneksi->delete_all();
    header('location:tampil.php');
}
?>