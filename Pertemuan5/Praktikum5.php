<?php
// Class Induk
class Employee {
    var $nama;
    var $gajiPokok;
    var $lamaKerja;

    function __construct($nama, $gajiPokok, $lamaKerja) {
        $this->nama = $nama;
        $this->gajiPokok = $gajiPokok;
        $this->lamaKerja = $lamaKerja;
    }

    function hitungGaji() {
        return $this->gajiPokok;
    }
}

// Class Programmer
class Programmer extends Employee {
    function hitungGaji() {
        $gaji = $this->gajiPokok;

        if ($this->lamaKerja >= 1 && $this->lamaKerja <= 10) {
            $gaji += $this->gajiPokok * (0.01 * $this->lamaKerja);
        } elseif ($this->lamaKerja > 10) {
            $gaji += $this->gajiPokok * (0.02 * $this->lamaKerja);
        }
        return $gaji;
    }
}

// Class Direktur
class Direktur extends Employee {
    function hitungGaji() {
        $gaji = $this->gajiPokok;
        $gaji += $this->gajiPokok * (0.5 * $this->lamaKerja);
        $gaji += $this->gajiPokok * (0.1 * $this->lamaKerja);
        return $gaji;
    }
}

// Class Pegawai Mingguan
class PegawaiMingguan extends Employee {
    var $hargaBarang;
    var $stok;
    var $terjual;

    function __construct($nama, $gajiPokok, $lamaKerja, $hargaBarang, $stok, $terjual) {
        parent::__construct($nama, $gajiPokok, $lamaKerja);
        $this->hargaBarang = $hargaBarang;
        $this->stok = $stok;
        $this->terjual = $terjual;
    }

    function hitungGaji() {
        $gaji = $this->gajiPokok;
        $persentase = ($this->terjual / $this->stok) * 100;

        if ($persentase > 70) {
            $gaji += $this->terjual * ($this->hargaBarang * 0.10);
        } else {
            $gaji += $this->terjual * ($this->hargaBarang * 0.03);
        }

        return $gaji;
    }
}


$programer = new Programmer("Noval", 5000000, 5);
echo "Nama: " . $programer->nama . "<br>";
echo "Gaji Programmer: " . $programer->hitungGaji() . "<br><br>";

$direktur = new Direktur("Diva", 10000000, 2);
echo "Nama: " . $direktur->nama . "<br>";
echo "Gaji Direktur: " . $direktur->hitungGaji() . "<br><br>";

$pegawai = new PegawaiMingguan("Elsa", 2000000, 2, 50000, 100, 50);
echo "Nama: " . $pegawai->nama . "<br>";
echo "Gaji Pegawai Mingguan: " . $pegawai->hitungGaji() . "<br>";
?>
