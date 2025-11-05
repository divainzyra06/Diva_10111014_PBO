<?php
// proses_barang.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('koneksi.php');
$db = new database();

$action = isset($_GET['action']) ? $_GET['action'] : '';

if($action == "tambah"){
    $kode_barang = $_POST['kode_barang']; 
    
    $db->tambah_data(
        $kode_barang, 
        $_POST['nama_barang'], 
        $_POST['stok'], 
        $_POST['harga_beli'], 
        $_POST['harga_jual']
    );
    header("location:tampil_data.php?pesan=Data%20barang%20berhasil%20ditambahkan!");
    exit;
}
elseif($action == "edit"){
    $kode_barang = $_POST['kode_barang']; 
    
    $db->update_data(
        $kode_barang, 
        $_POST['nama_barang'], 
        $_POST['stok'], 
        $_POST['harga_beli'], 
        $_POST['harga_jual']
    );
    header("location:tampil_data.php?pesan=Data%20barang%20berhasil%20diubah!");
    exit;
}
elseif($action == "delete"){
    // Hapus menggunakan kode_barang dari URL
    $db->hapus_data($_GET['kode_barang']);
    header("location:tampil_data.php?pesan=Data%20barang%20berhasil%20dihapus!");
    exit;
}
elseif($action == "login"){
    $username = $_POST['username'];
    $password = $_POST['password']; 
    
    $data_user = $db->get_user_by_login($username, $password);
    
    if(!empty($data_user)){
        $_SESSION['username'] = $data_user['username'];
        $_SESSION['status'] = "login";
        header("location:tampil_data.php");
        exit;
    } else {
        header("location:login.php?pesan=Username%20atau%20password%20salah!");
        exit;
    }
}
elseif($action == "logout"){
    session_destroy();
    header("location:login.php?pesan=Anda%20telah%20logout.");
    exit;
} else {
    header("location:tampil_data.php?pesan=Aksi%20tidak%20valid!");
    exit;
}
?>