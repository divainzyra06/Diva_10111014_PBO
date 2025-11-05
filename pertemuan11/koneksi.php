<?php
class database {
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "belajar_oop";
    var $koneksi;

    function __construct() {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_error()) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }
    }

    // Tampil data + pencarian
    function tampil_data($keyword = null) {
        $query = "SELECT * FROM tb_barang";
        if ($keyword) {
            $safe_keyword = mysqli_real_escape_string($this->koneksi, $keyword);
            $query .= " WHERE nama_barang LIKE '%$safe_keyword%' OR kode_barang LIKE '%$safe_keyword%'";
        }
        $data = mysqli_query($this->koneksi, $query);
        if ($data === false) return [];

        $hasil = [];
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }

    // Tambah data
    function tambah_data($kode_barang, $nama_barang, $stok, $harga_beli, $harga_jual) {
        mysqli_query($this->koneksi, "INSERT INTO tb_barang VALUES ('', '$kode_barang', '$nama_barang', '$stok', '$harga_beli', '$harga_jual')");
    }

    // Ambil data untuk edit
    function tampil_edit_data($kode_barang) {
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_barang WHERE kode_barang='$kode_barang'");
        if ($data === false) return [];
        $hasil = [];
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }

    // Edit data
    function edit_data($kode_barang, $nama_barang, $stok, $harga_beli, $harga_jual) {
        mysqli_query($this->koneksi, "UPDATE tb_barang SET nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual' WHERE kode_barang='$kode_barang'");
    }

    // Hapus data
    function delete_data($kode_barang) {
        mysqli_query($this->koneksi, "DELETE FROM tb_barang WHERE kode_barang='$kode_barang'");
    }

    // Generate kode barang otomatis (opsional)
    function kode_barang() {
        $data = mysqli_query($this->koneksi, "SELECT MAX(kode_barang) AS kode_barang FROM tb_barang");
        $hasil = [];
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }
}
?>