<?php
// koneksi.php
session_start(); // Pastikan session dimulai untuk fungsi login/logout

class Database {
    // Properti Koneksi Database (menggunakan public/private untuk OOP yang lebih baik)
    public $host = "localhost";
    public $uname = "root";
    public $pass = "";
    public $database = "belajar_oop";
    private $koneksi; // Gunakan private untuk objek koneksi
    
    // Properti untuk Pagination
    public $limit = 5; // Tentukan jumlah data per halaman (Anda bisa ubah)

    // Constructor: Menghubungkan ke database
    function __construct() {
        $this->koneksi = mysqli_connect($this->host, $this->uname, $this->pass, $this->database);
        if (mysqli_connect_errno()) {
            // Gunakan die() untuk error fatal koneksi
            die("Koneksi database gagal : " . mysqli_connect_error());
        }
    }

    // --- READ / TAMPIL DATA (DENGAN PAGINATION) ---

    // 1. Menampilkan semua data dengan Pagination
    function tampil_data($page = 1) { 
        $start = ($page - 1) * $this->limit;
        
        $query = "SELECT * FROM tb_barang LIMIT $start, $this->limit"; 
        $data = mysqli_query($this->koneksi, $query);
        
        if ($data === false) {
            die("Query Tampil Data Gagal! Pesan Error: " . mysqli_error($this->koneksi)); 
        }
        
        $hasil = array();
        while ($d = mysqli_fetch_array($data)) { 
            $hasil[] = $d;
        }
        return $hasil;
    }

    // Fungsi baru: Menghitung Total Halaman
    function total_pages() {
        $query = "SELECT COUNT(*) FROM tb_barang";
        $result = mysqli_query($this->koneksi, $query);
        $row = mysqli_fetch_row($result);
        $total_records = $row[0];
        $total_pages = ceil($total_records / $this->limit);
        return $total_pages;
    }

    // 2. Menampilkan data berdasarkan ID (untuk proses edit)
    function tampil_data_by_id($id_barang) {
        $id = mysqli_real_escape_string($this->koneksi, $id_barang);
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_barang WHERE kode_barang='$id'");
        $hasil = array();
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }

    // 3. Mencari data (untuk Search dan Autocomplete, dengan Pagination)
    function cari_data($cari, $sortir, $page = 1) {
        $start = ($page - 1) * $this->limit;
        $kolom_sortir = mysqli_real_escape_string($this->koneksi, $sortir);
        $nilai_cari = mysqli_real_escape_string($this->koneksi, $cari);

        $query = "SELECT * FROM tb_barang 
                  WHERE $kolom_sortir LIKE '%$nilai_cari%'
                  ORDER BY $kolom_sortir ASC
                  LIMIT $start, $this->limit";

        $data = mysqli_query($this->koneksi, $query);

        $hasil = array();
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }
    
    // Fungsi baru: Menghitung Total Halaman untuk hasil pencarian
    function total_pages_cari($cari, $sortir) {
        $kolom_sortir = mysqli_real_escape_string($this->koneksi, $sortir);
        $nilai_cari = mysqli_real_escape_string($this->koneksi, $cari);

        $query = "SELECT COUNT(*) FROM tb_barang 
                  WHERE $kolom_sortir LIKE '%$nilai_cari%'";
        $result = mysqli_query($this->koneksi, $query);
        $row = mysqli_fetch_row($result);
        $total_records = $row[0];
        $total_pages = ceil($total_records / $this->limit);
        return $total_pages;
    }

    // 4. Mengambil kode barang terakhir (untuk Kode Otomatis)
    function kode_barang_terakhir() {
        $data = mysqli_query($this->koneksi, "SELECT MAX(kd_barang) AS kd_barang_max FROM tb_barang");
        
        if ($data === false) {
            die("Query Kode Barang Terakhir Gagal: " . mysqli_error($this->koneksi));
        }
        
        $row = mysqli_fetch_array($data);
        $hasil = $row['kd_barang_max']; 
        
        return $hasil;
    }
    
    // 5. Mengambil data untuk cetak satuan
    function satuan_print($nama_barang) {
        $nama = mysqli_real_escape_string($this->koneksi, $nama_barang);
        
        $query = "SELECT * FROM tb_barang WHERE nama_barang = '$nama'";
        $data = mysqli_query($this->koneksi, $query);
        
        $hasil = array();
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
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

    function edit_data($id_barang, $kode_barang, $nama_barang, $stok, $harga_beli, $harga_jual, $gambar_produk) {
        if ($gambar_produk != "") {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'JPG'); 
            $x = explode('.', $gambar_produk); 
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['gambar_produk']['tmp_name'];
            $angka_acak = rand(1, 999);
            $nama_gambar_baru = $angka_acak . '-' . $gambar_produk; 

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru);

                $query = "UPDATE tb_barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual', gambar_produk='$nama_gambar_baru' WHERE kode_barang='$id_barang'";
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
            $query = "UPDATE tb_barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual' WHERE kode_barang='$id_barang'";
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
        $id = mysqli_real_escape_string($this->koneksi, $id_barang);
        $query = mysqli_query($this->koneksi, "DELETE FROM tb_barang WHERE kode_barang='$id'");
    }

    function delete_all() {
        $query = "DELETE FROM tb_barang";
        $result = mysqli_query($this->koneksi, $query);
        return $result; 
    }
    
    // --- AUTENTIKASI ---

    // Fungsi login
    function login($username, $password) {
        $user = mysqli_real_escape_string($this->koneksi, $username);
        $pass = mysqli_real_escape_string($this->koneksi, $password);

        $data = mysqli_query($this->koneksi, "SELECT * FROM user WHERE username='$user' AND password='$pass'");
        $cek = mysqli_num_rows($data); 

        if ($cek > 0) {
            $row = mysqli_fetch_assoc($data); 
            $tipe_user = $row['tipe_user'];

            $_SESSION['username'] = $user;
            $_SESSION['tipe_user'] = $tipe_user;
            
            header("location:tampil.php?pesan=Selamat Datang, $user"); 
        } else {
            header("location:index.php?pesan=gagal login");
        }
    }

    // Fungsi logout
    function logout() {
        unset($_SESSION['username']); 
        session_unset();
        session_destroy();

        header("location:index.php");
    }
}
?>