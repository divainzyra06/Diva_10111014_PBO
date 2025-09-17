<?php

// Class induk (parent class)
class BangunDatar {
    // Properti dan method kosong (akan diisi oleh class anak)
    public float $luas;
    public float $keliling;

    public function hitungLuas() {
        // Method ini akan di-override oleh class anak
    }

    public function hitungKeliling() {
        // Method ini akan di-override oleh class anak
    }
}

// --- Class anak ---

// Class anak Persegi
class Persegi extends BangunDatar {
    public float $sisi;

    public function __construct(float $sisi) {
        $this->sisi = $sisi;
    }

    public function hitungLuas() {
        $this->luas = $this->sisi * $this->sisi;
        return $this->luas;
    }

    public function hitungKeliling() {
        $this->keliling = 4 * $this->sisi;
        return $this->keliling;
    }
}

// Class anak Lingkaran
class Lingkaran extends BangunDatar {
    public float $r; // r untuk jari-jari

    public function __construct(float $r) {
        $this->r = $r;
    }

    public function hitungLuas() {
        $this->luas = M_PI * $this->r * $this->r;
        return $this->luas;
    }

    public function hitungKeliling() {
        $this->keliling = 2 * M_PI * $this->r;
        return $this->keliling;
    }
}

// Class anak Persegi Panjang
class PersegiPanjang extends BangunDatar {
    public float $panjang;
    public float $lebar;

    public function __construct(float $panjang, float $lebar) {
        $this->panjang = $panjang;
        $this->lebar = $lebar;
    }

    public function hitungLuas() {
        $this->luas = $this->panjang * $this->lebar;
        return $this->luas;
    }

    public function hitungKeliling() {
        $this->keliling = 2 * ($this->panjang + $this->lebar);
        return $this->keliling;
    }
}

// Class anak Segitiga
class Segitiga extends BangunDatar {
    public float $alas;
    public float $tinggi;

    public function __construct(float $alas, float $tinggi) {
        $this->alas = $alas;
        $this->tinggi = $tinggi;
    }

    public function hitungLuas() {
        $this->luas = 0.5 * $this->alas * $this->tinggi;
        return $this->luas;
    }

    public function hitungKeliling() {
        // Untuk segitiga umum, keliling perlu 3 sisi, tapi di diagram hanya ada alas & tinggi.
        // Jika diasumsikan segitiga siku-siku, bisa dihitung dengan teorema Pythagoras.
        // Asumsi: keliling tidak dihitung karena keterbatasan input (hanya alas dan tinggi).
        // Jika perlu, tambahkan input sisi miring atau jenis segitiga lainnya.
        return null; // Mengembalikan null karena tidak ada informasi sisi lain
    }
}

// --- Main Program ---

// Membuat objek dan menampilkan hasilnya
echo "<h2>Hasil Perhitungan Bangun Datar</h2>";

// Persegi
$persegi = new Persegi(10);
echo "<h3>Persegi</h3>";
echo "Sisi: " . $persegi->sisi . "<br/>";
echo "Luas: " . $persegi->hitungLuas() . "<br/>";
echo "Keliling: " . $persegi->hitungKeliling() . "<br/><br/>";

// Lingkaran
$lingkaran = new Lingkaran(7);
echo "<h3>Lingkaran</h3>";
echo "Jari-jari: " . $lingkaran->r . "<br/>";
echo "Luas: " . round($lingkaran->hitungLuas(), 2) . "<br/>"; // Dibulatkan 2 desimal
echo "Keliling: " . round($lingkaran->hitungKeliling(), 2) . "<br/><br/>";

// Persegi Panjang
$pp = new PersegiPanjang(12, 5);
echo "<h3>Persegi Panjang</h3>";
echo "Panjang: " . $pp->panjang . ", Lebar: " . $pp->lebar . "<br/>";
echo "Luas: " . $pp->hitungLuas() . "<br/>";
echo "Keliling: " . $pp->hitungKeliling() . "<br/><br/>";

// Segitiga
$segitiga = new Segitiga(8, 6);
echo "<h3>Segitiga</h3>";
echo "Alas: " . $segitiga->alas . ", Tinggi: " . $segitiga->tinggi . "<br/>";
echo "Luas: " . $segitiga->hitungLuas() . "<br/>";
echo "Keliling: " . ($segitiga->hitungKeliling() !== null ? $segitiga->hitungKeliling() : "Tidak dapat dihitung (informasi sisi tidak lengkap)") . "<br/><br/>";

?>