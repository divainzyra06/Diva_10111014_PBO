<?php
class Kendaraan
{
    var $jumlahRoda = 4;
    var $warna;
    var $bahanBakar = "Premium";
    var $harga = 100000000;
    var $merek;
    var $tahunPembuatan = 2004;

    // method cek status harga
    function statusHarga()
    {
        if ($this->harga > 50000000) {
            $status = "Harga Kendaraan Mahal";
        } else {
            $status = "Harga Kendaraan Murah";
        }
        return $status;
    }

    // method cek subsidi
    function dapatSubsidi()
    {
        if ($this->tahunPembuatan < 2005 && $this->bahanBakar == "Premium") {
            $status = "DAPAT SUBSIDI";
        } else {
            $status = "TIDAK DAPAT SUBSIDI";
        }
        return $status;
    }

    // method hitung harga bekas
    function hargaSecondKendaraan()
    {
        $hargaBekas = $this->harga - (($this->tahunPembuatan * 0.1) * 100000);
        return $hargaBekas;
    }
}

// Objek 1
$ObjekKendaraan1 = new Kendaraan();
// setting properti
$ObjekKendaraan1->harga = 1000000;
$ObjekKendaraan1->tahunPembuatan = 1999;
// pemanggilan method
echo "Status Harga : " . $ObjekKendaraan1->statusHarga();

// Objek 2
$ObjekKendaraan2 = new Kendaraan();
// setting properti
$ObjekKendaraan2->bahanBakar = "Pertamax";
$ObjekKendaraan2->tahunPembuatan = 1999;

echo "<br>";
echo "Status BBM : " . $ObjekKendaraan2->dapatSubsidi();
echo "<br>";
echo "Harga Bekas : " . $ObjekKendaraan2->hargaSecondKendaraan();
?>
