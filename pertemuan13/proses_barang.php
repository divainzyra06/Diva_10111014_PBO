<?php
include('koneksi.php');
$koneksi = new database();

// Mengambil aksi (action) dari parameter URL GET
$action = $_GET['action'];

// --- Logika Kontroler (Controller Logic) ---

// 1. Tambah Data (Create)
if($action == "add")
{
    // Memanggil fungsi tambah_data dari class Database
    $koneksi->tambah_data(
        $_POST['kd_barang'],
        $_POST['nama_barang'],
        $_POST['stok'],
        $_POST['harga_beli'],
        $_POST['harga_jual'],
        $_FILES['gambar_produk']['name']
    );
    // Mengarahkan kembali ke halaman tampil setelah sukses
    header('location:tampil.php');
}
// 2. Edit Data (Update)
else if($action == "edit")
{
    // Mengambil ID barang dari URL GET
    $id_barang = $_GET['id_barang'];
    
    // Memanggil fungsi edit_data dari class Database
    $koneksi->edit_data(
        $id_barang,
        $_POST['kd_barang'], // Parameter ini ditambahkan berdasarkan kode koneksi.php final
        $_POST['nama_barang'],
        $_POST['stok'],
        $_POST['harga_beli'],
        $_POST['harga_jual'],
        $_FILES['gambar_produk']['name']
    );
    header('location:tampil.php');
}
// 3. Hapus Data (Delete)
else if($action == "delete")
{
    // Mengambil ID barang dari URL GET
    $id_barang = $_GET['id_barang'];
    $koneksi->delete_data($id_barang);
    header('location:tampil.php');
}
// 4. Print Satuan
else if($action == "print_satuan")
{
    $nama_barang = $_POST['nama_barang'];
    $koneksi->satuan_print($nama_barang);
    // Redirect ke halaman cetak2.php dengan membawa parameter nama_barang
    header('location:cetak2.php?nama_barang='.$nama_barang);
}
// 5. Login
else if($action == "login")
{
    // Memanggil fungsi login, yang akan menangani redirect internal
    $koneksi->login($_POST['username'],$_POST['password']);
}
// 6. Logout
else if($action == "logout")
{
    // Memanggil fungsi logout, yang akan menangani session dan redirect ke index.php
    $koneksi->logout();
}
?>