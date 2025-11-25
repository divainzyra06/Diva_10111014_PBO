<?php
class Database {
    // Properti Koneksi Database
    var $host = "localhost";
    var $uname = "root";
    var $pass = "";
    var $database = "belajar_oop";
    var $koneksi = "";

    // Constructor: Menghubungkan ke database
    function __construct() {
        $this->koneksi = mysqli_connect($this->host, $this->uname, $this->pass, $this->database);
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

    // --- READ / TAMPIL DATA ---

    // 1. Menampilkan semua data dengan dukungan pengurutan (Sorting)
// koneksi.php

function tampil_data($sortir = 'kode_barang') { 
    $kolom_sortir = mysqli_real_escape_string($this->koneksi, $sortir);
    
    // Query untuk tabel tb_barang yang Anda konfirmasi
    $query = "SELECT * FROM tb_barang ORDER BY $kolom_sortir ASC"; 
    $data = mysqli_query($this->koneksi, $query);
    
    // --- TAMBAHKAN PEMERIKSAAN KESALAHAN INI (Wajib!) ---
    if ($data === false) {
        // Jika query gagal (misalnya kolom sorting salah atau masalah lain)
        // Hentikan eksekusi dan tampilkan error SQL yang sebenarnya
        die("Query Tampil Data Gagal! Pesan Error: " . mysqli_error($this->koneksi)); 
    }
    // --- AKHIR PEMERIKSAAN ---
    
    $hasil = array();
    // Baris ini sekarang aman, karena $data sudah pasti mysqli_result
    while ($d = mysqli_fetch_array($data)) { 
        $hasil[] = $d;
    }
    return $hasil;
}

    // 2. Menampilkan data berdasarkan ID (untuk proses edit)
    function tampil_data_by_id($id_barang) {
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_barang WHERE kode_barang='$id_barang'");
        $hasil = array();
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }

    // 3. Mencari data (untuk Search dan Autocomplete)
function cari_data($cari, $sortir) {

    // Filter kolom sortir biar aman
    $kolom_sortir = mysqli_real_escape_string($this->koneksi, $sortir);
    $nilai_cari = mysqli_real_escape_string($this->koneksi, $cari);

    // Cari berdasarkan kolom yang dipilih user
    $query = "SELECT * FROM tb_barang 
              WHERE $kolom_sortir LIKE '%$nilai_cari%'
              ORDER BY $kolom_sortir ASC";

    $data = mysqli_query($this->koneksi, $query);

    $hasil = array();
    while ($d = mysqli_fetch_array($data)) {
        $hasil[] = $d;
    }
    return $hasil;
}

    // 4. Mengambil kode barang terakhir (untuk Kode Otomatis)
    function kode_barang_terakhir() {
        $data = mysqli_query($this->koneksi, "SELECT MAX(kode_barang) AS kode_max FROM tb_barang");
        $hasil = mysqli_fetch_assoc($data);
        return $hasil['kode_max'];
    }

    // --- CREATE / TAMBAH DATA ---

    function tambah_data($kode_barang, $nama_barang, $stok, $harga_beli, $harga_jual, $gambar_produk) {
        if ($gambar_produk != "") {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'JPG'); 
            $x = explode('.', $gambar_produk); 
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['gambar_produk']['tmp_name'];
            $angka_acak = rand(1, 999);
            $nama_gambar_baru = $angka_acak . '-' . $gambar_produk; 

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru);

                $query = "INSERT INTO tb_barang (kode_barang, nama_barang, stok, harga_beli, harga_jual, gambar_produk) VALUES ('$kode_barang', '$nama_barang', '$stok', '$harga_beli', '$harga_jual', '$nama_gambar_baru')";
                $result = mysqli_query($this->koneksi, $query);

                if (!$result) {
                    die("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
                } else {
                    echo "<script>alert('Data berhasil ditambahkan.');window.location='tampil.php';</script>";
                }
            } else {
                echo "<script>alert('Ekstensi gambar yang boleh hanya .jpg atau .png.');window.location='tambah_data.php';</script>";
            }
        } else {
            $query = "INSERT INTO tb_barang (kode_barang, nama_barang, stok, harga_beli, harga_jual, gambar_produk) VALUES ('$kode_barang', '$nama_barang', '$stok', '$harga_beli', '$harga_jual', null)";
            $result = mysqli_query($this->koneksi, $query);

            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
            } else {
                echo "<script>alert('Data berhasil ditambahkan.');window.location='tampil.php';</script>";
            }
        }
    }

    // --- UPDATE / EDIT DATA ---

    function edit_data($id_barang, $nama_barang, $stok, $harga_beli, $harga_jual, $gambar_produk) {
        if ($gambar_produk != "") {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'JPG'); 
            $x = explode('.', $gambar_produk); 
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['gambar_produk']['tmp_name'];
            $angka_acak = rand(1, 999);
            $nama_gambar_baru = $angka_acak . '-' . $gambar_produk; 

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru);

                $query = "UPDATE tb_barang SET nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual', gambar_produk='$nama_gambar_baru' WHERE kode_barang='$id_barang'";
                $result = mysqli_query($this->koneksi, $query);

                if (!$result) {
                    die("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
                } else {
                    echo "<script>alert('Data berhasil diubah.');window.location='tampil.php';</script>";
                }
            } else {
                echo "<script>alert('Ekstensi gambar yang boleh hanya .jpg, .jpeg atau .png.');window.location='edit_data.php';</script>";
            }
        } else {
            $query = "UPDATE tb_barang SET nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual' WHERE kode_barang='$id_barang'";
            $result = mysqli_query($this->koneksi, $query);

            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
            } else {
                echo "<script>alert('Data berhasil diubah.');window.location='tampil.php';</script>";
            }
        }
    }

    // --- DELETE / HAPUS DATA ---

    function delete_data($id_barang) {
        $query = mysqli_query($this->koneksi, "DELETE FROM tb_barang WHERE kode_barang='$id_barang'");
    }

    function delete_all() {
        $query = "DELETE FROM tb_barang";
        $result = mysqli_query($this->koneksi, $query);
        return $result; 
    }
    
    // --- AUTENTIKASI ---

function login($username, $password) {
    $user = mysqli_real_escape_string($this->koneksi, $username);
    $pass = mysqli_real_escape_string($this->koneksi, $password);

    // Ganti tb_user menjadi user (sesuai nama tabel Anda)
    $query = "SELECT * FROM user WHERE username='$user' AND password='$pass'";
    $data = mysqli_query($this->koneksi, $query);
    
    // TAMBAHKAN PENGECEKAN KEGAGALAN QUERY SEBELUM MENGGUNAKAN mysqli_num_rows()
    if ($data === false) {
        die("Query Login Gagal! Pastikan nama tabel dan kolom 'user' sudah benar di database. Pesan Error: " . mysqli_error($this->koneksi)); 
    }

    if (mysqli_num_rows($data) > 0) {
        return mysqli_fetch_array($data);
    } else {
        return false;
    }
}
    // --- PRINTING ---
    
    function satuan_print($nama_barang) {
        $nama = mysqli_real_escape_string($this->koneksi, $nama_barang);
        
        $query = "SELECT * FROM tb_barang WHERE nama_barang = '$nama'";
        $data = mysqli_query($this->koneksi, $query);
        
        $hasil = array();
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }}
?>