<?php
class Kendaraan {
    private $merek;
    private $jmlRoda;
    private $harga;
    private $warna;
    private $bhnBakar;
    private $tahun;

    // Setter
    public function setMerek($merek) { $this->merek = $merek; }
    public function setJmlroda($jmlRoda) { $this->jmlRoda = $jmlRoda; }
    public function setHarga($harga) { $this->harga = $harga; }
    public function setWarna($warna) { $this->warna = $warna; }
    public function setBhnbakar($bhnBakar) { $this->bhnBakar = $bhnBakar; }
    public function setTahun($tahun) { $this->tahun = $tahun; }

    // Getter
    public function getMerek() { return $this->merek; }
    public function getJmlroda() { return $this->jmlRoda; }
    public function getHarga() { return $this->harga; }
    public function getWarna() { return $this->warna; }
    public function getBhnbakar() { return $this->bhnBakar; }
    public function getTahun() { return $this->tahun; }

    // Method tambahan
    public function statusKendaraan() {
        if($this->jmlRoda == 2){
            return "Kendaraan Roda Dua";
        } elseif($this->jmlRoda == 4){
            return "Kendaraan Roda Empat";
        } else {
            return "Jenis Kendaraan Lain";
        }
    }

    public function dapatSubsidi() {
        if(strtolower($this->bhnBakar) == "solar"){
            return "Mendapat Subsidi";
        } else {
            return "Tidak Mendapat Subsidi";
        }
    }

    public function hargaSecondKendaraan() {
        return "Harga Second: Rp " . ($this->harga * 0.8);
    }
}

// Data array
$Data1 = array('Toyota Yaris','4','160000000','Merah','Pertamax','2014');
$Data2 = array('Honda Scoopy','2','13000000','Putih','Premium','2005');
$Data3 = array('Isuzu Panther','4','40000000','Hitam','Solar','1994');

// Membuat objek kendaraan
for($i = 1; $i <= 3; $i++) {
    ${"kendaraan$i"} = new Kendaraan();
    ${"kendaraan$i"}->setMerek(${"Data$i"}[0]);
    ${"kendaraan$i"}->setJmlroda(${"Data$i"}[1]);
    ${"kendaraan$i"}->setHarga(${"Data$i"}[2]);
    ${"kendaraan$i"}->setWarna(${"Data$i"}[3]);
    ${"kendaraan$i"}->setBhnbakar(${"Data$i"}[4]);
    ${"kendaraan$i"}->setTahun(${"Data$i"}[5]);
}

// Menampilkan data kendaraan
for($i = 1; $i <= 3; $i++) {
    echo "Kendaraan$i<br>"; // sudah tanpa simbol $
    echo ${"kendaraan$i"}->getMerek()."<br>";
    echo ${"kendaraan$i"}->getJmlroda()."<br>";
    echo ${"kendaraan$i"}->getHarga()."<br>";
    echo ${"kendaraan$i"}->getWarna()."<br>";
    echo ${"kendaraan$i"}->getBhnbakar()."<br>";
    echo ${"kendaraan$i"}->getTahun()."<br>";
    echo ${"kendaraan$i"}->statusKendaraan()."<br>";
    echo ${"kendaraan$i"}->dapatSubsidi()."<br>";
    echo ${"kendaraan$i"}->hargaSecondKendaraan()."<br><br>";
}
?>







