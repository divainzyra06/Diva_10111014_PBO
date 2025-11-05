<?php
// koneksi.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class database {
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "belajar_oop";
    var $koneksi;

    function __construct(){
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if(mysqli_connect_error()){
            die("Koneksi database gagal: " . mysqli_connect_error());
        }
    }

    // --- CRUD BARANG ---

    function tampil_data($keyword = null){
        $query = "SELECT * FROM tb_barang";
        if($keyword){
            $safe_keyword = mysqli_real_escape_string($this->koneksi, $keyword);
            $query .= " WHERE nama_barang LIKE '%$safe_keyword%'";
        }
        $data = mysqli_query($this->koneksi, $query);
        $hasil = [];
        if ($data !== false) {
            while($row = mysqli_fetch_array($data)){
                $hasil[] = $row;
            }
        }
        return $hasil;
    }

    function tambah_data($kode_barang, $nama_barang, $stok, $harga_beli, $harga_jual){
        $safe_kode = mysqli_real_escape_string($this->koneksi, $kode_barang);
        $safe_nama = mysqli_real_escape_string($this->koneksi, $nama_barang);
        
        // INSERT: Hanya sebutkan kolom yang diisi
        mysqli_query($this->koneksi, "INSERT INTO tb_barang 
            (kode_barang, nama_barang, stok, harga_beli, harga_jual) 
            VALUES('$safe_kode', '$safe_nama', '$stok', '$harga_beli', '$harga_jual')");
    }

    function get_by_id($kode_barang){
        $safe_kode = mysqli_real_escape_string($this->koneksi, $kode_barang);
        // Mencari berdasarkan kode_barang
        $query = mysqli_query($this->koneksi, "SELECT * FROM tb_barang WHERE kode_barang='$safe_kode'");
        return mysqli_fetch_array($query);
    }
    
    function tampil_edit_data($kode_barang){
        $data = $this->get_by_id($kode_barang);
        return $data ? [$data] : []; 
    }

    function update_data($kode_barang, $nama_barang, $stok, $harga_beli, $harga_jual){
        $safe_kode = mysqli_real_escape_string($this->koneksi, $kode_barang);
        $safe_nama = mysqli_real_escape_string($this->koneksi, $nama_barang);
        // UPDATE: Klausa WHERE menggunakan kode_barang
        mysqli_query($this->koneksi, "UPDATE tb_barang SET 
            nama_barang='$safe_nama', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual' 
            WHERE kode_barang='$safe_kode'");
    }

    function hapus_data($kode_barang){
        $safe_kode = mysqli_real_escape_string($this->koneksi, $kode_barang);
        // DELETE: Klausa WHERE menggunakan kode_barang
        mysqli_query($this->koneksi, "DELETE FROM tb_barang WHERE kode_barang='$safe_kode'");
    }
    
    // --- OTENTIKASI (LOGIN) ---
    function get_user_by_login($username, $password){
        $safe_user = mysqli_real_escape_string($this->koneksi, $username);
        $safe_pass = mysqli_real_escape_string($this->koneksi, $password);
        
        // Tabel login diasumsikan bernama 'user'
        $sql = "SELECT username FROM user WHERE username='$safe_user' AND password='$safe_pass'"; 
        
        $query = mysqli_query($this->koneksi, $sql);
        
        if ($query === false) {
            die("Query SQL Login Gagal: " . mysqli_error($this->koneksi) . " SQL: " . $sql); 
        }
        
        if (mysqli_num_rows($query) == 1) {
            return mysqli_fetch_assoc($query); 
        }
        return null;
    }
}
?>