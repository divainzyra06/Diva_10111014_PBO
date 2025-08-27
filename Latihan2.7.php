<?php
class Kendaraan
{
    public $jumlahRoda = 4;
    public $warna;
    public $bahanBakar = "Premium";
    public $harga = 100000000;
    public $merek;
    public $tahunPembuatan = 2004;

    // Fungsi untuk cek status harga
    public function statusHarga()
    {
        if ($this->harga > 50000000) {
            $status = "Harga Kendaraan Mahal";
        } else {
            $status = "Harga Kendaraan Murah";
        }
        return $status;
    }

    // Fungsi untuk cek subsidi
    public function statusSubsidi()
    {
        if ($this->tahunPembuatan < 2005 && $this->bahanBakar == "Premium") {
            $status = "DAPAT SUBSIDI";
        } else {
            $status = "TIDAK DAPAT SUBSIDI";
        }
        return $status;
    }
}

// instansiasi kelas (membuat objek)
$ObjekKendaraan1 = new Kendaraan();

// akses properti
echo "Jumlah Roda : " . $ObjekKendaraan1->jumlahRoda . "<br/>";

// akses method/fungsi dalam class
echo "Status Harga : " . $ObjekKendaraan1->statusHarga() . "<br/>";
echo "Status Subsidi : " . $ObjekKendaraan1->statusSubsidi();
?>

